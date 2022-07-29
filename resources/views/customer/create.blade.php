@extends('layouts.customer.app')
@section('title', 'Create Order')
@section('styles')
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Create Order</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <div class="alert alert-danger print-error-msg" style="display:none">
    <ul></ul>
  </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Pickup Address</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="pickupName">Full Name</label>
                  <input type="text" id="pickupName" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="pickupHouseName">House Name</label>
                  <input type="text" id="pickupHouseName" class="form-control">
                </div>
              </div>
            </div>
           <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="pickupStreetName">Street Name</label>
                  <input type="text" id="pickupStreetName" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="pickupCity">City</label>
                  <input type="text" id="pickupCity" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="pickupPincode">Pincode</label>
                  <input type="text" id="pickupPincode" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="pickupMobile">Mobile</label>
                  <input type="text" id="pickupMobile" class="form-control">
                </div> 
              </div>
            </div>  
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Delivery Address</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="deliveryName">Full Name</label>
                  <input type="text" id="deliveryName" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="deliveryHouseName">House Name</label>
                  <input type="text" id="deliveryHouseName" class="form-control">
                </div>
              </div>
            </div>            
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="deliveryStreetName">Street Name</label>
                  <input type="text" id="deliveryStreetName" class="form-control">
                </div> 
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="deliveryCity">City</label>
                  <input type="text" id="deliveryCity" class="form-control">
                </div>
              </div>
            </div>            
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="deliveryPincode">Pincode</label>
                  <input type="text" id="deliveryPincode" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="deliveryMobile">Mobile</label>
                  <input type="text" id="deliveryMobile" class="form-control">
                </div>
              </div>
            </div>  
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <input type="submit" id="create_order" value="Create an order" class="btn btn-success float-right">
      </div>
    </div>
    <br>
    <br>
  </section>
  <!-- /.content -->
<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
@endsection
@section('javascript')

<script type="text/javascript">
$("#create_order" ).click(function() {
  
  var pickupName = $("#pickupName").val();
  var pickupHouseName = $("#pickupHouseName").val();
  var pickupStreetName = $("#pickupStreetName").val();
  var pickupCity = $("#pickupCity").val();
  var pickupPincode = $("#pickupPincode").val();
  var pickupMobile = $("#pickupMobile").val();
  var deliveryName = $("#deliveryName").val();
  var deliveryHouseName = $("#deliveryHouseName").val();
  var deliveryStreetName = $("#deliveryStreetName").val();
  var deliveryCity = $("#deliveryCity").val();
  var deliveryPincode = $("#deliveryPincode").val();
  var deliveryMobile = $("#deliveryMobile").val();

  var fd = new FormData();
  fd.append( 'pickupName', pickupName); 
  fd.append( 'pickupHouseName', pickupHouseName); 
  fd.append( 'pickupStreetName', pickupStreetName);  
  fd.append( 'pickupCity', pickupCity);  
  fd.append( 'pickupPincode', pickupPincode);  
  fd.append( 'pickupMobile', pickupMobile); 
  fd.append( 'deliveryName', deliveryName); 
  fd.append( 'deliveryHouseName', deliveryHouseName);  
  fd.append( 'deliveryStreetName', deliveryStreetName);  
  fd.append( 'deliveryCity', deliveryCity);
  fd.append( 'deliveryPincode', deliveryPincode); 
  fd.append( 'deliveryMobile', deliveryMobile);    
  $("#overlay").show();
  $.ajax
  ({
      type:"POST",
      url:"{{ route('order.store') }}",
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
          location.reload();
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