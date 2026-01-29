@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Product</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$product->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{$product->summary}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="warranty" class="col-form-label">Warranty</label>
          <textarea class="form-control" id="warranty" name="warranty" placeholder="Enter warranty details">{{$product->warranty ?? ''}}</textarea>
        </div>

        <div class="form-group">
          <label for="returns" class="col-form-label">Returns</label>
          <textarea class="form-control" id="returns" name="returns" placeholder="Enter returns policy">{{$product->returns ?? ''}}</textarea>
        </div>


        <div class="form-group">
          <label for="is_featured">Is Featured</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='{{$product->is_featured}}' {{(($product->is_featured) ? 'checked' : '')}}> Yes                        
        </div>
              {{-- {{$categories}} --}}

        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}' {{(($product->cat_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>
        @php 
          $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
        // dd($sub_cat_info);

        @endphp
        {{-- {{$product->child_cat_id}} --}}
        <div class="form-group {{(($product->child_cat_id)? '' : 'd-none')}}" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any sub category--</option>
              
          </select>
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="Enter price"  value="{{$product->price}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <div class="d-flex align-items-center justify-content-between">
            <label for="discount" class="col-form-label mb-0">Discount(%)</label>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="discount_enabled" name="discount_enabled" value="1" {{ old('discount_enabled', ((float) $product->discount) > 0) ? 'checked' : '' }}>
              <label class="custom-control-label" for="discount_enabled">Enable</label>
            </div>
          </div>
          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"  value="{{ old('discount', $product->discount) }}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="bulk_discount_type" class="col-form-label">Bulk Discount Type</label>
          <select name="bulk_discount_type" id="bulk_discount_type" class="form-control">
            <option value="none" {{ ($product->bulk_discount_type ?? 'none') == 'none' ? 'selected' : '' }}>None</option>
            <option value="qty" {{ ($product->bulk_discount_type ?? '') == 'qty' ? 'selected' : '' }}>By Quantity</option>
            <option value="value" {{ ($product->bulk_discount_type ?? '') == 'value' ? 'selected' : '' }}>By Value</option>
          </select>
        </div>
        <div class="form-group">
          <label for="bulk_discount_threshold" class="col-form-label">Bulk Discount Threshold</label>
          <input id="bulk_discount_threshold" type="number" name="bulk_discount_threshold" placeholder="Minimum Qty or Value for Discount" value="{{ old('bulk_discount_threshold', $product->bulk_discount_threshold) }}" class="form-control">
        </div>
        <div class="form-group">
          <label for="bulk_discount_amount" class="col-form-label">Bulk Discount Amount (%)</label>
          <div class="input-group">
            <input id="bulk_discount_amount" type="number" step="0.01" name="bulk_discount_amount" placeholder="Discount Percent" value="{{ old('bulk_discount_amount', $product->bulk_discount_amount) }}" class="form-control">
            <input type="hidden" name="bulk_discount_amount_type" value="percent">
            <span class="input-group-text">%</span>
          </div>
          <small class="form-text text-muted">Only percentage discount is supported for bulk discount.</small>
        </div>
        <div class="form-group">
          <label for="brand_id">Brand</label>
          <select name="brand_id" class="form-control">
              <option value="">--Select Brand--</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}" {{(($product->brand_id==$brand->id)? 'selected':'')}}>{{$brand->title}}</option>
             @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="condition">Condition</label>
          <select name="condition" class="form-control">
              <option value="">--Select Condition--</option>
              <option value="default" {{(($product->condition=='default')? 'selected':'')}}>Default</option>
              <option value="new" {{(($product->condition=='new')? 'selected':'')}}>New</option>
              <option value="hot" {{(($product->condition=='hot')? 'selected':'')}}>Hot</option>
          </select>
        </div>

        <div class="form-group">
          <label for="weight" class="col-form-label">Weight (kg)</label>
          <input id="weight" type="number" step="0.01" name="weight" placeholder="Enter product weight" value="{{ old('weight', $product->weight) }}" class="form-control">
          @error('weight')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{$product->stock}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photos <span class="text-danger">*</span></label>
          <div style="margin-bottom:10px; display:flex; gap:10px; flex-wrap:wrap;">
            @php $photos = $product->photo ? explode(',', $product->photo) : []; @endphp
            @foreach($photos as $img)
              <img src="{{$img}}" style="max-height:80px; max-width:80px; object-fit:cover; border:1px solid #ddd; border-radius:4px;">
            @endforeach
          </div>
          <div class="custom-file mb-2">
            <input id="inputPhoto" type="file" name="photo[]" accept="image/*" class="custom-file-input" multiple>
            <label class="custom-file-label" for="inputPhoto">Choose New Photos (optional)</label>
          </div>
          <small class="form-text text-muted">Existing images are shown above. You can add more by selecting files. All images will be combined on save.</small>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($product->status=='active')? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>Inactive</option>
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

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>


    // Multi-image file manager
    $('#lfm-multi').filemanager('image', {prefix: '/laravel-filemanager'});
    // Add Images button triggers the file manager
    document.getElementById('add-images-btn').addEventListener('click', function() {
      document.getElementById('lfm-multi').click();
    });

    // Preview all images in the comma-separated list
    function renderMultiImagePreview() {
      var urls = ($('#thumbnails').val() || '').split(',').map(function(u){ return u.trim(); }).filter(Boolean);
      var holder = document.getElementById('holder-multi');
      holder.innerHTML = '';
      urls.forEach(function(url) {
        var img = document.createElement('img');
        img.src = url;
        img.style.maxHeight = '100px';
        img.style.maxWidth = '100px';
        img.style.objectFit = 'cover';
        img.style.border = '1px solid #ddd';
        img.style.borderRadius = '4px';
        holder.appendChild(img);
      });
    }
    document.getElementById('thumbnails').addEventListener('input', renderMultiImagePreview);
    renderMultiImagePreview();

    $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail Description.....",
          tabsize: 2,
          height: 150
      });
    });

    function toggleDiscountField() {
      var enabled = $('#discount_enabled').is(':checked');
      $('#discount').prop('disabled', !enabled);
      if (!enabled) {
        $('#discount').val('');
      }
    }

    $(document).ready(function() {
      toggleDiscountField();
      $('#discount_enabled').on('change', toggleDiscountField);
    });
</script>

<script>
  var  child_cat_id='{{$product->child_cat_id}}';
        // alert(child_cat_id);
        $('#cat_id').change(function(){
            var cat_id=$(this).val();

            if(cat_id !=null){
                // ajax call
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}"
                    },
                    success:function(response){
                        if(typeof(response)!='object'){
                            response=$.parseJSON(response);
                        }
                        var html_option="<option value=''>--Select any one--</option>";
                        if(response.status){
                            var data=response.data;
                            if(response.data){
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option += "<option value='"+id+"' "+(child_cat_id==id ? 'selected ' : '')+">"+title+"</option>";
                                });
                            }
                            else{
                                console.log('no response data');
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

        });
        if(child_cat_id!=null){
            $('#cat_id').change();
        }
</script>
@endpush