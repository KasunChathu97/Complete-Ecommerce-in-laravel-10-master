<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnedItemController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'date' => 'nullable|date',
            'q' => 'nullable|string|max:150',
        ]);

        $date = $validated['date'] ?? null;
        $q = trim((string) ($validated['q'] ?? ''));

        $itemsQuery = DB::table('orders')
            ->join('carts', 'carts.order_id', '=', 'orders.id')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->leftJoin('users as sales_admin', 'sales_admin.id', '=', 'orders.sales_staff_id')
            ->where('orders.status', '=', 'returned')
            ->select(
                'orders.id as order_id',
                'orders.order_number',
                'orders.first_name',
                'orders.last_name',
                'orders.phone',
                'orders.total_amount',
                'orders.returned_at',
                'orders.return_reason',
                'orders.sales_staff_id',
                'sales_admin.name as sales_admin_name',
                'carts.product_id',
                'products.title as product_title',
                'carts.quantity as returned_qty'
            )
            ->when($date, fn($query) => $query->whereDate('orders.returned_at', '=', $date))
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('orders.order_number', 'like', '%' . $q . '%')
                        ->orWhere('products.title', 'like', '%' . $q . '%')
                        ->orWhere('orders.phone', 'like', '%' . $q . '%');
                });
            })
            ->orderByDesc('orders.returned_at')
            ->orderByDesc('orders.id');

        // Sales admins can only view returns assigned to them.
        if (auth()->check() && auth()->user()->role === 'sales_admin') {
            $itemsQuery->where('orders.sales_staff_id', '=', auth()->id());
        }

        $items = $itemsQuery->paginate(50)->appends($request->query());

        return view('backend.returned.index', compact('items', 'date', 'q'));
    }
}
