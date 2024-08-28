@extends('Bacckend.master')

@section('content')
    <div class="container ">
        <div class="card-head">
            <a href="{{ route('indexorder') }}" class="btn btn-outline-info my-1">Back</a>
        </div>
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Vendor Order Details</div>
            </div>
            <!--end breadcrumb-->

            <hr />


            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4>Shipping Details</h4>
                        </div>
                        <hr>
                        <div class="card-body">
                            <table class="table" style="background:#F4F6FA;font-weight: 600;">


                                <tr>
                                    <th>Shipping Phone:</th>
                                    <th>{{ $order->phone }}</th>
                                </tr>

                                <tr>
                                    <th>Shipping Email:</th>
                                    <th>{{ $order->email }}</th>
                                </tr>

                                <tr>
                                    <th>Shipping Address:</th>
                                    <th>{{ $order->street_address }}</th>
                                </tr>


                                <tr>
                                    <th>Post Code :</th>
                                    <th>{{ $order->postal_code }}</th>
                                </tr>

                                <tr>
                                    <th>Order Date :</th>
                                    <th>{{ $order->created_at }}</th>
                                </tr>

                            </table>

                        </div>

                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Details
                                <span class="text-danger">Invoice : {{ $order->number }} </span>
                            </h4>
                        </div>
                        <hr>
                        <div class="card-body">
                            <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                <tr>
                                    <th> Name :</th>
                                    <th>{{ $order->user->name }}</th>
                                </tr>

                                <tr>
                                    <th>Phone :</th>
                                    <th>{{ $order->phone }}</th>
                                </tr>

                                <tr>
                                    <th>Payment Type:</th>
                                    <th>{{ $order->payment_gateway }}</th>
                                </tr>

                                <tr>
                                    <th>Invoice:</th>
                                    <th class="text-danger">{{ $order->number }}</th>
                                </tr>

                                <tr>
                                    <th>Order Amonut:</th>
                                    <th>${{ $order->total_price }}</th>
                                </tr>

                                <tr>
                                    <th>Order Status:</th>
                                    <th><span class="badge bg-danger" style="font-size: 15px;">{{ $order->status }}</span>
                                    </th>
                                </tr>




                            </table>

                        </div>

                    </div>
                </div>
            </div>


            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1 mt-5">
                <div class="col">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table" style="font-weight: 600;">
                                <tbody>
                                    <tr>
                                        <td class="col-md-1">
                                            <label>Image </label>
                                        </td>
                                        <td class="col-md-2">
                                            <label>Product Name </label>
                                        </td>
                                        <td class="col-md-2">
                                            <label>Vendor Name </label>
                                        </td>

                                        {{-- <td class="col-md-1">
                                            <label>Color </label>
                                        </td> --}}
                                        <td class="col-md-1">
                                            <label>Size </label>
                                        </td>
                                        <td class="col-md-1">
                                            <label>Quantity </label>
                                        </td>

                                        <td class="col-md-3">
                                            <label>Price </label>
                                        </td>

                                    </tr>


                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="col-md-1">
                                                <label><img src="{{ asset('images/' . $item->product->image) }}"
                                                        style="width:50px; height:50px;"> </label>
                                            </td>
                                            <td class="col-md-2">
                                                <label>{{ $item->product->name }}</label>
                                            </td>
                                            @if ($item->vendor_id == null)
                                                <td class="col-md-2">
                                                    <label>Owner </label>
                                                </td>
                                            @else
                                                <td class="col-md-2">
                                                    <label>{{ $item->product->vendor->name }} </label>
                                                </td>
                                            @endif

                                            {{-- <td>
                                                <div
                                                    class="col-md- text-center d-flex justify-content-center align-items-center">
                                                    @foreach ($item->product->colors as $color)
                                                        @if ($item->cart && $color->id == $item->cart->color_product)
                                                            <span style="background-color: {{ $color->color }};"></span>
                                                            {{ $color->name }}
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td> --}}


                                            @if ($item->size == null)
                                                <td class="col-md-1">
                                                    <label>.... </label>
                                                </td>
                                            @else
                                                <td class="col-md-1">
                                                    <label>{{ $item->size }} </label>
                                                </td>
                                            @endif
                                            <td class="col-md-1">
                                                <label>{{ $item->quantity }} </label>
                                            </td>

                                            <td class="col-md-3">
                                                <label>${{ $item->price }} <br> Total = ${{ $item->price * $item->quantity }}
                                                </label>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>



                    </div>
                </div>

            </div>


        </div>
        {{-- <section class=" gradient-custom">
            <div class="container py-5 ">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-11 ">
                        <div class=" card-box  " style="border-radius: 10px;">
                            <div class="card-header px-4 py-5">
                                <h5 class="text-center mb-0">Thanks for your Order, <span
                                        style="color: #a8729a;">{{ $order->first_name }}</span>!</h5>
                                <h5 class="text-center mb-0"> Order Number <span
                                        style="color: #a8729a;">{{ $order->number }}</span></h5>
                            </div>
                            <div class=" p-4">
                                <div class="shadow-0 border mb-4">
                                    @foreach ($order->orderItems as $item)
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img style="width: 100px ; height:100px;"
                                                        src="{{ asset('images/' . $item->product->image) }}"
                                                        class="img-fluid" alt="Phone">
                                                </div>
                                                <div
                                                    class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0"> {{ $item->product->name }}</p>
                                                </div>

                                                <div
                                                    class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">Qty: {{ $item->quantity }}</p>
                                                </div>
                                                <div
                                                    class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">${{ $item->price }}</p>
                                                </div>
                                            </div>
                                            <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                        </div>
                                    @endforeach

                                </div>

                                <div class="d-flex justify-content-between pt-2">
                                    <p class="fw-bold mb-0">User Details</p>
                                </div>

                                <div class="d-flex justify-content-between pt-2">
                                    <p class="text-muted mb-0">Name: {{ $order->first_name }} {{ $order->last_name }} </p>
                                    {{-- <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> $19.00</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-0">Email : {{ $order->email }}</p>
                                   
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-0">Address : {{ $order->street_address }} ,
                                        {{ $order->city }}
                                    </p>
                                   
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-0">Postl code : {{ $order->postal_code }}
                                    </p>
                                   
                                </div>

                                <div class="d-flex justify-content-between mb-5">
                                    <p class="text-muted mb-0">Phone : {{ $order->phone }}</p>
                                  
                                </div>

                            </div>
                            <div class="card-footer border-0 px-4 py-5"
                                style="background-color: #0c0a0b; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                @foreach ($order->orderItems as $item)
                                    <h5
                                        class="d-flex align-items-center justify-content-center text-white text-uppercase mb-0">
                                        <br>
                                        <span class="h2 mb-0 ms-2 text-white"> Total
                                            paid: ${{ $item->price * $item->quantity }}</span>
                                    </h5>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>  --}}
    @endsection
