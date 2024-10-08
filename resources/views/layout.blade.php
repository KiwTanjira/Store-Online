<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .hidden {
            display: none; /* คลาสซ่อน */
        }
    </style></head>

<body>
    <!-- Navbar -->
    <header class="p-3">
        <div class="container border-bottom">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <!-- Logo here if needed -->
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li class="nav-item">
                        <h2><a href="{{ url('/welcome') }}" class="nav-link px-2 text-black">SHOP</a></h2>
                    </li>
                    
                    {{-- <li class="nav-item dropdown">
                        <a href="#" class="nav-link px-2 text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Product
                        </a>
                        <ul class="dropdown-menu" data-bs-theme="light">
                            <li><a class="dropdown-item rounded-2" href="#">All Product</a></li>
                            <li><a class="dropdown-item rounded-2" href="{{ url('add_product') }}">Add Product</a></li>
                        </ul>
                    </li> --}}

                    <li class="nav-item">
                        
                    </li>

                    <li class="nav-item">
                        
                    </li>
                </ul>
                
                <h6><a href="{{ url('/manageAllproducts') }}" class="nav-link px-2 ms-5 me-1 text-black">Manage products</a></h6>
                
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 ms-5 me-5" role="search" action="/search" method="GET">
                    <input type="search" name="NameSearch" class="form-control " placeholder="Search..." aria-label="Search" >
                    <button type="submit" class="d-none">Search</button> <!-- Optional: This is to ensure there's a submit button for accessibility -->
                </form>
                

                <div class="text-end">
                    <i type="button" class="fa-solid fa-user ms-4" style="color: rgb(8, 4, 117); font-size: 24px;"></i>
                    {{-- <button type="button" class="btn btn-outline-light me-2">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button> --}}
                </div>
                <a href="/cart" class="d-flex align-items-center ms-4">
                    <i class="fa-solid fa-cart-shopping" style="color: rgb(8, 4, 117); font-size: 24px;"></i>
                    {{-- <span class="badge bg-primary ms-1 mt-3">1</span> <!-- จำนวน --> --}}

                </a>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
