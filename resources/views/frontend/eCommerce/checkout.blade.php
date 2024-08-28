@extends('layouts.ecommrece.master')
@section('main')
    <div class="container mt-3">
        <form action="{{ route('store.products.myfatoorah') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5>Basic Detail</h5>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6 my-2">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value=""
                                        placeholder="First Name" required>
                                </div>
                                <div class="col-md-6  my-2">
                                    <label for="firstname">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value=""
                                        placeholder="Last Name" required>
                                </div>
                                <div class="col-md-6  my-2">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" value=""
                                        placeholder="email@example.com" required>
                                </div>
                                <div class="col-md-6  my-2">
                                    <label for="email">Phone Number</label>
                                    <input type="number" name="phone" class="form-control" value=""
                                        placeholder="92313587420" min="5" required>
                                </div>
                                <div class="col-md-6  my-2">
                                    <label for="email"> Street_address</label>
                                    <input type="text" name="street_address" class="form-control" value=""
                                        placeholder=" Street_address" required>
                                </div>
                                <div class="col-md-6  my-2">
                                    <label for="email"> City</label>
                                    <input type="text" name="city" class="form-control" value=""
                                        placeholder="Enter city" required>
                                </div>
                                <div class="col-md-6  my-2">
                                    <label for="email">Country</label>
                                    <input type="text" name="country" class="form-control" value=""
                                        placeholder="country" required>
                                </div>
                                <div class="col-md-6  my-2">
                                    <label for="email">State</label>
                                    <input type="text" name="state" class="form-control" value=""
                                        placeholder="Punjab" required>
                                </div>
                                <div class="col-md-6  my-2">
                                    <label for="email">Zip Code</label>
                                    <input type="number" name="postal_code" class="form-control" value=""
                                        placeholder="postal_code" min="1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card border-0 ">
                        <div class="card-body">
                            <h5>Order Detail</h5>
                            <hr>
                            <table class="table table-stripped">
                                <tbody>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @foreach ($CartItem as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->product->price }}</td>
                                            <td>{{ $item->product->price * $item->quantity }}</td>
                                            <input type="hidden" name="vendor_id" value="{{ $item->vendor_id }}">
                                            <input type="hidden" name="category_id"
                                                value="{{ $item->product->category->id }}">
                                            <input type="hidden" name="item" value="{{ $item }}">

                                            <td></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @php
                                foreach ($CartItem as $item) {
                                    $total += $item->product->price * $item->quantity;
                                }
                            @endphp
                            <input type="hidden" name="total" value="{{ $total }}">
                            <hr>
                            <span class="border p-2 rounded float-start">Cart Total : {{ $total }}</span>
                            <br>
                            <div class="form-group">
                                {{-- <label class=" float-start" for="coupon_code">Coupon Code</label> --}}
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control mt-4 mb-4"
                                    placeholder="Enter coupon code">
                            </div>

                            <button type="submit" class="btn btn-outline-dark float-end">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
