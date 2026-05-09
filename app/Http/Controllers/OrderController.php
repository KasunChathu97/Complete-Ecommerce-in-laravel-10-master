<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\SmsLog;
use App\User;
use PDF;
use Notification;
use Helper;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Notifications\StatusNotification;
use App\Exports\OrderItemsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use App\Models\SalesAdminProductStock;
use App\Models\Settings;

class OrderController extends Controller
{
    protected function logOrderSms(Order $order, string $message, ?string $status = 'queued', ?string $provider = null): void
    {
        if (empty($order->phone)) {
            return;
        }

        $status = $status ?? 'queued';
        $sentAt = $status === 'sent' ? now() : null;

        SmsLog::create([
            'order_id' => $order->id,
            'phone' => (string) $order->phone,
            'message' => $message,
            'provider' => $provider ?? config('services.sms.provider'),
            'status' => $status,
            'sent_at' => $sentAt,
            'provider_response' => null,
            'created_by' => auth()->id(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // `pending` is treated as legacy `ship`.
        $allowedStatuses = ['new', 'pending', 'process', 'ship', 'delivered', 'cancel'];

        $validated = $request->validate([
            'date' => 'nullable|date',
            'status' => ['nullable', 'string', Rule::in($allowedStatuses)],
            'track' => 'nullable|string|max:150',
        ]);

        $baseQuery = Order::query()
            ->with('salesStaff:id,name')
            ->where('status', '!=', 'returned')
            ->orderBy('id', 'DESC');

        // Sales admins can only view orders assigned to them.
        if (auth()->check() && auth()->user()->role === 'sales_admin') {
            $baseQuery->where('sales_staff_id', auth()->id());
        }

        if (!empty($validated['date'])) {
            $baseQuery->whereDate('created_at', $validated['date']);
        }

        $track = trim((string) ($validated['track'] ?? ''));
        if ($track !== '') {
            $baseQuery->where(function ($q) use ($track) {
                $q->where('order_number', 'like', '%'.$track.'%')
                    ->orWhere('courier_tracking_number', 'like', '%'.$track.'%');
            });
        }

        $requestedStatus = $validated['status'] ?? null;
        if ($requestedStatus === 'pending') {
            $requestedStatus = 'ship';
        }

        $statusCounts = [];
        foreach (['new', 'process', 'ship', 'delivered', 'cancel'] as $status) {
            if ($status === 'ship') {
                $statusCounts[$status] = (clone $baseQuery)->whereIn('status', ['ship', 'pending'])->count();
            } else {
                $statusCounts[$status] = (clone $baseQuery)->where('status', $status)->count();
            }
        }
        $statusCounts['all'] = (clone $baseQuery)->count();

        if (!empty($requestedStatus)) {
            if ($requestedStatus === 'ship') {
                $baseQuery->whereIn('status', ['ship', 'pending']);
            } else {
                $baseQuery->where('status', $requestedStatus);
            }
        }

        if (!empty($validated['date'])) {
            $orders = $baseQuery->get();
        } else {
            $orders = $baseQuery->paginate(10)->appends($request->query());
        }

        return view('backend.order.index', [
            'orders' => $orders,
            'date' => $validated['date'] ?? null,
            'status' => $requestedStatus,
            'statusCounts' => $statusCounts,
        ]);
    }

    /**
     * Autocomplete suggestions for admin order search.
     * Returns matching order numbers or courier tracking numbers.
     */
    public function suggest(Request $request)
    {
        $validated = $request->validate([
            'q' => 'nullable|string|max:150',
        ]);

        $q = trim((string) ($validated['q'] ?? ''));
        if (mb_strlen($q) < 2) {
            return response()->json([]);
        }

        $baseQuery = Order::query();

        // Sales admins can only see suggestions for orders assigned to them.
        if (auth()->check() && auth()->user()->role === 'sales_admin') {
            $baseQuery->where('sales_staff_id', auth()->id());
        }

        $orders = (clone $baseQuery)
            ->select(['order_number', 'courier_tracking_number'])
            ->where(function ($query) use ($q) {
                $query->where('order_number', 'like', '%'.$q.'%')
                    ->orWhere('courier_tracking_number', 'like', '%'.$q.'%');
            })
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        $suggestions = [];
        foreach ($orders as $order) {
            if (!empty($order->order_number)) {
                $suggestions[] = [
                    'value' => (string) $order->order_number,
                    'type' => 'order_number',
                ];
            }
            if (!empty($order->courier_tracking_number)) {
                $suggestions[] = [
                    'value' => (string) $order->courier_tracking_number,
                    'type' => 'courier_tracking_number',
                ];
            }
        }

        // De-duplicate while preserving order.
        $unique = [];
        $seen = [];
        foreach ($suggestions as $s) {
            $key = $s['type'].':'.$s['value'];
            if (isset($seen[$key])) {
                continue;
            }
            $seen[$key] = true;
            $unique[] = $s;
        }

        return response()->json($unique);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emergencyContactRule = optional($request->route())->getName() === 'cart.order' ? 'required' : 'nullable';

        $this->validate($request,[
            'first_name'=>'string|required',
            'last_name'=>'string|required',
            'address1'=>'string|required',
            'address2'=>'string|nullable',
            'district' => 'required|string|max:255',
            'coupon'=>'nullable|numeric',
            'phone'=>'string|required|max:50|regex:/^\+?[0-9\s\-()]+$/',
            'emergency_contact'=>[$emergencyContactRule,'string','max:50','regex:/^\+?[0-9\s\-()]+$/'],
            'post_code'=>'string|nullable',
            'email'=>'string|required',
            'country'=>'string|nullable|max:255'
        ]);
        // return $request->all();

        if(empty(Cart::where('user_id',auth()->user()->id)->where('order_id',null)->first())){
            request()->session()->flash('error','Cart is Empty !');
            return back();
        }
        // $cart=Cart::get();
        // // return $cart;
        // $cart_index='ORD-'.strtoupper(uniqid());
        // $sub_total=0;
        // foreach($cart as $cart_item){
        //     $sub_total+=$cart_item['amount'];
        //     $data=array(
        //         'cart_id'=>$cart_index,
        //         'user_id'=>$request->user()->id,
        //         'product_id'=>$cart_item['id'],
        //         'quantity'=>$cart_item['quantity'],
        //         'amount'=>$cart_item['amount'],
        //         'status'=>'new',
        //         'price'=>$cart_item['price'],
        //     );

        //     $cart=new Cart();
        //     $cart->fill($data);
        //     $cart->save();
        // }

        // $total_prod=0;
        // if(session('cart')){
        //         foreach(session('cart') as $cart_items){
        //             $total_prod+=$cart_items['quantity'];
        //         }
        // }

        $order=new Order();
        $order_data=$request->all();

        // Country is a required DB column; the checkout form may not submit it (field is commented out)
        if (empty($order_data['country'])) {
            $order_data['country'] = 'Sri Lanka';
        }

        // Generate sequential order number.
        // If collisions occur under concurrency, retry a few times.
        $maxAttempts = 5;
        $attempt = 0;
        $saved = false;

        while (!$saved && $attempt < $maxAttempts) {
            $attempt++;
            $order_data['order_number'] = Order::nextOrderNumber();
            // Courier tracking number is added manually when the order is delivered.
        $order_data['user_id']=$request->user()->id;
        $order_data['shipping_id']=$request->shipping;
        $shipping=Shipping::where('id',$order_data['shipping_id'])->pluck('price');
        $order_data['sub_total']=Helper::cartSubTotal();
        $order_data['quantity']=Helper::cartCount();

        $cartBaseQuery = Cart::where('user_id', auth()->user()->id)->where('order_id', null);
        $cartItems = (clone $cartBaseQuery)
            ->with('product:id,title,weight,free_shipping,free_shipping_enabled')
            ->get();

        // Refresh weight-based shipping costs using current admin settings.
        $settings = Settings::first() ?? new Settings();
        $baseShipping = max(0, (int) data_get($settings, 'shipping_cost_upto_1kg', 350));
        $extraShipping = max(0, (int) data_get($settings, 'shipping_cost_over_1kg_extra', 80));

        foreach ($cartItems as $cartItem) {
            if (empty($cartItem->product)) {
                continue;
            }

            $newShipping = 0;

            if (!empty($cartItem->product->free_shipping) || !empty($cartItem->product->free_shipping_enabled)) {
                $newShipping = 0;
            } elseif (!empty($cartItem->product->weight) && (int) $cartItem->quantity > 0) {
                $totalWeightGrams = $cartItem->product->weight * (int) $cartItem->quantity * 1000;
                if ($totalWeightGrams > 0 && $totalWeightGrams <= 1000) {
                    $newShipping = $baseShipping;
                } elseif ($totalWeightGrams > 1000) {
                    $over = $totalWeightGrams - 1000;
                    $extraUnits = (int) ceil($over / 1000);
                    $newShipping = $baseShipping + ($extraShipping * $extraUnits);
                }
            }

            $oldShipping = (int) ($cartItem->shipping_cost ?? 0);
            if ($newShipping !== $oldShipping) {
                $cartItem->shipping_cost = $newShipping;
                if ($cartItem->amount !== null) {
                    $cartItem->amount = max(0, ((float) $cartItem->amount - $oldShipping) + $newShipping);
                }
                $cartItem->save();
            }
        }

        $cart_has_items = $cartItems->isNotEmpty();
        $all_free_shipping = $cart_has_items && $cartItems->every(function ($cart) {
            return !empty($cart->product)
                && (!empty($cart->product->free_shipping) || !empty($cart->product->free_shipping_enabled));
        });

        // Sum shipping_cost from cart items for this user (weight-based shipping)
        $cart_shipping_cost = $all_free_shipping ? 0 : (clone $cartBaseQuery)->sum('shipping_cost');
        $shipping_price = ($all_free_shipping || empty($request->shipping)) ? 0 : (float) ($shipping[0] ?? 0);
        $cart_subtotal = Helper::cartSubTotal();

        $order_data['delivery_charge'] = $all_free_shipping ? 0 : $cart_shipping_cost;
        if(session('coupon')){
            $order_data['coupon']=session('coupon')['value'];
        }
        if($request->shipping){
            if(session('coupon')){
                $order_data['total_amount']=$cart_subtotal+$cart_shipping_cost+$shipping_price-session('coupon')['value'];
            }
            else{
                $order_data['total_amount']=$cart_subtotal+$cart_shipping_cost+$shipping_price;
            }
        }
        else{
            if(session('coupon')){
                $order_data['total_amount']=$cart_subtotal+$cart_shipping_cost-session('coupon')['value'];
            }
            else{
                $order_data['total_amount']=$cart_subtotal+$cart_shipping_cost;
            }
        }
        // return $order_data['total_amount'];
        $order_data['status']="new";
        if(request('payment_method')=='paypal'){
            $order_data['payment_method']='paypal';
            $order_data['payment_status']='paid';
        }
        else{
            $order_data['payment_method']='cod';
            $order_data['payment_status']='unpaid';
        }
            $order->fill($order_data);

            try {
                $status = $order->save();
                $saved = (bool) $status;
            } catch (QueryException $e) {
                // Duplicate order number (unique index) - regenerate.
                $order->exists = false;
                $order->id = null;
                if ($attempt >= $maxAttempts) {
                    throw $e;
                }
                continue;
            }
        }

        $status = $saved;
        if ($order) {
            // Notify admin + sales admin users (email + database notification).
            // If the order is assigned to a sales staff member, notify only that sales admin; otherwise notify all sales admins.
            $recipients = collect();

            $recipients = $recipients->merge(User::where('role', 'admin')->get());

            if (!empty($order->sales_staff_id)) {
                $recipients = $recipients->merge(
                    User::where('id', $order->sales_staff_id)
                        ->where('role', 'sales_admin')
                        ->get()
                );
            } else {
                $recipients = $recipients->merge(User::where('role', 'sales_admin')->get());
            }

            $recipients = $recipients->unique('id')->values();

            $details = [
                'title' => 'New order created',
                'actionURL' => route('order.show', $order->id),
                'fas' => 'fa-file-alt',
            ];

            if ($recipients->isNotEmpty()) {
                Notification::send($recipients, new StatusNotification($details));
            }
        }

        // Log SMS (billing/notification) entry (provider integration can be added later)
        $itemNames = $cartItems
            ->map(function ($cart) {
                return $cart->product->title ?? null;
            })
            ->filter()
            ->values()
            ->all();

        $itemsText = !empty($itemNames) ? implode(', ', $itemNames) : 'N/A';

        $greetingName = trim((string) ($order->first_name ?? ''));
        if ($greetingName === '') {
            $greetingName = trim((string) ($order->first_name ?? '').' '.(string) ($order->last_name ?? ''));
        }
        if ($greetingName === '') {
            $greetingName = 'Customer';
        }

        $paymentStatusText = strtoupper((string) ($order->payment_status ?? ''));
        if ($paymentStatusText === '') {
            $paymentStatusText = 'N/A';
        }

        $this->logOrderSms(
            $order,
            'Dear '.$greetingName.', your order placed successfully. Items: '.$itemsText.' | Order No: '.$order->order_number.' | Status: '.(string) $order->status.' | Payment Status: '.$paymentStatusText.' | Total Price: LKR '.$order->total_amount.' | Payment Method: '.$order->payment_method,
            'queued',
            null
        );
        if(request('payment_method')=='paypal'){
            return redirect()->route('payment')->with(['id'=>$order->id]);
        }
        else{
            session()->forget('cart');
            session()->forget('coupon');
        }
        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $order->id]);

        // dd($users);        
        request()->session()->flash('success','Your product successfully placed in order');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::with('salesStaff:id,name')->find($id);
        if ($order && auth()->check() && auth()->user()->role === 'sales_admin') {
            if ((int) $order->sales_staff_id !== (int) auth()->id()) {
                abort(403);
            }
        }
        // return $order;
        return view('backend.order.show')->with('order',$order);
    }

    public function exportByDateExcel(Request $request)
    {
        $validated = $request->validate([
            'date' => 'nullable|date',
            'status' => 'nullable|in:new,pending,process,ship,delivered,cancel',
        ]);

        $date = $validated['date'] ?? null;
        $status = $validated['status'] ?? null;
        if ($status === 'pending') {
            $status = 'ship';
        }

        $items = Cart::query()
            ->with(['product', 'order.shipping'])
            ->whereNotNull('order_id')
            ->whereHas('order', function ($q) use ($date, $status) {
                if (!empty($date)) {
                    $q->whereDate('created_at', $date);
                }

                if (!empty($status)) {
                    if ($status === 'ship') {
                        $q->whereIn('status', ['ship', 'pending']);
                    } else {
                        $q->where('status', $status);
                    }
                }

                if (auth()->check() && auth()->user()->role === 'sales_admin') {
                    $q->where('sales_staff_id', auth()->id());
                }
            })
            ->orderBy('order_id')
            ->get();

        $filenameParts = ['orders'];
        if (!empty($status)) {
            $filenameParts[] = $status;
        }
        if (!empty($date)) {
            $filenameParts[] = $date;
        }
        $filename = implode('-', $filenameParts) . '.xlsx';
        return Excel::download(new OrderItemsExport($items), $filename);
    }

    public function exportSingleExcel(Order $order)
    {
        if (auth()->check() && auth()->user()->role === 'sales_admin') {
            if ((int) $order->sales_staff_id !== (int) auth()->id()) {
                abort(403);
            }
        }
        $items = Cart::query()
            ->with(['product', 'order.shipping'])
            ->where('order_id', $order->id)
            ->orderBy('id')
            ->get();

        $filename = 'order-' . ($order->order_number ?? $order->id) . '.xlsx';
        return Excel::download(new OrderItemsExport($items), $filename);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=Order::find($id);

        if ($order && auth()->check() && auth()->user()->role === 'sales_admin') {
            if ((int) $order->sales_staff_id !== (int) auth()->id()) {
                abort(403);
            }
        }

        $salesAdmins = [];
        if (auth()->check() && auth()->user()->role === 'admin') {
            $salesAdmins = User::query()
                ->where('role', 'sales_admin')
                ->where('status', 'active')
                ->orderBy('name')
                ->get(['id', 'name', 'email']);
        }

        return view('backend.order.edit', [
            'order' => $order,
            'salesAdmins' => $salesAdmins,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order=Order::find($id);
        if ($order && auth()->check() && auth()->user()->role === 'sales_admin') {
            if ((int) $order->sales_staff_id !== (int) auth()->id()) {
                abort(403);
            }
        }

        $originalStatus = (string) ($order->status ?? '');
        $originalPaymentStatus = (string) ($order->payment_status ?? '');

        $this->validate($request,[
            'status'=>'required|in:new,pending,process,ship,delivered,returned,cancel',
            'courier_name' => 'nullable|string|max:100',
            'courier_tracking_number' => 'nullable|string|max:150',
            'payment_status' => 'nullable|in:paid,unpaid',
            'return_reason_option' => [
                Rule::requiredIf(function () use ($request) {
                    return (string) $request->input('status') === 'returned';
                }),
                'nullable',
                'string',
                Rule::in([
                    'Damaged product',
                    'Wrong item delivered',
                    'Size/Color issue',
                    'Customer changed mind',
                    'Late delivery',
                    'other',
                ]),
            ],
            'return_reason_custom' => [
                Rule::requiredIf(function () use ($request) {
                    return (string) $request->input('status') === 'returned'
                        && (string) $request->input('return_reason_option') === 'other';
                }),
                'nullable',
                'string',
                'max:2000',
            ],
            'sales_staff_id' => [
                'nullable',
                'integer',
                Rule::exists('users', 'id')->where(function ($q) {
                    $q->where('role', 'sales_admin');
                }),
            ],
        ]);

        $data=$request->all();

        // Normalize legacy status.
        if (($data['status'] ?? null) === 'pending') {
            $data['status'] = 'ship';
        }

        if (($data['status'] ?? null) === 'returned') {
            $option = (string) ($data['return_reason_option'] ?? '');
            $custom = trim((string) ($data['return_reason_custom'] ?? ''));

            $data['return_reason'] = $option === 'other' ? $custom : $option;
        }

        // Do not allow changing a returned order back to another status.
        if ($originalStatus === 'returned' && ($data['status'] ?? null) !== 'returned') {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['status' => 'A returned order cannot be changed to another status.']);
        }

        // Only allow marking as returned if it was already delivered.
        if (($data['status'] ?? null) === 'returned' && $originalStatus !== 'delivered') {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['status' => 'You can only mark an order as returned after it has been delivered.']);
        }

        // Only store courier tracking details when the order is delivered.
        if (($data['status'] ?? null) !== 'delivered') {
            // Explicitly clear so any legacy/TRN value does not persist.
            $data['courier_tracking_number'] = null;
        }

        // Only store return fields when the order is returned.
        if (($data['status'] ?? null) !== 'returned') {
            unset($data['return_reason']);
        }

        unset($data['return_reason_option'], $data['return_reason_custom']);

        // Only the main admin can assign/unassign sales admins.
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            unset($data['sales_staff_id']);
            unset($data['payment_status']);
        }

        $isReturnTransition = ($originalStatus !== (string) ($data['status'] ?? ''))
            && ($originalStatus === 'delivered')
            && ((string) ($data['status'] ?? '') === 'returned');

        if ($isReturnTransition) {
            $data['returned_at'] = $order->returned_at ?: now();
        }

        $status=$order->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated order');

            // Decrement product stock only once when transitioning to delivered.
            $statusText = $order->status;
            $isDeliveredTransition = ($originalStatus !== (string) $statusText) && ((string) $statusText === 'delivered');
            if ($isDeliveredTransition) {
                foreach ($order->cart as $cart) {
                    $product = $cart->product;
                    if ($product) {
                        $product->stock = max(0, (int) $product->stock - (int) $cart->quantity);
                        $product->save();
                    }

                    // If this order is assigned to a sales admin, reduce their allocated stock too.
                    if (!empty($order->sales_staff_id) && !empty($cart->product_id)) {
                        $alloc = SalesAdminProductStock::query()->where([
                            'sales_admin_id' => $order->sales_staff_id,
                            'product_id' => $cart->product_id,
                        ])->first();
                        if ($alloc) {
                            $alloc->quantity = max(0, (int) $alloc->quantity - (int) $cart->quantity);
                            $alloc->save();
                        }
                    }
                }
            }

            // Restore stock only once when transitioning delivered -> returned.
            $isReturnTransitionAfterSave = ($originalStatus !== (string) $statusText) && ($originalStatus === 'delivered') && ((string) $statusText === 'returned');
            if ($isReturnTransitionAfterSave) {
                foreach ($order->cart as $cart) {
                    $product = $cart->product;
                    if ($product) {
                        $product->stock = (int) $product->stock + (int) $cart->quantity;
                        $product->save();
                    }

                    if (!empty($order->sales_staff_id) && !empty($cart->product_id)) {
                        $alloc = SalesAdminProductStock::query()->firstOrNew([
                            'sales_admin_id' => $order->sales_staff_id,
                            'product_id' => $cart->product_id,
                        ]);

                        $alloc->quantity = (int) $alloc->quantity + (int) $cart->quantity;
                        $alloc->save();
                    }
                }
            }

            // If admin marked the order as paid (COD/manual payment), send payment received notification.
            $newPaymentStatus = (string) ($order->payment_status ?? '');
            if ($originalPaymentStatus !== 'paid' && $newPaymentStatus === 'paid') {
                $greetingName = trim((string) ($order->first_name ?? ''));
                if ($greetingName === '') {
                    $greetingName = trim((string) ($order->first_name ?? '').' '.(string) ($order->last_name ?? ''));
                }
                if ($greetingName === '') {
                    $greetingName = 'Customer';
                }

                $itemNames = $order->cart()
                    ->with('product:id,title')
                    ->get()
                    ->map(function ($cart) {
                        return $cart->product->title ?? null;
                    })
                    ->filter()
                    ->values()
                    ->all();
                $itemsText = !empty($itemNames) ? implode(', ', $itemNames) : 'N/A';

                $paymentStatusText = strtoupper((string) ($order->payment_status ?? ''));
                if ($paymentStatusText === '') {
                    $paymentStatusText = 'N/A';
                }
                $this->logOrderSms(
                    $order,
                    'Dear '.$greetingName.', payment received for your order. Items: '.$itemsText.' | Order No: '.$order->order_number.' | Payment Status: '.$paymentStatusText.' | Total: '.$order->total_amount.' | Method: '.strtoupper((string) $order->payment_method),
                    'queued',
                    null
                );
            }

            // Log SMS entry for status/courier updates
            $extra = [];
            if (!empty($order->courier_name)) {
                $extra[] = 'Courier: '.$order->courier_name;
            }
            if (!empty($order->courier_tracking_number)) {
                $extra[] = 'Courier Tracking: '.$order->courier_tracking_number;
            }
            $suffix = empty($extra) ? '' : ' | '.implode(' | ', $extra);
            $messagePrefix = $isDeliveredTransition ? 'Order delivered.' : 'Order update.';

            $greetingName = trim((string) ($order->first_name ?? ''));
            if ($greetingName === '') {
                $greetingName = trim((string) ($order->first_name ?? '').' '.(string) ($order->last_name ?? ''));
            }
            if ($greetingName === '') {
                $greetingName = 'Customer';
            }

            $itemNames = $order->cart()
                ->with('product:id,title')
                ->get()
                ->map(function ($cart) {
                    return $cart->product->title ?? null;
                })
                ->filter()
                ->values()
                ->all();
            $itemsText = !empty($itemNames) ? implode(', ', $itemNames) : 'N/A';

            $paymentStatusText = strtoupper((string) ($order->payment_status ?? ''));
            if ($paymentStatusText === '') {
                $paymentStatusText = 'N/A';
            }

            $this->logOrderSms(
                $order,
                'Dear '.$greetingName.', '.$messagePrefix.' Items: '.$itemsText.' | Order No: '.$order->order_number.' | Status: '.$statusText.' | Payment Status: '.$paymentStatusText.$suffix,
                'queued',
                null
            );
        }
        else{
            request()->session()->flash('error','Error while updating order');
        }
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=Order::find($id);

        // Sales admins cannot delete orders.
        if (auth()->check() && auth()->user()->role === 'sales_admin') {
            abort(403);
        }
        if($order){
            $status=$order->delete();
            if($status){
                request()->session()->flash('success','Order Successfully deleted');
            }
            else{
                request()->session()->flash('error','Order can not deleted');
            }
            return redirect()->route('order.index');
        }
        else{
            request()->session()->flash('error','Order can not found');
            return redirect()->back();
        }
    }

    public function orderTrack(){
        return view('frontend.pages.order-track');
    }

    public function productTrackOrder(Request $request){
        $this->validate($request,[
            'order_number' => 'required|string'
        ]);

        // If logged in, restrict to the user's orders.
        // If guest, allow lookup by order number only.
        $query = Order::query()->where('order_number', $request->order_number);

        if (auth()->check()) {
            $query->where('user_id', auth()->user()->id);
        }

        $order = $query->first();

        if(!$order){
            request()->session()->flash('error','Invalid order number please try again');
            return back();
        }

        $trackings = $order->shipmentTrackings()->orderBy('event_time','desc')->orderBy('id','desc')->get();
        return view('frontend.pages.order-track')->with(['order' => $order, 'trackings' => $trackings]);
    }

    // PDF generate
    public function pdf($id){
        // Require authentication to download invoices.
        if (!auth()->check()) {
            abort(403);
        }

        $order=Order::getAllOrder($id);
        if(!$order){
            request()->session()->flash('error','Order not found');
            return redirect()->back();
        }

        // Authorization:
        // - admin (and any legacy staff roles) can download any invoice
        // - sales_admin can download invoices for orders assigned to them
        // - regular users can download their own invoices
        $role = (string) (auth()->user()->role ?? '');

        $staffRoles = ['admin', 'staff', 'seller', 'salesman', 'manager', 'superadmin'];
        $isStaff = in_array($role, $staffRoles, true);

        if ($role === 'sales_admin') {
            if ((int) $order->sales_staff_id !== (int) auth()->id()) {
                abort(403);
            }
        } elseif (!$isStaff) {
            if ((int) $order->user_id !== (int) auth()->id()) {
                abort(403);
            }
        }

        $file_name=$order->order_number.'-'.$order->first_name.'.pdf';
        // Dompdf can time out if it tries to fetch remote assets; keep rendering self-contained.
        // Also raise the execution time limit for PDF generation only.
        @set_time_limit(180);
        $pdf=PDF::loadview('backend.order.pdf',compact('order'));
        if (method_exists($pdf, 'setOptions')) {
            $pdf->setOptions(['isRemoteEnabled' => false]);
        }
        $pdf->setPaper('a4');
        return $pdf->download($file_name);
    }
    // Income chart
    public function incomeChart(Request $request){
        $year=\Carbon\Carbon::now()->year;
        // dd($year);
        $items=Order::with(['cart_info'])->whereYear('created_at',$year)->where('status','delivered')->get()
            ->groupBy(function($d){
                return \Carbon\Carbon::parse($d->created_at)->format('m');
            });
            // dd($items);
        $result=[];
        foreach($items as $month=>$item_collections){
            foreach($item_collections as $item){
                $amount=$item->cart_info->sum('amount');
                // dd($amount);
                $m=intval($month);
                // return $m;
                isset($result[$m]) ? $result[$m] += $amount :$result[$m]=$amount;
            }
        }
        $data=[];
        for($i=1; $i <=12; $i++){
            $monthName=date('F', mktime(0,0,0,$i,1));
            $data[$monthName] = (!empty($result[$i]))? number_format((float)($result[$i]), 2, '.', '') : 0.0;
        }
        return $data;
    }
}
