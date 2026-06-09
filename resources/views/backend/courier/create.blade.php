@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Courier</h5>
    <div class="card-body">
      @include('backend.layouts.notification')
      <form method="post" action="{{route('courier.store')}}">
        @csrf
        <div class="form-group">
          <label for="name" class="col-form-label">Courier Name</label>
          <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter courier name">
          @error('name')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="hotline" class="col-form-label">Hotline</label>
          <input id="hotline" type="text" name="hotline" value="{{ old('hotline') }}" class="form-control" placeholder="Enter hotline">
          @error('hotline')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
          <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection