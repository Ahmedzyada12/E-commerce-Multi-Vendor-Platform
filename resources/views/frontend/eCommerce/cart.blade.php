@extends('layouts.ecommrece.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('style/cart.css') }}" />
@endsection
@section('main')


    <div class="container-lg text-center text-lg-start fill-cart  ">

        <h2 class="total-products mt-4">shopping cart <span>({{ $cartItem->count() }})</span></h2>
        <div class="row">
            @if ($cartItem->count() > 0)
                <div class="col-lg-8">
                    @foreach ($cartItem as $item)
                        <div class="row cart-product">
                            <div class="col-lg-4 text-center">
                                <div class="product-image mx-auto">
                                    <img src="{{ asset('images/' . $item->product->image) }}" alt="product" />
                                </div>
                            </div>
                            <div class="col-lg-8     text-center text-lg-start">
                                <div class="product-name">{{ $item->product->name }}</div>
                                <div class="product-size">
                                    @foreach ($item->product->sizes as $size)
                                        {{ $size->id == $item->product_size ? $size->size : '' }}
                                    @endforeach
                                </div>
                                <div class="product-size d-flex">
                                    @foreach ($item->product->colors as $color)
                                        @if ($color->id == $item->product_color)
                                            {{ $color->name }}
                                            <span
                                                style="background-color: {{ $color->color }};  width: 20px;height: 20px; border: 1px solid #000; border-radius: 4%; margin-left: 20px ;"></span>
                                        @endif
                                    @endforeach
                                </div>

                                @if ($item->product->amount >= $item->quantity)
                                    <label for="" style="background:rgba(234,88,11,255); color:white;"
                                        class="badge">In
                                        Stock</label>
                                @else
                                    <label for="" class="badge bg-danger">Out Of Stock</label>
                                @endif
                                <div class="product-total-price my-3">{{ $item->product->price * $item->quantity }}$
                                    ({{ $item->quantity }})
                                </div>
                                <div class="handle-product-quantity d-flex align-items-center justify-content-between">

                                    <div class="delete-product">
                                        <i class="fa-solid fa-trash"></i>
                                        <a href=" {{ route('removeitem', $item->id) }}"
                                            class="confirm-delete ms-3">Remove</a>
                                    </div>

                                    <input type="hidden" value="{{ $item->id }}" id="id">
                                    {{-- <input type="hidden" value="{{$item}}" id="id"> --}}
                                    <i class="fa-solid fa-minus content"></i>
                                    <div class="product-number mx-3" id="quantity">
                                        {{ $item->quantity }}</div>
                                    <i class="fa-solid fa-plus content"></i>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form action="{{ route('removeallitem') }} " method="post">
                        @csrf
                        <button type="submit" class="confirm-delete ms-3 btn">Remove All</button>
                    </form>

                </div>
                <div class="col-lg-4 price p-4">
                    <div class="total-amount-container d-flex justify-content-between align-items-center">
                        <span>Total amount</span>

                        <span class="price-amount">{{ $total }}$</span>

                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-dark w-100 py-1 mt-4">
                        Complete order</a>
                </div>
            @else
                <div class="container-lg empty-cart text-center p-5 w-100 d-flex flex-column justify-content-center my-4  ">
                    <i class="fa-solid fa-bag-shopping my-3"></i>
                    <h2>no products in your basket</h2>
                    <p>
                        Your cart is empty, but it's never too late to find something you
                        love! Dive into our wide selection of products and discover your next
                        favorite. Happy shopping!"
                    </p>
                    <a href="{{ url('/shop') }}" class="btn p-2 m-1 btn-outline-dark mx-auto " style="width: fit-content ">Continue
                        Shopping</a>
                </div>
            @endif

        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('scrtipt/cart.js') }}"></script>
    {{-- <script src="{{ asset('scrtipt/cart.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            var cartItemid = $('#id').val();
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Function to perform the Ajax request
            $('.content').click(function() {
                var quantity = $('#quantity').html();
                console.log(quantity);
                $.ajax({
                    url: '/user/update/cart/' + cartItemid,
                    method: "post", // or "POST" depending on your server endpoint
                    data: {

                        'quantity': quantity
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {},
                    error: function(xhr, status, error) {
                        // Handle errors
                        // console.error(xhr.responseText);
                    }
                });
            })

            // Trigger Ajax request when inner HTML changes
        });
    </script>
@endpush
