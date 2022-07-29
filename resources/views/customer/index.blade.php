@extends('layouts.customer.app')
@section('title', 'My Orders')
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

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Projects</h3>

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
                  <th style="width: 20%">
                      Order ID
                  </th>
                  <th style="width: 30%">
                      Delivery Boy
                  </th>
                  <th>
                      Contact
                  </th>
                  <th style="width: 8%" class="text-center">
                      Status
                  </th>
                  <th style="width: 30%">
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
                    {{ $order->deliveryboy ? $order->deliveryboy->name : ''  }}
                </td>
                <td class="project_progress">
                    {{ $order->deliveryboy ? $order->deliveryboy->mobile : ''  }}
                </td>
                <td class="project-state">
                    @switch($order->status)
                        @case(1)
                        <span class="badge badge-primary">Accepted</span> 
                            @break
                        @case(2)
                        <span class="badge badge-info">Picked</span> 
                            @break
                        @case(3)
                        <span class="badge badge-success">Delivered</span> 
                            @break
                    
                        @default
                        <span class="badge badge-secondary">Pending</span> 
                            
                    @endswitch
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('order.show',$order->id) }}">
                        <i class="fas fa-folder">
                        </i>
                        View
                    </a>
                    {{-- <a class="btn btn-info btn-sm" href="#">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a> --}}
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
@stop