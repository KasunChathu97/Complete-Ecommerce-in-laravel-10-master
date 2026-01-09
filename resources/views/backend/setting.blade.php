@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Post</h5>
    <div class="card-body">
    <form method="post" action="{{route('settings.update')}}">
        @csrf 
        {{-- @method('PATCH') --}}
        {{-- {{dd($data)}} --}}
        <div class="form-group">
          <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
          <textarea class="form-control" id="description" name="description">{{$data->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="vision" class="col-form-label">Our Vision</label>
          <textarea class="form-control" id="vision" name="vision">{{ data_get($data,'vision') }}</textarea>
          @error('vision')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="mission" class="col-form-label">Our Mission</label>
          <textarea class="form-control" id="mission" name="mission">{{ data_get($data,'mission') }}</textarea>
          @error('mission')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="commitment_energy_independence" class="col-form-label">Our Commitment to Energy Independence</label>
          <textarea class="form-control" id="commitment_energy_independence" name="commitment_energy_independence">{{ data_get($data,'commitment_energy_independence') }}</textarea>
          @error('commitment_energy_independence')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="specialized_product_range" class="col-form-label">Our Specialized Product Range</label>
          <textarea class="form-control" id="specialized_product_range" name="specialized_product_range">{{ data_get($data,'specialized_product_range') }}</textarea>
          @error('specialized_product_range')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="why_choose_delimach_lanka" class="col-form-label">Why Choose Delimach Lanka?</label>
          <textarea class="form-control" id="why_choose_delimach_lanka" name="why_choose_delimach_lanka">{{ data_get($data,'why_choose_delimach_lanka') }}</textarea>
          @error('why_choose_delimach_lanka')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Logo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail1" class="form-control" type="text" name="logo" value="{{$data->logo}}">
        </div>
        <div id="holder1" style="margin-top:15px;max-height:100px;"></div>

          @error('logo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$data->photo}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="address" class="col-form-label">Address <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="address" required value="{{$data->address}}">
          @error('address')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="email" required value="{{$data->email}}">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="phone" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="phone" required value="{{$data->phone}}">
          @error('phone')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="facebook" class="col-form-label">Facebook</label>
          <input type="text" class="form-control" name="facebook" value="{{data_get($data,'facebook')}}" placeholder="https://facebook.com/yourpage">
          @error('facebook')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="instagram" class="col-form-label">Instagram</label>
          <input type="text" class="form-control" name="instagram" value="{{data_get($data,'instagram')}}" placeholder="https://instagram.com/yourprofile">
          @error('instagram')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="youtube" class="col-form-label">YouTube</label>
          <input type="text" class="form-control" name="youtube" value="{{data_get($data,'youtube')}}" placeholder="https://youtube.com/@yourchannel">
          @error('youtube')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="twitter" class="col-form-label">Twitter / X</label>
          <input type="text" class="form-control" name="twitter" value="{{data_get($data,'twitter')}}" placeholder="https://x.com/yourhandle">
          @error('twitter')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="whatsapp" class="col-form-label">WhatsApp</label>
          <input type="text" class="form-control" name="whatsapp" value="{{data_get($data,'whatsapp')}}" placeholder="https://wa.me/9477xxxxxxx">
          @error('whatsapp')
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

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');
    $('#lfm1').filemanager('image');
    $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });

    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "Write short Quote.....",
          tabsize: 2,
          height: 100
      });
    });
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });

    $(document).ready(function() {
      $('#vision').summernote({
        placeholder: "Write our vision.....",
          tabsize: 2,
          height: 120
      });
    });

    $(document).ready(function() {
      $('#mission').summernote({
        placeholder: "Write our mission.....",
          tabsize: 2,
          height: 120
      });
    });

    $(document).ready(function() {
      $('#commitment_energy_independence').summernote({
        placeholder: "Write our commitment.....",
          tabsize: 2,
          height: 120
      });
    });

    $(document).ready(function() {
      $('#specialized_product_range').summernote({
        placeholder: "Write our specialized product range.....",
          tabsize: 2,
          height: 120
      });
    });

    $(document).ready(function() {
      $('#why_choose_delimach_lanka').summernote({
        placeholder: "Write why choose Delimach Lanka.....",
          tabsize: 2,
          height: 120
      });
    });
</script>
@endpush