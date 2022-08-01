<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Address;
use Carbon\Carbon;
use Redirect;

class DeliveryController extends Controller
{
    /**
     * Display a listing of all the open orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status','0')->latest()->paginate(10);
            $data=array(
           'orders' => $orders,
           'i'=> (request()->input('page', 1) - 1) * 10,
            
        );
        return view('delivery.index',$data); 
    }
    
    /**
     * Display the order details.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::where('id',$id)
                      ->with('pickupAddress')
                      ->with('deliveryAddress')
                      ->first();

        $deliverboyId = Auth::user()->id; 
        if($order->deliveryboy_id!=null && $order->deliveryboy_id!=$deliverboyId ){
            
            return redirect()->route('delivery_my_order');
        }

        return view('delivery.show',compact('order'));
    }
    
    /**
     * Take open orders deliveryboy.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function accept_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'expectedPickup' => 'required',
            'expectedDelivery' => 'required',
            'orderId' => 'required|numeric',
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
        $deliverboyId = Auth::user()->id; 

        $order=Order::where('id',$request->orderId)->first();
        $order->deliveryboy_id=$deliverboyId;
        $order->expected_pickup=$request->expectedPickup;
        $order->expected_delivered=$request->expectedDelivery;
        $order->status='1';
        $order->save();
  
        return response()->json(['success' => 'Order accepted successfully.']);
    }
    /**
     * Display a listing of accepted orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_order()
    {
        $deliverboyId = Auth::user()->id; 
        $orders = Order::where('deliveryboy_id',$deliverboyId)->latest()->paginate(10);
            $data=array(
           'orders' => $orders,
           'i'=> (request()->input('page', 1) - 1) * 10,
            
        );
        return view('delivery.my_order',$data);
    }
    /**
     * Change the delivery status by deliveryboy.
     *
     * @return \Illuminate\Http\Response
     */
    public function status_change(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orderId' => 'required',
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
        
        $deliverboyId = Auth::user()->id; 
        $order=Order::where('id',$request->orderId)->where('deliveryboy_id',$deliverboyId)->first();
        if($order->status=='1'){
            $order->pickup=Carbon::now();
            $order->status='2';
        }else if($order->status=='2'){
            $order->delivered=Carbon::now();
            $order->status='3';
        }
        $order->save();
  
        return response()->json(['success' => 'Order status changed successfully.']);
    }
}
