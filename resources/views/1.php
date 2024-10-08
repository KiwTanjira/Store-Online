@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Your Shopping Cart</h2>

    @if($cartItems->isEmpty())
        <div class="alert alert-info text-center">
            Your cart is currently empty.
        </div>
    @else
        <div class="table-responsive">
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
        </div>
    @endif
</div>
@endsection
