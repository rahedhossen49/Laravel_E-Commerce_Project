@extends('layouts.BackendLayout')

@section('title', 'product List')

@section('content')


    <div class="card shadow">
        <div class="card-header">Add Product</div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf



                <div class="col-12">
                <div class="card">
                    <div class="card-header">Category List</div>
                    <div class="card-body">
                        <div class="table-responsive">
                       <table class="table">
                        <tr>
                            <th>Category Name</th>
                        </tr>

                        <thead>
                            <tr>
                            </tr>
                        </thead>
                       </table>

                        </div>
                    </div>
                </div>
        </div>
        </div>





        </form>
    </div>





@endsection
