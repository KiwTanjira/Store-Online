@extends('layout')

@section('content')
<div class="container">

    <div class="alert  text-left border-bottom pb-3">
        <h5>Your Shopping Cart</h5>

    </div>

    @if($cartItems->isEmpty())
    <div class="alert  text-center border-bottom pb-3">
        <h5>Your cart is currently empty.</h5>
        <p class="mt-2">Start shopping now and add items to your cart!</p>
    </div>
    @else

    <div class="space-y-5">
        @foreach($cartItems as $item)
            <div class="w-full flex max-sm:flex-col max-sm:items-center gap-2">
                <div class="row">
                    <div class="col-2 d-flex justify-content-center">
                        <!-- ภาพสินค้า -->
                        <div class="relative aspect-[3/4] max-w-[100px]">
                            <img 
                                alt="{{ $item->name }}" 
                                loading="lazy" 
                                width="150" 
                                height="150" 
                                decoding="async" 
                                class="w-full h-full object-cover object-top rounded-md" 
                                srcset="{{ asset('storage/' . $item->options->image) }} 1x, {{ asset('storage/' . $item->options->image) }}" 
                                src="{{ asset('storage/' . $item->options->image) }}" 
                                style="color: transparent;">
                        </div>
                    </div>
                    <div class="col-10">
                        <!-- รายละเอียดสินค้า -->
                        <div class="w-full space-y-3">
                            <div class="flex justify-between items-center gap-3">

                                <div class="row">
                                    <div class="col-10">
                                        <h1 class="text-ms text-neutral-800 font-semibold">{{ $item->name }}</h1>
                                    </div>

                                    <div class="col-2">
                                        <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn  center" style="width: 150px; height: 50px; color: rgb(177, 13, 13);">
                                                <i class="fas fa-trash"></i> 
                                            </button>
                                        </form>

                                        
                                    </div>
                                </div>

                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="cursor-pointer min-w-[20px]" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                                    {{--  --}}
                                </svg>

                                

                            </div>
                            <p class="text-ms font-light">฿{{$item->price}}</p>
                            
                            
                            
                            <!-- จำนวนสินค้า -->
                            <div class="flex justify-between  items-center w-fit gap-3 text-neutral-800">
                                <div>
                                    {{-- <button class="px-2 py-1 border" onclick="decreaseQuantity()">-</button> --}}
                                    <span id="quantity" class="text-ms font-light">{{ $item->qty }}</span>
                                    {{-- <button class="px-2 py-1 border" onclick="increaseQuantity()">+</button> --}}
                                </div>

                                <script>
                                    function increaseQuantity() {
                                        // เพิ่มค่า quantity ทีละ 1
                                        let quantityElement = document.getElementById("quantity");
                                        let currentQuantity = parseInt(quantityElement.innerText);
                                        quantityElement.innerText = currentQuantity + 1;
                                    }
                                
                                    function decreaseQuantity() {
                                        // ลดค่า quantity ทีละ 1 แต่ไม่ให้ต่ำกว่า 1
                                        let quantityElement = document.getElementById("quantity");
                                        let currentQuantity = parseInt(quantityElement.innerText);
                                        if (currentQuantity > 1) {
                                            quantityElement.innerText = currentQuantity - 1;
                                        }
                                    }
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
            <hr>
        @endforeach
    </div>

    <!-- สรุปยอดรวมของสินค้าในรถเข็น -->
    <div class="bg-neutral-100 p-5 rounded-md space-y-8">
        <!-- Section: Order Details Header -->
        <div class="border-b-[0.5px] pb-2 border-neutral-800">
            <h1 class="text-xl font-semibold">Order Details</h1>
        </div>
    
        <div class="space-y-3">
            <!-- Subtotal -->
            <div class="flex justify-between">
                <p class="text-neutral-500 text-sm">Subtotal</p>
                <p class="text-neutral-500 text-sm">฿{{Cart::subtotal()}}</p>
            </div>
            <hr>
    
            <!-- Delivery -->
            <div class="flex justify-between">
                <p class="text-neutral-500 text-sm">Delivery</p>
                <p class="text-neutral-500 text-sm">Free</p>
            </div>
            <hr>
    
            <!-- Discount -->
            <div class="flex justify-between">
                <p class="text-neutral-500 text-sm">Discount</p>
                <p class="text-neutral-500 text-sm">0</p>
            </div>
            <hr>
    
            <!-- Total -->
            <div class="flex justify-between">
                <p class="text-neutral-500 text-sm">Total</p>
                <p class="text-neutral-500 text-sm">฿{{Cart::subtotal()}}</p>
            </div>
            <hr>
    
            {{-- <!-- Promotion Code Input -->
            <div>
                <div class="space-y-2 flex flex-wrap justify-between items-center">
                    <input 
                        class="outline-none bg-transparent border-b border-neutral-300 p-1 placeholder:font-light placeholder:text-neutral-400 text-sm" 
                        placeholder="Promotion Code" 
                        type="text"
                    >
                    <button class="py-2 px-3 text-md text-neutral-800 bg-white rounded-xl border">
                        Apply
                    </button>
                </div>
            </div> --}}
    
            <!-- Check Out Button -->
            {{-- <button class="w-full border px-2 py-1 rounded-xl border-neutral-500 bg-pink-600 text-white">
                Check Out
            </button> --}}

            <form action="{{ url('/checkout') }}" method="POST">
                @csrf <!-- ใช้เพื่อป้องกัน CSRF -->
                <input type="hidden" name="subtotal" value="{{ Cart::subtotal() }}">
                
                <button type="submit" class="btn btn-secondary">
                    Check Out
                </button>
            </form>
            
        </div>
    </div>
    @endif
</div>
@endsection


    

        {{-- <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle">
                                <img src="{{ asset('storage/' . $item->options->image) }}" style="width: 100px; height: auto;" class="img-thumbnail">
                            </td>
                            <td class="align-middle">{{ $item->qty }}</td>
                            <td class="align-middle">฿{{ number_format($item->price, 2) }} บาท</td>
                            <td class="align-middle">฿{{ number_format($item->subtotal, 2) }} บาท</td>
                            <td class="align-middle">
                                <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 offset-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title">Cart Summary</h4>
                        <h3>Total: ฿{{ number_format(Cart::subtotal(), 2) }}</h3>
                        <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg mt-3">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div> --}}
    {{-- @endif
</div>
@endsection --}}
