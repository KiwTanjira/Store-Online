{{-- <h1>Results for: {{ $query }}</h1>

@if ($results->isEmpty())
    <p>No results found.</p>
@else
    <ul>
        @foreach ($results as $result)
            <li>{{ $result->name }}</li>
        @endforeach
    </ul>
@endif --}}


@extends('layout')

@section('title')
Search Products
@endsection

@section('content')
<div class="container my-4">
    <div class="row">
        @foreach ($results as $result)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4 my-1">
                <div class="card d-flex flex-column h-100">
                    <!-- Product Image -->
                    <img src="{{ asset('storage/' . $result->image_products) }}" class="card-img-top" style="height: 200px; object-fit: cover;"> <!-- กำหนดความสูงของภาพ -->

                    <div class="card-body d-flex flex-column">
                        <!-- Product Name -->
                        <h4 class="card-title">{{ $result->name }}</h4>
                        
                        <!-- Product Price and Action Buttons -->
                        <div class="mt-auto">
                            <h4 class="card-title" style="color: #fa7510;">฿{{ $result->price }}</h4>
                            <div class="btn-group">
                                <!-- View Product Button -->
                                <form action="{{ route('viewproduct', $result->id) }}" method="GET" style="display:inline;">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                </form>
                                <!-- Add to Cart Form -->
                                <form action="{{ route('cart.store', $result->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


