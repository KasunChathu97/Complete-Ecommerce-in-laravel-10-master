@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Order Lists</h6>
    </div>
    <div class="card-body">
      @php
        $activeStatus = request('status', $status ?? null);
        $dateParam = request('date', $date ?? null);
      @endphp

      <div class="d-flex flex-wrap mb-3" style="gap:10px;">
        <a href="{{ route('order.index', array_filter(['date' => $dateParam])) }}" class="btn btn-sm {{ empty($activeStatus) ? 'btn-primary' : 'btn-outline-primary' }}">
          All ({{ $statusCounts['all'] ?? 0 }})
        </a>
        <a href="{{ route('order.index', array_filter(['date' => $dateParam, 'status' => 'new'])) }}" class="btn btn-sm {{ $activeStatus==='new' ? 'btn-primary' : 'btn-outline-primary' }}">
          New ({{ $statusCounts['new'] ?? 0 }})
        </a>
        <a href="{{ route('order.index', array_filter(['date' => $dateParam, 'status' => 'pending'])) }}" class="btn btn-sm {{ $activeStatus==='pending' ? 'btn-info' : 'btn-outline-info' }}">
          Pending ({{ $statusCounts['pending'] ?? 0 }})
        </a>
        <a href="{{ route('order.index', array_filter(['date' => $dateParam, 'status' => 'process'])) }}" class="btn btn-sm {{ $activeStatus==='process' ? 'btn-warning' : 'btn-outline-warning' }}">
          Process ({{ $statusCounts['process'] ?? 0 }})
        </a>
        <a href="{{ route('order.index', array_filter(['date' => $dateParam, 'status' => 'delivered'])) }}" class="btn btn-sm {{ $activeStatus==='delivered' ? 'btn-success' : 'btn-outline-success' }}">
          Delivered ({{ $statusCounts['delivered'] ?? 0 }})
        </a>
        <a href="{{ route('order.index', array_filter(['date' => $dateParam, 'status' => 'cancel'])) }}" class="btn btn-sm {{ $activeStatus==='cancel' ? 'btn-danger' : 'btn-outline-danger' }}">
          Cancel ({{ $statusCounts['cancel'] ?? 0 }})
        </a>
      </div>

      <div class="d-flex flex-wrap align-items-end justify-content-between mb-3" style="gap: 12px;">
        <form action="{{ route('order.index') }}" method="GET" class="d-flex flex-wrap align-items-end" style="gap: 10px;">
          <input type="hidden" name="status" value="{{ $activeStatus }}" />
          <div>
            <label for="order_date" class="mb-1"><small>Order date</small></label>
            <input type="date" id="order_date" name="date" value="{{ request('date', $date ?? '') }}" class="form-control" style="min-width: 180px;" />
          </div>
          <div class="d-flex" style="gap: 8px;">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('order.index') }}" class="btn btn-outline-secondary">Reset</a>
          </div>
        </form>

        <div>
          @php
            $exportParams = array_filter([
              'date' => request('date'),
              'status' => $activeStatus,
            ]);
          @endphp
          <a href="{{ route('orders.export.excel', $exportParams) }}" class="btn btn-success">
            <i class="fas fa-file-excel mr-1"></i> Export Excel
          </a>
        </div>
      </div>
      <div class="table-responsive">
        @if(count($orders)>0)
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Order No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Sales Admin</th>
              <th>Quantity</th>
              <th>Total Amount</th>
              <th>Order Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Order No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Sales Admin</th>
              <th>Quantity</th>
              <th>Total Amount</th>
              <th>Order Date</th>
              <th>Status</th>
              <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($orders as $order)  
            @php
                $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
            @endphp 
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{ optional($order->salesStaff)->name ?? '-' }}</td>
                    <td>{{$order->quantity}}</td>
                    <td>${{number_format($order->total_amount,2)}}</td>
                    <td>{{ optional($order->created_at)->format('Y-m-d') }}</td>
                    <td>
                        @if($order->status=='new')
                          <span class="badge badge-primary">{{$order->status}}</span>
                        @elseif($order->status=='pending')
                          <span class="badge badge-info">{{$order->status}}</span>
                        @elseif($order->status=='process')
                          <span class="badge badge-warning">{{$order->status}}</span>
                        @elseif($order->status=='delivered')
                          <span class="badge badge-success">{{$order->status}}</span>
                        @else
                          <span class="badge badge-danger">{{$order->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('order.show',$order->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                      <!--<a href="{{ route('orders.export.single.excel', $order->id) }}" class="btn btn-success btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Export Excel" data-placement="bottom"><i class="fas fa-file-excel"></i></a>-->
                        <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                          @csrf 
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        @if(is_object($orders) && method_exists($orders, 'links'))
          <span style="float:right">{{$orders->links()}}</span>
        @endif
        @else
          <h6 class="text-center">No orders found!!! Please order some products</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
        $('#order-dataTable').DataTable( {
          "columnDefs":[
            {
              "orderable":false,
              "targets":[10]
            }
          ]
        } );

        // Sweet alert

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
@endpush