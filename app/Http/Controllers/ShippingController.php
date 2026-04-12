<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Coupon;
use App\Models\Settings;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping=Shipping::orderBy('id','DESC')->paginate(10);
        $settings = Settings::first();

        return view('backend.shipping.index')->with([
            'shippings' => $shipping,
            'settings' => $settings,
        ]);
    }

    public function updateWeightRates(Request $request)
    {
        $this->validate($request, [
            'shipping_cost_upto_1kg' => 'required|integer|min:0',
            'shipping_cost_over_1kg_extra' => 'required|integer|min:0',
        ]);

        $settings = Settings::first();
        if (!$settings) {
            request()->session()->flash('error', 'Settings not found. Please save Site Settings first.');
            return redirect()->route('settings');
        }

        $settings->shipping_cost_upto_1kg = (int) $request->input('shipping_cost_upto_1kg');
        $settings->shipping_cost_over_1kg_extra = (int) $request->input('shipping_cost_over_1kg_extra');

        $status = $settings->save();

        if ($status) {
            request()->session()->flash('success', 'Weight-based shipping rates updated');
        } else {
            request()->session()->flash('error', 'Error, Please try again');
        }

        return redirect()->route('shipping.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'type'=>'string|required',
            'price'=>'nullable|numeric',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        // return $data;
        $status=Shipping::create($data);
        if($status){
            request()->session()->flash('success','Shipping successfully created');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('shipping.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping=Shipping::find($id);
        if(!$shipping){
            request()->session()->flash('error','Shipping not found');
        }
        return view('backend.shipping.edit')->with('shipping',$shipping);
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
        $shipping=Shipping::find($id);
        $this->validate($request,[
            'type'=>'string|required',
            'price'=>'nullable|numeric',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        // return $data;
        $status=$shipping->fill($data)->save();
        if($status){
            request()->session()->flash('success','Shipping successfully updated');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('shipping.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping=Shipping::find($id);
        if($shipping){
            $status=$shipping->delete();
            if($status){
                request()->session()->flash('success','Shipping successfully deleted');
            }
            else{
                request()->session()->flash('error','Error, Please try again');
            }
            return redirect()->route('shipping.index');
        }
        else{
            request()->session()->flash('error','Shipping not found');
            return redirect()->back();
        }
    }
}
