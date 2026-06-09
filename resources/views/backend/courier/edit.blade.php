@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Courier</h5>
    <div class="card-body">
      @include('backend.layouts.notification')
      <form method="post" action="{{route('courier.update',$courier->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="name" class="col-form-label">Courier Name</label>
          <input id="name" type="text" name="name" value="{{ old('name', $courier->name) }}" class="form-control" placeholder="Enter courier name">
          @error('name')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="hotline" class="col-form-label">Hotline</label>
          <input id="hotline" type="text" name="hotline" value="{{ old('hotline', $courier->hotline) }}" class="form-control" placeholder="Enter hotline">
          @error('hotline')
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