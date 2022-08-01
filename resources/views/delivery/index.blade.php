@extends('layouts.delivery.app')
@section('title', 'Open Orders')
@section('styles')
@stop
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Open Orders</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
   <!-- Main content -->
   <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Open Orders</h3>

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
                    <th style="width: 20%">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
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
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('delivery_show',$order->id) }}">
                            <i class="fas fa-folder">
                            </i>
                            View
                        </a>        
                    </td>
                </tr>   
                @endforeach
                
            </tbody>
        </table>
        {!! $orders->links() !!}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection
@section('javascript')

<script>
    $(document).ready(function(){
    localStorage.setItem('redirect','openOrder');
    });
</script>
@stop