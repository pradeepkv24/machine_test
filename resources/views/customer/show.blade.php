@extends('layouts.customer.app')
@section('title', 'Order Details')
@section('styles')
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Order Details</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Order Detail</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
            
            <div class="row">
              <div class="col-12">
                <h5>Pickup Address</h5>
                  <div class="post">
                    <!-- /.user-block -->
                    <p>
                      <i class="fas fa-fw fa-building"></i>Address :  <br>{{ $order->pickupAddress->full_name }},
                      {{ $order->pickupAddress->house_name }}, {{ $order->pickupAddress->street }}<br>
                      {{ $order->pickupAddress->city }}, {{ $order->pickupAddress->pincode }} 
                      <br>
                      <i class="fas fa-fw fa-phone"></i>Phone : {{ $order->pickupAddress->mobile }}
                    </p>
                  </div>
                  <h5>Delivery Address</h5>

                  <div class="post clearfix">
                    
                    <!-- /.user-block -->
                    <p>
                      <i class="fas fa-fw fa-building"></i>Address :  <br>{{ $order->deliveryAddress->full_name }},
                      {{ $order->deliveryAddress->house_name }}, {{ $order->deliveryAddress->street }}<br>
                      {{ $order->deliveryAddress->city }}, {{ $order->deliveryAddress->pincode }} 
                      <br>
                      <i class="fas fa-fw fa-phone"></i>Phone : {{ $order->deliveryAddress->mobile }}
                    </p>
                    
                  </div>
                  
                  <div class="alert {{ $order->status!=3 ? 'alert-info' : 'alert-success'  }}">
                    <h5><i class="icon fas {{ $order->status!=3 ? 'fa-info' : 'fa-check'  }}"></i> Tracking info!</h5>
                    @if ($order->status==0)
                      Pending
                    @else
                      @if ($order->pickup)
                      Pickup at {{ \Carbon\Carbon::parse($order->pickup)->format('d/m/Y h:i A')}}
                      @else
                      Expected Pickup {{ $order->expected_pickup}}  
                      @endif , 
                      @if ($order->delivered)
                      Delivered at {{ \Carbon\Carbon::parse($order->delivered)->format('d/m/Y h:i A')}}
                      @else
                      Expected Delivery {{ $order->expected_pickup}}  
                      @endif
                    @endif
                    
                  </div>
                    
                  
                  
                  
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
            @if ($order->status!=0)
            <h5 class="text-primary"> Deliveryboy details</h5>
            
            <br>
            <div class="text-muted">
              <p class="text-sm">Name
                <b class="d-block">{{ $order->deliveryboy->name }}</b>
              </p>
              <p><i class=" fa-fw fas fa-phone-square-alt"></i>{{ $order->deliveryboy->mobile }}</p>
              <p><i class="far fa-fw fa-envelope"></i>{{ $order->deliveryboy->email }}</p>
            </div> 
            @endif
            

            
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->


@endsection
@section('javascript')
@stop