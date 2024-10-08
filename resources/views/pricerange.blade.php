
@extends('layout')

@section('title')
Search for products by price
@endsection

@section('content') <!-- เริ่มการกำหนดเนื้อหาของหน้า -->
@php
        // สร้างอาร์เรย์เพื่อเก็บสินค้าที่อยู่ในช่วงราคา
        $filteredProducts = [];
@endphp

<div class="d-flex"> 
        <div class="flex-shrink-0 p-3" style="width: 280px;">

        
            <a href="{{ route('categories', $category->id) }}" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
                <svg class="bi pe-none me-2" width="20" height="40"></svg>
                <p>
                        <h4>{{ $category->name }}</h4>
                    </p>  
            </a>
            
            <ul class="list-unstyled ps-0">
                <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#price-range-collapse" aria-expanded="true" style="font-size: 20px;">
                        Price Range
                    </button>
    
                    <form action={{ route('pricerange', $category->id) }} method="get">
                        <div class="collapse" id="price-range-collapse">
                            
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <div class="price-range-filter__inputs d-flex align-items-center">
                                    <input type="number" class="price-range-filter__input mx-2" name="min_price" placeholder="฿ MIN" value="{{$min_price}}">
                                    <div class="my-2"><h1>-</h1></div> 
                                    <input type="number" class="price-range-filter__input mx-2" name="max_price" placeholder="฿ MAX" value="{{$max_price}}">
                                </div>

                                <div class="my-1"><h1></h1></div> 
                                <button type="submit" class="button-solid button-solid--primary apply-button">
                                    Apply
                                </button>
                            </ul>
                        </div>
                    </form>
                </li>
            </ul>
        
        </div>



        <div class="container my-4">
            <div class="row">
                @foreach($products as $product)
                    @if ($product->category_id == $category->id && $product->price >= $min_price && $product->price <= $max_price)
                
                        @php
                            $filteredProducts[] = $product;
                        @endphp
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4 my-1">
                            <div class="card d-flex flex-column h-100">
                                <!-- Product Image -->
                                <img src="{{ asset('storage/' . $product->image_products) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
            
                                <!-- Product Details -->
                                <div class="card-body d-flex flex-column">
                                    <!-- Product Name -->
                                    <h4 class="card-title">{{ $product->name }}</h4>
                                    
                                    <!-- Product Price and Action Buttons -->
                                    <div class="mt-auto">
                                        <h4 class="card-title" style="color: #fa7510;">฿{{ $product->price }}</h4>
                                        <div class="btn-group">
                                            <!-- View Product Button -->
                                            <form action="{{ route('viewproduct', $product->id) }}" method="GET" style="display:inline;">
                                                <button type="submit" class="btn btn-outline-secondary">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                            </form>
                                            
                                            <!-- Add to Cart Form -->
                                            <form action="{{ route('cart.store', $product->id) }}" method="POST" style="display:inline;">
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
                    @endif
                @endforeach

            
            </div>
        </div>
    </div>

</div>
@endsection