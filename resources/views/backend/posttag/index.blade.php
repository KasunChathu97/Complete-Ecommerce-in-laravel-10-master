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
      <h6 class="m-0 font-weight-bold text-primary float-left">Post Tag Lists</h6>
    </div>
    <div class="card-body">
      <div class="mb-4">
        <h6 class="font-weight-bold text-primary">Homepage Offer Text</h6>
        <form method="POST" action="{{ route('post-tag.homepage-marquee.update') }}">
          @csrf
          <div class="form-group">
            <label for="marquee_text" class="col-form-label">Marquee Text</label>
            <textarea id="marquee_text" name="marquee_text" class="form-control" rows="2" placeholder="Today is 20% off. Order soon">{{ old('marquee_text', $homepageMarquee->title ?? 'අද දින 20% ක වට්ටමක්. ඔබත් ඉක්මනින් ඇණවුම් කරන්න.') }}</textarea>
            @error('marquee_text')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="marquee_status" class="col-form-label">Status</label>
            <select id="marquee_status" name="status" class="form-control">
              @php
                $marqueeStatus = old('status', $homepageMarquee->status ?? 'active');
              @endphp
              <option value="active" {{ $marqueeStatus == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ $marqueeStatus == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary btn-sm">Save</button>
        </form>
        <hr>
      </div>

      <div class="table-responsive">
        @if(count($postTags)>0)
        <table class="table table-bordered" id="post-category-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Slug</th>
              <th>Status</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Slug</th>
              <th>Status</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($postTags as $data)   
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->title}}</td>
                    <td>{{$data->slug}}</td>
                    <td>
                        @if($data->status=='active')
                            <span class="badge badge-success">{{$data->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$data->status}}</span>
                        @endif
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$postTags->links()}}</span>
        @else
          <h6 class="text-center">No Post Tag found!!! Please create post tag</h6>
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
      
      $('#post-category-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
            "targets":[3]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){
            
        }
  </script>
@endpush