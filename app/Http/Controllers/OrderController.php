<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerId = Auth::user()->id; 
        $orders = Order::where('customer_id',$customerId)->latest()->paginate(10);
            $data=array(
           'orders' => $orders,
           'i'=> (request()->input('page', 1) - 1) * 10,
            
        );
        return view('customer.index',$data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pickupName' => 'required|regex:/^[a-zA-Z- ]+$/u',
            'pickupHouseName' => 'required|regex:/^[a-zA-Z- ]+$/u',
            'pickupStreetName' => 'required|regex:/^[a-zA-Z- ]+$/u',
            'pickupCity' => 'required|regex:/^[a-zA-Z- ]+$/u',
            'pickupPincode' => 'required|numeric|digits:6',
            'pickupMobile' => 'required|numeric|digits:10',
            'deliveryName' => 'required|regex:/^[a-zA-Z- ]+$/u',
            'deliveryHouseName' => 'required|regex:/^[a-zA-Z- ]+$/u',
            'deliveryStreetName' => 'required|regex:/^[a-zA-Z- ]+$/u',
            'deliveryCity' => 'required|regex:/^[a-zA-Z- ]+$/u',
            'deliveryPincode' => 'required|numeric|digits:6',
            'deliveryMobile' => 'required|numeric|digits:10',
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
        
        $pickupAddress=Address::create([
            'full_name' => $request->pickupName,
            'house_name' => $request->pickupHouseName,
            'street' => $request->pickupStreetName,
            'city' => $request->pickupCity,
            'pincode' => $request->pickupPincode,
            'mobile' => $request->pickupMobile,
        ]);

        $deliveryAddress=Address::create([
            'full_name' => $request->deliveryName,
            'house_name' => $request->deliveryHouseName,
            'street' => $request->deliveryStreetName,
            'city' => $request->deliveryCity,
            'pincode' => $request->deliveryPincode,
            'mobile' => $request->deliveryMobile,
        ]);
        
        $customerId = Auth::user()->id; 
        Order::create([
            'customer_id' => $customerId,
            'pickup_address_id' => $pickupAddress->id,
            'delivery_address_id' => $deliveryAddress->id,
        ]);
  
        return response()->json(['success' => 'Order created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('customer.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
