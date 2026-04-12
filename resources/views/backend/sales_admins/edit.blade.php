@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Sales Admin</h5>
    <div class="card-body">
      <form method="post" action="{{route('sales-admins.update',$salesAdmin->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name</label>
          <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{$salesAdmin->name}}" class="form-control">
          @error('name')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputEmail" class="col-form-label">Email</label>
          <input id="inputEmail" type="email" name="email" placeholder="Enter email" value="{{$salesAdmin->email}}" class="form-control">
          @error('email')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhone" class="col-form-label">Phone</label>
          <input id="inputPhone" type="text" name="phone" placeholder="Enter phone (optional)" value="{{$salesAdmin->phone}}" class="form-control">
          @error('phone')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPassword" class="col-form-label">New Password (optional)</label>
          <input id="inputPassword" type="password" name="password" placeholder="Leave blank to keep current" class="form-control">
          @error('password')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo</label>
          <div class="custom-file">
            <input id="inputPhoto" type="file" name="photo" class="custom-file-input" accept="image/*">
            <label class="custom-file-label" for="inputPhoto">Choose file</label>
          </div>
          @if(!empty($salesAdmin->photo))
            <div class="mt-2">
              <img src="{{ $salesAdmin->photo }}" alt="{{ $salesAdmin->name }}" style="max-height:100px;">
            </div>
          @endif
          @error('photo')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status</label>
          <select name="status" class="form-control">
              <option value="active" {{(($salesAdmin->status=='active') ? 'selected' : '')}}>Active</option>
              <option value="inactive" {{(($salesAdmin->status=='inactive') ? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
  (function () {
    var input = document.getElementById('inputPhoto');
    if (!input) return;

    input.addEventListener('change', function (e) {
      var fileName = '';
      if (input.files && input.files.length > 0) {
        fileName = input.files[0].name;
      } else {
        fileName = (input.value || '').split('\\').pop();
      }
      var label = input.parentElement ? input.parentElement.querySelector('.custom-file-label') : null;
      if (label && fileName) {
        label.textContent = fileName;
      }
    });
  })();
</script>
@endpush
