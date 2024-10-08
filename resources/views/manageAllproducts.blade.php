@extends('layout')

@section('title')
    Manage Products
@endsection

@section('content')
    <div class="container mb-2 mt-4">

                <div class="col-md-6">
                    <div class="p-3 ">
                        <h2>Product</h2>
                        <a href="/createproducts"><button type="button" class="btn btn-success">Add Product</button></a>
                    </div>
                </div>    
        </div>


        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $product->image_products) }}" style="width: 100px;">
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <a href="{{route('edit',$product->id)}}" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <a 
                            href="{{route('delete',$product->id)}}" 
                            class="btn btn-danger"
                            onclick="return confirm('Do you want to delete the item {{$product->name}} ?')"
                            >Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

       
        <div class="col-md-6">
            <div class=" p-3 ">
                <h2>Category</h2>
                
                <a href="/createcategory"><button type="button" class="btn btn-success">Add Category</button></a>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                  
                    
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $category->image_categories) }}" style="width: 100px;">
                        </td>
                        
                        <td>
                            {{-- <a href="{{route('edit',$category->id)}}" class="btn btn-warning">edit</a> --}}
                            <a href="{{route('editcategory',$category->id)}}" class="btn btn-warning">Edit</a>
                            
                        </td>
                        <td>
                            <a 
                            href="{{route('deletecategory',$category->id)}}" 
                            class="btn btn-danger"
                            onclick="return confirm('Do you want to delete the item {{$category->name}} ?')"
                            >Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
