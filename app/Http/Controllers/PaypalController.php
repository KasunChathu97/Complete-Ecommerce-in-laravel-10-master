<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\SmsLog;
use Illuminate\Http\Request;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function payment()
    {
        $cart = Cart::where('user_id', auth()->user()->id)
            ->where('order_id', null)
            ->get()
            ->toArray();
        
        $data = [];
        
        // return $cart;
        $data['items'] = array_map(function ($item) {
            $name = Product::where('id', $item['product_id'])->value('title');
            return [
                'name' => $name ?? 'Item',
                'price' => $item['price'],
                'desc'  => 'Thank you for using paypal',
                'qty' => $item['quantity']
            ];
        }, $cart);

        $data['invoice_id'] ='ORD-'.strtoupper(uniqid());
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');

        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $data['total'] = $total;
        if(session('coupon')){
            $data['shipping_discount'] = session('coupon')['value'];
        }
        $orderId = session()->get('id');
        if (empty($orderId)) {
            request()->session()->flash('error', 'Missing order reference for PayPal payment. Please checkout again.');
            return redirect()->route('checkout');
        }

        try {
            $provider = new PayPalClient();
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $currency = config('paypal.currency', 'USD');

            $response = $provider->createOrder([
                'intent' => 'CAPTURE',
                'application_context' => [
                    'return_url' => $data['return_url'],
                    'cancel_url' => $data['cancel_url'],
                ],
                'purchase_units' => [
                    [
                        'reference_id' => (string) $orderId,
                        'description' => $data['invoice_description'],
                        'amount' => [
                            'currency_code' => $currency,
                            'value' => number_format((float) $data['total'], 2, '.', ''),
                        ],
                    ],
                ],
            ]);

            if (empty($response['links']) || !is_array($response['links'])) {
                throw new \RuntimeException('Invalid PayPal response.');
            }

            $approveLink = null;
            foreach ($response['links'] as $link) {
                if (($link['rel'] ?? null) === 'approve') {
                    $approveLink = $link['href'] ?? null;
                    break;
                }
            }

            if (empty($approveLink)) {
                throw new \RuntimeException('PayPal approval link not found.');
            }

            // Attach cart items to the created order only after PayPal order is created.
            Cart::where('user_id', auth()->user()->id)
                ->where('order_id', null)
                ->update(['order_id' => $orderId]);

            return redirect($approveLink);
        } catch (\Throwable $e) {
            request()->session()->flash('error', 'PayPal is not configured or unavailable right now. Please use Cash on Delivery.');
            return redirect()->route('checkout');
        }
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $token = (string) $request->get('token');
        if (empty($token)) {
            request()->session()->flash('error', 'Missing PayPal token.');
            return redirect()->route('checkout');
        }

        try {
            $provider = new PayPalClient();
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $response = $provider->capturePaymentOrder($token);

            if (($response['status'] ?? null) === 'COMPLETED') {
                $orderId = session()->get('id');
                if (!empty($orderId)) {
                    Order::where('id', $orderId)->update([
                        'payment_method' => 'paypal',
                        'payment_status' => 'paid',
                    ]);

                    $order = Order::find($orderId);
                    if ($order && !empty($order->phone)) {
                        SmsLog::create([
                            'order_id' => $order->id,
                            'phone' => (string) $order->phone,
                            'message' => 'Payment received. Order No: '.$order->order_number.' | Total: '.$order->total_amount.' | Method: PayPal',
                            'provider' => config('services.sms.provider'),
                            'status' => 'queued',
                            'sent_at' => null,
                            'provider_response' => null,
                            'created_by' => null,
                        ]);
                    }
                }

                request()->session()->flash('success', 'You successfully paid with PayPal!');
                session()->forget('cart');
                session()->forget('coupon');
                session()->forget('id');
                return redirect()->route('home');
            }

            request()->session()->flash('error', 'PayPal payment was not completed.');
            return redirect()->route('checkout');
        } catch (\Throwable $e) {
            request()->session()->flash('error', 'PayPal payment verification failed. Please try again or use COD.');
            return redirect()->route('checkout');
        }
    }
}
