@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="warranty" class="col-form-label">Warranty</label>
          <textarea class="form-control" id="warranty" name="warranty" placeholder="Enter warranty details">{{old('warranty')}}</textarea>
        </div>

        <div class="form-group">
          <label for="returns" class="col-form-label">Returns</label>
          <textarea class="form-control" id="returns" name="returns" placeholder="Enter returns policy">{{old('returns')}}</textarea>
        </div>


        <div class="form-group">
          <label for="is_featured">Is Featured</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes                        
        </div>
        <div class="form-group">
          <label for="free_shipping_enabled">Enable Free Shipping</label><br>
          <input type="checkbox" name='free_shipping_enabled' id='free_shipping_enabled' value='1' {{ old('free_shipping_enabled') ? 'checked' : '' }}> Yes
        </div>
              {{-- {{$categories}} --}}

        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group d-none" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any category--</option>
              {{-- @foreach($parent_cats as $key=>$parent_cat)
                  <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
              @endforeach --}}
          </select>
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <div class="d-flex align-items-center justify-content-between">
            <label for="discount" class="col-form-label mb-0">Discount(%)</label>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="discount_enabled" name="discount_enabled" value="1" {{ old('discount_enabled') ? 'checked' : '' }}>
              <label class="custom-control-label" for="discount_enabled">Enable</label>
            </div>
          </div>
          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"  value="{{old('discount')}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="bulk_discount_type" class="col-form-label">Bulk Discount Type</label>
          <select name="bulk_discount_type" id="bulk_discount_type" class="form-control">
            <option value="none" selected>None</option>
            <option value="qty">By Quantity</option>
            <option value="value">By Value</option>
          </select>
        </div>
        <div class="form-group">
          <label for="bulk_discount_threshold" class="col-form-label">Bulk Discount Threshold</label>
          <input id="bulk_discount_threshold" type="number" name="bulk_discount_threshold" placeholder="Minimum Qty or Value for Discount" value="{{ old('bulk_discount_threshold') }}" class="form-control">
        </div>
        <div class="form-group">
          <label for="bulk_discount_amount" class="col-form-label">Bulk Discount Amount (%)</label>
          <div class="input-group">
            <input id="bulk_discount_amount" type="number" step="0.01" name="bulk_discount_amount" placeholder="Discount Percent" value="{{ old('bulk_discount_amount') }}" class="form-control">
            <input type="hidden" name="bulk_discount_amount_type" value="percent">
            <span class="input-group-text">%</span>
          </div>
          <small class="form-text text-muted">Only percentage discount is supported for bulk discount.</small>
        </div>

        <div class="form-group">
          <label for="brand_id">Brand</label>
          {{-- {{$brands}} --}}

          <select name="brand_id" class="form-control">
              <option value="">--Select Brand--</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}">{{$brand->title}}</option>
             @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="condition">Condition</label>
          <select name="condition" class="form-control">
              <option value="">--Select Condition--</option>
              <option value="default">Default</option>
              <option value="new">New</option>
              <option value="hot">Hot</option>
          </select>
        </div>

        <div class="form-group">
          <label for="weight" class="col-form-label">Weight (kg)</label>
          <input id="weight" type="number" step="0.01" name="weight" placeholder="Enter product weight" value="{{ old('weight') }}" class="form-control">
          @error('weight')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{old('stock')}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photos <span class="text-danger">*</span></label>
          <div class="custom-file">
            <input id="inputPhoto" type="file" name="photo[]" accept="image/*" class="custom-file-input" multiple>
            <label class="custom-file-label" for="inputPhoto">Choose Photos</label>
          </div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
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

@push('styles')
<style>
  .custom-file-label {
    background: #f8f9fa;
    border: 1px solid #ced4da;
    color: #495057;
    border-radius: 0.25rem;
    padding: 0.375rem 0.75rem;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
  }
  .custom-file-input:focus ~ .custom-file-label {
    background: #e9ecef;
    color: #495057;
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
  }
</style>
@endpush

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script>
  // Show selected file name
  document.addEventListener('DOMContentLoaded', function() {
    var input = document.getElementById('inputPhoto');
    if(input) {
      input.addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : 'Choose Photo';
        var label = input.nextElementSibling;
        if(label) label.innerText = fileName;
      });
    }
  });
</script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Write short description.....",
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
    // $('select').selectpicker();

    function toggleDiscountField() {
      var enabled = $('#discount_enabled').is(':checked');
      $('#discount').prop('disabled', !enabled);
      if (!enabled) {
        $('#discount').val('');
      }
    }

    $(document).ready(function() {
      // If a discount value is already present (validation old input), auto-enable.
      if ($('#discount').val()) {
        $('#discount_enabled').prop('checked', true);
      }
      toggleDiscountField();
      $('#discount_enabled').on('change', toggleDiscountField);
    });

</script>

<script>
  $('#cat_id').change(function(){
    var cat_id=$(this).val();
    // alert(cat_id);
    if(cat_id !=null){
      // Ajax call
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          // console.log(response);
          var html_option="<option value=''>----Select sub category----</option>"
          if(response.status){
            var data=response.data;
            // alert(data);
            if(response.data){
              $('#child_cat_div').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_div').addClass('d-none');
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
    else{
    }
  })
</script>
@endpush