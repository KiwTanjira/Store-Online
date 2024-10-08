@extends('layout')

@section('title')
    Store Online
@endsection

@section('content')

<!-- slide -->
<style>
    .carousel-item {
        width: 100%; 

    }
</style>
    
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" class="active" aria-current="true" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="{{ route('categories', ['id' => 10, 'name' => 'Women Clothes']) }}">
                    <img src="https://image.makewebeasy.net/makeweb/m_1920x0/VNrXBbAxm/DefaultData/slide002.png?v=202012190947" alt="Banner" width="100%" height="500px">
                </a>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
                
                {{-- <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Example headline.</h1>
                        <p class="opacity-75">Some representative placeholder content for the first slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                    </div>
                </div> --}}
            </div>
            
            <div class="carousel-item">
                <a href="{{ route('categories', ['id' => 7, 'name' => 'Bags']) }}">
                    <img src="https://promotions.co.th/wp-content/uploads/Reebonz-End-Season-Sale-%E0%B8%81%E0%B8%A3%E0%B8%B0%E0%B9%80%E0%B8%9B%E0%B9%8B%E0%B8%B2%E0%B9%81%E0%B8%9A%E0%B8%A3%E0%B8%99%E0%B8%94%E0%B9%8C%E0%B8%AB%E0%B8%A3%E0%B8%B9-%E0%B8%A5%E0%B8%94%E0%B8%A3%E0%B8%B2%E0%B8%84%E0%B8%B2%E0%B8%9E%E0%B8%B4%E0%B9%80%E0%B8%A8%E0%B8%A9.jpg" alt="Banner" width="100%" height="500px">
                </a>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
                {{-- <div class="container">
                    <div class="carousel-caption">
                        <h1>Another example headline.</h1>
                        <p>Some representative placeholder content for the second slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                    </div>
                </div> --}}
            </div>
            <div class="carousel-item">
                <a href="{{ route('categories', ['id' => 5, 'name' => 'Beauty & Personal Care']) }}">
                    <img src="https://www.akerufeed.com/wp-content/uploads/2018/07/Screen-Shot-2018-07-04-at-3.25.16-PM.png" alt="Banner" width="100%" height="500px">
                </a>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
                {{-- <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>One more for good measure.</h1>
                        <p>Some representative placeholder content for the third slide of this carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                    </div>
                </div> --}}
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    {{-- Categories --}}
    <div class="container">
        <div class="row my-3">
            <div class="col-md-6">
                <h2>Categories</h2>

            </div>

              
        </div>

        {{-- show Categories --}}
        
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 row-cols-lg-10 g-0">
                @foreach ($categories as $category)
                    <div class="col" style="flex: 0 0 10%;">
                        <a href="{{ route('categories', ['id' => $category->id, 'name' => $category->name]) }}" class="card" style="height: 100%; text-decoration: none; color: inherit;">
                            <div class="bd-placeholder-img card-img-top" style="height: 100%;"> 
                                <img src="{{ asset('storage/' . $category->image_categories) }}" class="img-fluid" style="height: 100px; object-fit: cover;">
                                <div class="mt-auto text-center"> <!-- ใช้ mt-auto เพื่อให้ข้อความอยู่ที่ด้านล่าง -->
                                    <p class="card-text">{{ $category->name }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>

    </div>

    {{-- Products --}}
    <div class="container my-3">
        <div class="row my-3 align-items-center">
            <div class="col-md-6 d-flex align-items-center">
                <h3 class="mb-0">Recommended Products</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end">
                <p><a href="{{ url('/Allproducts') }}" class="link-opacity-75-hover" style="color: rgb(56, 56, 56)">All Products</a></p>
            </div>
        </div>
    
        <div class="row">
            @foreach (collect($products)->shuffle()->take(4) as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4 my-1">
                    <div class="card d-flex flex-column h-100">
                        <!-- Product Image -->
                        <img src="{{ asset('storage/' . $product->image_products) }}" class="card-img-top" style="height: 200px; object-fit: cover;"> <!-- กำหนดความสูงของภาพ -->
    
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
            @endforeach
        </div>
    </div>


    <div class="container">
        <div class="row">
            @php
                // สุ่มหมวดหมู่และเลือก 1 หมวดหมู่
                $randomCategory = collect($categories)->shuffle()->first();
            @endphp
    
            @if ($randomCategory)
            <h3>{{ $randomCategory->name }}</h3>

            <div class="row my-3"> <!-- ใช้ div.row เพื่อให้สินค้าจัดเรียงเป็นแถว -->
                @foreach ($products as $product)
                    @if ($product->category_id == $randomCategory->id)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4"> <!-- คอลัมน์ที่จัดเรียงตามขนาด -->
                            <div class="card d-flex flex-column" style="height: 100%;">
                                <img src="{{ asset('storage/' . $product->image_products) }}" class="card-img-top" style="height: 200px; object-fit: cover;"> <!-- กำหนดความสูงของภาพ -->
                                <div class="card-body d-flex flex-column" style="flex-grow: 1;">
                                    <h4 class="card-title">{{ $product->name }}</h4>
                                    <div class="mt-auto card-bottom">
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
            </div> <!-- ปิด div.row -->
        @endif

        </div>
    </div>
     
    <footer class="py-3 my-1 ">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6"> 
                    <ul class="nav justify-content-center border-top  pb-3 mt-0">
                        <div class="space-y-5 my-4">
                            <h3 class="text-xl font-medium">Contact Us</h3>
                            <div class="pl-3">
                                <p class="leading-8 font-light text-sm">
                                    99/9 fake fake fake fake 79999 <br>
                                    fakeemail@email.com <br>
                                    Tel. 0912345678
                                </p>
                            </div>
                        </div>
                    </ul>
                </div>
                
                <div class="col-md-6"> 
                    <ul class="nav justify-content-center border-top  pb-3 mt-0">
                        <div class="space-y-5 max-sm:col-span-2 my-4">
                            <h3 class="text-xl font-medium">Social Media</h3>
                            <ul class="space-y-3 font-light text-sm">
                                <li class="flex gap-3 pl-3">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" color="#3b5999" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"></path>
                                    </svg>
                                    <a href="#" class="underline">Facebook</a>
                                </li>
                                <li class="flex gap-3 pl-3">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" color="#e4405f" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M224,202.66A53.34,53.34,0,1,0,277.36,256,53.38,53.38,0,0,0,224,202.66Zm124.71-41a54,54,0,0,0-30.41-30.41c-21-8.29-71-6.43-94.3-6.43s-73.25-1.93-94.31,6.43a54,54,0,0,0-30.41,30.41c-8.28,21-6.43,71.05-6.43,94.33S91,329.26,99.32,350.33a54,54,0,0,0,30.41,30.41c21,8.29,71,6.43,94.31,6.43s73.24,1.93,94.3-6.43a54,54,0,0,0,30.41-30.41c8.35-21,6.43-71.05,6.43-94.33S357.1,182.74,348.75,161.67ZM224,338a82,82,0,1,1,82-82A81.9,81.9,0,0,1,224,338Zm85.38-148.3a19.14,19.14,0,1,1,19.13-19.14A19.1,19.1,0,0,1,309.42,189.74ZM400,32H48A48,48,0,0,0,0,80V432a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V80A48,48,0,0,0,400,32ZM382.88,322c-1.29,25.63-7.14,48.34-25.85,67s-41.4,24.63-67,25.85c-26.41,1.49-105.59,1.49-132,0-25.63-1.29-48.26-7.15-67-25.85s-24.63-41.42-25.85-67c-1.49-26.42-1.49-105.61,0-132,1.29-25.63,7.07-48.34,25.85-67s41.47-24.56,67-25.78c26.41-1.49,105.59-1.49,132,0,25.63,1.29,48.33,7.15,67,25.85s24.63,41.42,25.85,67.05C384.37,216.44,384.37,295.56,382.88,322Z"></path>
                                    </svg>
                                    <a href="#" class="underline">Instagram</a>
                                </li>
                                <li class="flex gap-3 pl-3">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" color="#00B900" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M272.1 204.2v71.1c0 1.8-1.4 3.2-3.2 3.2h-11.4c-1.1 0-2.1-.6-2.6-1.3l-32.6-44v42.2c0 1.8-1.4 3.2-3.2 3.2h-11.4c-1.8 0-3.2-1.4-3.2-3.2v-71.1c0-1.8 1.4-3.2 3.2-3.2H219c1 0 2.1.5 2.6 1.4l32.6 44v-42.2c0-1.8 1.4-3.2 3.2-3.2h11.4c1.8-.1 3.3 1.4 3.3 3.1zm-82-3.2h-11.4c-1.8 0-3.2 1.4-3.2 3.2v71.1c0 1.8 1.4 3.2 3.2 3.2h11.4c1.8 0 3.2-1.4 3.2-3.2v-71.1c0-1.7-1.4-3.2-3.2-3.2zm-27.5 59.6h-31.1v-56.4c0-1.8-1.4-3.2-3.2-3.2h-11.4c-1.8 0-3.2 1.4-3.2 3.2v71.1c0 .9.3 1.6.9 2.2.6.5 1.3.9 2.2.9h45.7c1.8 0 3.2-1.4 3.2-3.2v-11.4c0-1.7-1.4-3.2-3.1-3.2zM332.1 201h-45.7c-1.7 0-3.2 1.4-3.2 3.2v71.1c0 1.7 1.4 3.2 3.2 3.2h45.7c1.8 0 3.2-1.4 3.2-3.2v-71.1c0-1.8-1.4-3.2-3.2-3.2zM448 256c0 123.4-100.6 224-224 224S0 379.4 0 256 100.6 32 224 32s224 100.6 224 224z"></path>
                                    </svg>
                                    <a href="#" class="underline">Line</a>
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>
                
            </div>
        </div>

       

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center"> 
                    <ul class="nav justify-content-center border-top pb-3 mt-0">
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">© 2ssss4 Company, Inc. All rights reserved.</a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
        
    </footer>
    


@endsection
