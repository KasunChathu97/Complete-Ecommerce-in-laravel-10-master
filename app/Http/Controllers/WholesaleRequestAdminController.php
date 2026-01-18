<?php

namespace App\Http\Controllers;

use App\Models\WholesaleRequest;
use Illuminate\Http\Request;

class WholesaleRequestAdminController extends Controller
{
    public function index()
    {
        $wholesaleRequests = WholesaleRequest::with(['product', 'user'])
            ->orderByDesc('id')
            ->paginate(20);

        return view('backend.wholesale-request.index', compact('wholesaleRequests'));
    }

    public function update(Request $request, WholesaleRequest $wholesaleRequest)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'max:50'],
        ]);

        $wholesaleRequest->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('wholesale-requests.index')->with('success', 'Wholesale request updated successfully.');
    }

    public function destroy(WholesaleRequest $wholesaleRequest)
    {
        $wholesaleRequest->delete();

        return redirect()->route('wholesale-requests.index')->with('success', 'Wholesale request deleted successfully.');
    }
}
