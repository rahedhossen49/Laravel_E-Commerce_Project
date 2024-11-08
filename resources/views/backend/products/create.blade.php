@extends('layouts.BackendLayout')

@section('title', 'Add product ')

@section('content')

 {{-- * Select 2 styles Cdn With Backend layout  --}}

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
 {{-- **** Select 2 styles Cdn With Backend layout end  --}}


<div class="card shadow">
  <div class="card-header">Add Product</div>
  <div class="card-body">
    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
  <div class="form-group">
    <label for="">Product Title <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="name" name="title"
    placeholder="Enter product title">
    @error('title')
    <span class="text-danger">{{ $message }}</span>
    @enderror

  </div>

  <div class="row my-3">

    <div class="col-lg-3">
      <div class="form-group">
        <label for="">Regular Price <span class="text-danger">*</span></label>
        <input type="number" class="form-control" name="price">
        @error('price')
        <span class="text-danger">{{ $message }}</span>
        @enderror

      </div>
      </div>

      <div class="col-lg-3">
        <div class="form-group">
          <label for="">Selling Price</label>
          <input type="number" multiple class="form-control" name="selling_price">
          @error('selling_price')
          <span class="text-danger">{{ $message }}</span>
          @enderror

        </div>
        </div>

        <div class="col-lg-3">
          <div class="form-group">
            <label for="">Sku</label>
            <input type="number" class="form-control" name="sku">
          </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label for="">Stock</label>
              <input type="number" class="form-control"  name="stock">
              @error('stock')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>

  </div>


  <div class="row my-3">
    <div class="col-lg-6">
      <div class="form-group">
        <label for="price">Featured Image</label>
        <input type="file" name="image" class="form-control">
        @error('image')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      </div>

      <div class="col-lg-6">
        <div class="form-group">
          <label for="price">Gallary Image</label>
          <input type="file" multiple name="gall_img[]" class="form-control">
          @error('gall_img.*')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        </div>
  </div>


  <label for="" class="d-block my-3">
    Short Details
    <textarea class="form-control" name="detail" ></textarea>
  </label>


  <label for="" class="d-block my-3">
    Long Details
    <textarea class="form-control" name="long_detail" ></textarea>
  </label>


  <label for="" class="d-block my-3">
     Additional Information
    <textarea class="form-control" name="additional_info" ></textarea>
  </label>

    <select multiple  name="categories[]" class="form-control categories">
      @foreach ($categories as $category)
      <option value="{{$category->id}}">{{$category->title}}</option>
      @endforeach
    </select>

    <div class="text-center">

      <button class="btn btn-primary rounded-0 mt-3">Add Product</button>
    </div>
    </form>
  </div>
</div>



 {{-- * Select 2 scripts  Cdn With Backend layout  --}}
 @push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.categories').select2({
      placeholder: "Select a Category",
    });
});
</script>
@endpush

 {{-- **** Select 2 scripts  Cdn With Backend layout end  --}}



@endsection