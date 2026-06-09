@extends('backend.layouts.master')

@section('main-content')
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Courier Lists</h6>
      <a href="{{route('courier.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add Courier"><i class="fas fa-plus"></i> Add Courier</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($couriers)>0)
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Name</th>
              <th>Hotline</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($couriers as $courier)
              <tr>
                <td>{{ $courier->id }}</td>
                <td>{{ $courier->name }}</td>
                <td>{{ $courier->hotline }}</td>
                <td>
                  <a href="{{route('courier.edit',$courier->id)}}" class="btn btn-primary btn-sm mr-1" style="height:30px; width:30px;border-radius:50%" title="Edit"><i class="fas fa-edit"></i></a>
                  <form method="POST" action="{{route('courier.destroy',$courier->id)}}" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm dltBtn" style="height:30px; width:30px;border-radius:50%" title="Delete"><i class="fas fa-trash-alt"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{ $couriers->links() }}</span>
        @else
          <h6 class="text-center">No couriers found. Please add one.</h6>
        @endif
      </div>
    </div>
 </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
  $(document).ready(function(){
    $('.dltBtn').click(function(e){
      var form=$(this).closest('form');
      e.preventDefault();
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this courier!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          form.submit();
        }
      });
    });
  })
</script>
@endpush