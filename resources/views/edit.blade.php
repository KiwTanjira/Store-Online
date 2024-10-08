<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Edit Product')</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('css/add_products.css') }}">
    <style>
        .no-underline {
            text-decoration: none;
        }
    </style>
    {{-- <script>
        function showPopup() {
            // แสดงป๊อปอัป
            alert("เพิ่มหมวดหมู่สำเร็จแล้ว!");
        }
    </script> --}}
</head>
<body>

<div class="container">

    <div class="admin-product-form-container">


        <form  method="POST" enctype="multipart/form-data" action="{{route('update',$products->id)}}">
            @csrf <!-- เพื่อป้องกัน CSRF attack จำเป็นต้องเพิ่มเมื่อใช้แบบฟอร์ม -->
            <h3>Edit Product</h3>
            <input type="text" placeholder="Enter product name" name="name" class="box" value="{{ $products->name}}" required>
            <input type="number" placeholder="Enter product price" name="price" class="box"  value="{{ $products->price}}" required>
            <input type="number" placeholder="Enter product quantity" name="quantity" class="box" value="{{ $products->quantity}}" required>
            <select name="category_id" class="box" required>
                <option value="" disabled selected>Enter product categories</option>

                @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $products->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                        </option>
                @endforeach
            </select>
            <input type="text" placeholder="Enter description" name="description" class="description" value="{{ $products->description}}" required>
            
            
            <!-- Input สำหรับเลือกไฟล์ใหม่ -->
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="image_products" class="box">

                <!-- Hidden input สำหรับเก็บ path ของภาพเดิม -->
                <input type="hidden" name="old_image" value="{{ $products->image_products }}">
            
            {{-- <input type="submit" class="btn" name="update_product" value="Update Product">
            <a href="{{ url('/welcome') }}" class="btn">Go Home</a> --}}

            <div class="row">
                <div class="col text-center">
                    <input type="submit" class="btn btn-primary me-2" name="update_product" value="Update Product">
                    <a href="{{ url('/welcome') }}" class="btn btn-secondary no-underline" style="background-color: #474849;">Go Home</a>
                </div>
            </div>
        
            @error('name')
            <div class="my-2">
                <span class="text-danger">{{$message}}</span>
            </div>
            @enderror

            @error('price')
            <div class="my-2">
                <span class="text-danger">{{$message}}</span>
            </div>
            @enderror
            
            @error('quantity')
            <div class="my-2">
                <span class="text-danger">{{$message}}</span>
            </div>
            @enderror

            @error('category_id')
            <div class="my-2">
                <span class="text-danger">{{$message}}</span>
            </div>
            @enderror

            @error('description')
            <div class="my-2">
                <span class="text-danger">{{$message}}</span>
            </div>
            @enderror

            @error('image_products')
            <div class="my-2">
                <span class="text-danger">{{$message}}</span>
            </div>
            @enderror

        </form>

    </div>

</div>

</body>
</html>
