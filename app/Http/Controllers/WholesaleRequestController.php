<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WholesaleRequest;
use App\Notifications\WholesaleRequestAdded;
use App\User;
use Illuminate\Http\Request;

class WholesaleRequestController extends Controller
{
    public function create(Request $request)
    {
        $product = null;
        $slug = $request->query('product');

        if ($slug) {
            $product = Product::where('slug', $slug)->first();
        }

        return view('frontend.pages.wholesale-request', compact('product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['nullable', 'integer', 'exists:products,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'quantity' => ['nullable', 'integer', 'min:1'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        if (!empty($validated['product_id']) && !empty($validated['quantity'])) {
            $product = Product::find($validated['product_id']);
            $requestedQty = (int) $validated['quantity'];
            $availableStock = (int) ($product->stock ?? 0);

            if ($requestedQty > $availableStock) {
                return back()->withInput()->withErrors([
                    'quantity' => 'request failed',
                ]);
            }
        }

        $wholesaleRequest = WholesaleRequest::create([
            'user_id' => auth()->id(),
            'product_id' => $validated['product_id'] ?? null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company' => $validated['company'] ?? null,
            'quantity' => $validated['quantity'] ?? null,
            'message' => $validated['message'] ?? null,
            'status' => 'new',
            'ip_address' => $request->ip(),
        ]);

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new WholesaleRequestAdded($wholesaleRequest));
        }

        return redirect()->route('wholesale.request')->with('success', 'Your wholesale pricing request has been sent successfully. We will contact you soon.');
    }
}
