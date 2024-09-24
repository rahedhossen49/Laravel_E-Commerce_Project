@extends('layouts.BackendLayout')

@section('title', 'category')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"> {{ $editedCategory ? 'Edit' : 'Add'}} Category</div>
                <div class="card-body">
                    <form action="{{ route($editedCategory ? 'category.update' : 'category.store',$editedCategory?->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                     @if ($editedCategory)

                     @method('patch')

                     @endif
                        {{--! Category title start --}}
                        <div class="form-input">
                            <input type="text" class="form-control" placeholder="Category Name" name="title" value="{{$editedCategory?->title}}">
                            @error('title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        {{--! Category title END  --}}


                         {{-- ! Category icon start  --}}
                         <div class="form-input mt-2">
                            <label for="categoryicon">Category Icon</label>
                            @if ($editedCategory?->icon)
                            <img width="80px" class="d-block my-2" src="{{asset('storage/'.$editedCategory?->icon)}}" alt="">
                        @endif
                            <input type="file" id="categoryicon" class="form-control" name="category_icon">
                            @error('category_icon')

                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                         {{-- ! Category icon End  --}}

                        {{-- !  Category select start  --}}
                        <div class="form-input mt-2">
                            <label for="parentCategory">Parent Category</label>
                            <select class="form-control" name="parentCategory" id="parentCategory">
                                <option disabled selected>Select a Parent Category</option>
                                @foreach ($categories as $category)
                                <option {{$category->id == $editedCategory?->category_id ? 'selected' : null}} value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('Parentcategory')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="btn btn-primary mt-2">{{ $editedCategory ? 'Update' : 'Add'}} Category</button>
                        {{-- !  Category select End  --}}
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Category List</div>
                <div class="card-body">
                    <div class="table-responsive">

                        {{-- ! Table Start  --}}

                        <table class="table">
                            <tr>
                                <th>Sl.</th>
                                <th>Category Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                            @forelse ($categories as $key => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $key }}</td>
                                <td>
                                    <img width="80px"
                                        src="{{ $category->icon ? asset('storage/'.$category->icon) : asset('storage/placeholder/placeholder.jpg') }}"
                                        alt="">
                                    {{ $category->title }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{route('category.index',$category->id)}}" class="btn btn-sm btn-warning"><i class='bx bx-message-alt-edit'></i></a>
                                        <a href="{{ route('category.destroy', $category->id) }}" class="btn btn-sm btn-danger"><i class='bx bx-message-square-x'></i></a>
                                    </div>
                                </td>
                            </tr>

                            {{-- ! subcategory start  --}}

                            @if (isset($category->subcategories))

                            @foreach ($category->subcategories as $subcategory)
                            <tr>
                                <td>--</td>
                                <td>
                                    <img width="80px"
                                        src="{{asset('storage/'.$subcategory->icon) }}"
                                        alt="">
                                    {{ $subcategory->title }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{route('category.index',$subcategory->id)}}" class="btn btn-sm btn-warning"><i class='bx bx-message-alt-edit'></i></a>
                                        <a href="{{ route('category.destroy', $subcategory->id) }}" class="btn btn-sm btn-danger"><i class='bx bx-message-square-x'></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                                 {{-- ! subcategory End--}}

                            @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    <p>No Categories has been found!</p>
                                </td>
                            </tr>
                            @endforelse
                        </table>

                      {{-- ! Table End  --}}

                        <p class="mt-2">
                            {{ $categories->links() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection