<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Edit Categories')</title>

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

        <form  method="POST" action="{{route('updatecategory', $categories->id)}}" enctype="multipart/form-data">
            @csrf <!-- เพื่อป้องกัน CSRF attack จำเป็นต้องเพิ่มเมื่อใช้แบบฟอร์ม -->
            <h3>Edit Categories</h3>
            <input type="text" name="name" placeholder="Enter category name" class="box" value="{{ $categories->name}}" required>
            
            <!-- Input สำหรับเลือกไฟล์ใหม่ -->
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="image_categories" class="box">

            <!-- Hidden input สำหรับเก็บ path ของภาพเดิม -->
            <input type="hidden" name="old_image" value="{{ $categories->image_categories }}">
            
            
            

            <div class="row">
                <div class="col text-center">
                    <input type="submit" class="btn btn-primary me-2" name="update_Category" alue="Update Category">
                    <a href="{{ url('/welcome') }}" class="btn btn-secondary no-underline" style="background-color: #474849;">Go Home</a>
                </div>
            </div>

            @error('name')
            <div class="my-2">
                <span class="text-danger">{{$message}}</span>
            </div>
            @enderror

            

        </form>
        
    </div>

</div>

</body>
</html>
