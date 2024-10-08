@extends('layout')

@section('title')
        Product description
@endsection

@section('content') <!-- เริ่มการกำหนดเนื้อหาของหน้า -->

<style>
        .fixed-right {
            right: 2rem; /* ขยับปุ่มจากด้านขวาของหน้าจอ */
        }
        .center {
        text-align: center; /* จัดข้อความให้อยู่ตรงกลาง */
        
        }
        .left{
        text-align: left; 
        }

</style>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <!-- คอลัมน์ซ้าย -->
        <div class="col-md-4">
            <div class="bg-light p-3 border " style="border-radius: 7px;"> <!-- กำหนดพื้นหลังและขอบ -->
                <div class="row"> 
                        <img src="{{ asset('storage/' . $product->image_products) }}" style="width: 100%; height: auto;"> 
                    </div>
                    
                   
            
                <div class="row mt-3 "> <!-- เริ่มต้นแถวใหม่สำหรับการแบ่งคอลัมน์ -->
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="col-md-2 text-center"> <!-- คอลัมน์ -->
                            <p></p>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- คอลัมน์ขวา -->
        <div class="col-md-8 ">
                <div class="bg-light p-4 border rounded shadow-sm "> <!-- กำหนดพื้นหลัง, ขอบ, มุมมน และเงา -->
                <h1 class="card-title fw-bold">{{ $product->name }}</h1> <!-- เพิ่มความหนาของตัวอักษร -->
                <h2 class="card-title mt-2 border-bottom pb-3" style="color: #fa7510;">฿ {{ $product->price }}</h2>
        
                <div class="mt-1">
                        {{-- <div class="row align-items-center"> <!-- แถวสำหรับ Color -->
                                <div class="col-md-2 text-center">
                                        <p class="fw-semibold">Color</p> <!-- เพิ่มความหนา -->
                                        <p class="text-muted">ส้ม</p> <!-- เปลี่ยนสีเป็นสีเทา -->
                                </div>
                        </div> --}}
        
                        <div class="row mt-2"> 
                                <form action="{{ route('cart.store', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <div class="row mt-4 justify-content-center"> 
                                        <!-- แถวสำหรับ Quantity -->
                                        <div class="col-6 my-2 text-center">
                                                <h3><p class="nav-link px-2 text-body-secondary text-center">Quantity</p> </h3>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="row justify-content-center"> 
                                        <!-- แถวสำหรับฟิลด์ป้อนข้อมูล -->
                                        <div class="col-6 border-bottom pb-3 text-center">
                                            <input type="number" class="form-control mx-auto" name="quantity" style="width: 100px;" min="1" required>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-md-12 my-2 ">
                                        
                                        <h3><p class="nav-link px-2 text-body-secondary text-center">Description</p> </h3>
                                        <p class="text-muted my-3">{{ $product->description }}</p>
                                    </div>
                                    
                                    <div class="row mt-4 justify-content-center"> 
                                        <button type="submit" class="btn btn-outline-secondary center" style="width: 150px; height: 50px; background-color: rgb(8, 4, 117); color: white;">
                                                <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                    </div>
                                </form>
                        </div>
                            
                </div>
        </div>
   
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection