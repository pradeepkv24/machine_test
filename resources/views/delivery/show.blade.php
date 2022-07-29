@extends('layouts.delivery.app')
@section('title', 'Order Details')
@section('styles')
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('design/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
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
  <div class="alert alert-danger print-error-msg" style="display:none">
    <ul></ul>
  </div>
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
                  <!-- /.address-block -->
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
                  
                  <!-- /.address-block -->
                  <p>
                    <i class="fas fa-fw fa-building"></i>Address :  <br>{{ $order->deliveryAddress->full_name }},
                    {{ $order->deliveryAddress->house_name }}, {{ $order->deliveryAddress->street }}<br>
                    {{ $order->deliveryAddress->city }}, {{ $order->deliveryAddress->pincode }} 
                    <br>
                    <i class="fas fa-fw fa-phone"></i>Phone : {{ $order->deliveryAddress->mobile }}
                  </p>    
                </div> 
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
          <h5 class="text-primary"> Delivery Details</h5>          
          <br>
          <!-- Date and time -->
          <div class="form-group">
            <label>Expected Pickup date and time:</label>
              <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                  <input type="text" id="expectedPickup" value="{{ $order->expected_pickup }}" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                  <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>
          <!-- Date and time -->
          <div class="form-group">
            <label>Expected Delivery date and time:</label>
              <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                  <input type="text" id="expectedDelivery" value="{{ $order->expected_delivered }}" class="form-control datetimepicker-input" data-target="#reservationdatetime2"/>
                  <div class="input-group-append" data-target="#reservationdatetime2" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>
          <button id="accept_order" class="btn btn-primary" style="float: right;">Accept Order</button>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('design/plugins/moment/moment.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('design/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>
  $(function () {
    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' },minDate:new Date() });

    $('#reservationdatetime2').datetimepicker({ icons: { time: 'far fa-clock' } ,minDate:new Date()});
  })
  $("#accept_order").click(function() {
  
  var expectedPickup = $("#expectedPickup").val();
  var expectedDelivery = $("#expectedDelivery").val();
  var orderId = {{ $order->id }};

  var fd = new FormData();
  fd.append( 'expectedPickup', expectedPickup); 
  fd.append( 'expectedDelivery', expectedDelivery); 
  fd.append( 'orderId', orderId);  
     
  $("#overlay").show();
  $.ajax
  ({
      type:"POST",
      url:"{{ route('delivery_accept_order') }}",
      dataType:"json",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: fd,
      contentType: false,
      processData: false,

      success:function(data)
      { 
        if($.isEmptyObject(data.error)){
          toastr.success(data.success);
          // location.reload();
          if(localStorage.getItem('redirect')=='myOrder'){
            window.location.href = "/delivery/my_order";
          }else{
            window.location.href = "/delivery/order";
          }
          
          
        }else{
         printErrorMsg(data.error);
        }
        
      },
      complete: function(){
        // Handle the complete event
        $("#overlay").hide();
        
      }


    });
 }); 

 function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
  }

</script>
@stop