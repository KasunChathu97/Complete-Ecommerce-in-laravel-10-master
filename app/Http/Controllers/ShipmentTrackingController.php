<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShipmentTracking;
use Illuminate\Http\Request;

class ShipmentTrackingController extends Controller
{
    public function store(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $this->validate($request, [
            'status' => 'required|string|max:50',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'event_time' => 'nullable|date',
        ]);

        ShipmentTracking::create([
            'order_id' => $order->id,
            'status' => $request->status,
            'location' => $request->location,
            'description' => $request->description,
            'event_time' => $request->event_time,
            'created_by' => auth()->id(),
        ]);

        $request->session()->flash('success', 'Tracking update added successfully.');
        return redirect()->back();
    }

    public function destroy($trackingId)
    {
        $tracking = ShipmentTracking::findOrFail($trackingId);
        $tracking->delete();

        request()->session()->flash('success', 'Tracking update deleted successfully.');
        return redirect()->back();
    }
}
