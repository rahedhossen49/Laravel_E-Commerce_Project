@extends('layouts.BackendLayout');

@section('title','category')

@section('content')




  <div class="contaner">
    <div class="row">
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header">Add Category</div>
          <div class="card-body">
        <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Category title --}}

          <div class="form-input">
            <input type="text" class="form-control" placeholder="Category Name" name="title">
          @error('title')
            <p class="text-danger">{{$message}}</p>
          @enderror
          </div>

        {{-- Category icon  --}}

          <div class="form-input mt-2">
            <label for="categoryicon">Category Icon</label>
            <input type="file" id="categoryicon" class="form-control" name="category_icon">
          @error('category_icon')
            <p class="text-danger">{{$message}}</p>
          @enderror
          </div>

                  {{-- Category select  --}}

                  <div class="form-input mt-2">
                    <label for="Parentcategory">Parent Category</label>
                      <select class="form-control" name="Parentcategory" id="Parentcategory">
                        <option disabled selected >Select a Parent Category</option>
                      </select>
                    @error('Parentcategory')
                    <p class="text-danger">{{$message}}</p>
                  @enderror
                  </div>

          <button class="btn btn-primary mt-2" >Add Category</button>



        </form>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">Category List</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                   <tr>
                    <th>Sl.</th>
                    <th>Category Name</th>
                    <th class="text-center">Action</th>
                   </tr>
                       @forelse ($categories as $key=>$category)

                   <tr>
                    <td>{{$categories->firstItem() + $key}}</td>
                    <td>
                      <img width="80px" src="{{ $category->icon ? asset('storage/'.$category->icon) : asset('storage/placeholder/placeholder.jpg') }}" alt="">
                      {{ $category->title }}
                  </td>

                    <td class="text-center">
                      <div class="btn-group">
                        <a href="#" class="btn btn-sm btn-warning"><i class='bx bx-message-alt-edit'></i></a>
                        <a href="{{route('category.destroy',$category->id)}}" class="btn btn-sm btn-danger"><i class='bx bx-message-square-x'></i></a>
                      </div>
                    </td>
                   </tr>
                   @empty
         <tr>
          <td colspan="3" class='text-center'><p>No Categories has been found!</p></td>
         </tr>
                       @endforelse
              </table>

             <p class="mt-2">
               {{$categories->links()}}
             </p>

            </class=>
          </div>
        </div>

      </div>
    </div>
  </div>










@endsection