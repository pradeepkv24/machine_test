@extends('layouts.delivery.app')
@section('title', 'My Order')
@section('styles')
@stop
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Orders</h1>
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
        <h3 class="card-title">Order List</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>          
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 15%">
                        Order ID
                    </th>
                    <th style="width: 20%">
                        Customer
                    </th>
                    <th>
                        Mobile
                    </th>
                    <th>
                        Pickup City
                    </th>
                    <th>
                        Delivery City
                    </th>
                    <th>
                        Status
                    </th>
                    <th style="width: 20%">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order )
                <tr>
                    <td>
                        {{ ++$i }}
                    </td>
                    <td>
                        <a>
                            {{ $order->GenOrderId }}
                        </a>
                        <br/>
                        <small>
                            Date {{ \Carbon\Carbon::parse($order->created_at)->toFormattedDateString()}}
                        </small>
                    </td>
                    <td>
                        {{ $order->customer->name }}
                    </td>
                    <td class="project_progress">
                        {{ $order->customer->mobile }}
                    </td>
                    <td>
                        {{ $order->pickupAddress->city }}
                    </td>
                    <td>
                        {{ $order->deliveryAddress->city }}
                    </td>
                    <td class="project-state">
                        @switch($order->status)
                        @case(1)
                        <span class="badge badge-danger">Pickup pending</span> 
                            @break
                        @case(2)
                        <span class="badge badge-info">Picked</span> 
                            @break
                        @case(3)
                        <span class="badge badge-success">Delivered</span> 
                            @break
                    
                        @default
                        <span class="badge badge-secondary">pending</span> 
                            
                    @endswitch
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('delivery_show',$order->id) }}">
                            <i class="fas fa-folder">
                            </i>
                            View
                        </a>
                        @if ($order->status!=3)
                        <input type="hidden" class="order_id" value="{{ $order->id }}">
                        <button  class="btn {{ $order->status==1 ? 'btn-info' : 'btn-success'  }} btn-sm btn-changer" >
                            <i class="fas fa-truck">
                            </i>
                            {{ $order->status==1 ? 'Pickup' : 'Delivered'  }}
                        </button>    
                        @endif    
                    </td>
                </tr>    
                @endforeach   
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection
@section('javascript')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

<script>
$(document).ready(function(){
    localStorage.setItem('redirect','myOrder');

    $(".btn-changer").click(function() {
      
        var $row = $(this).closest("tr");    
        var orderId = $row.find(".order_id").val(); 
        bootbox.confirm("Are you sure?",function(result){
            var fd = new FormData();
            fd.append( 'orderId', orderId);      
            $("#overlay").show();
            $.ajax
            ({
                type:"POST",
                url:"{{ route('delivery_status_change') }}",
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