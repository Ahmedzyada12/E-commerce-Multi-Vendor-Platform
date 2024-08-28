@extends('layouts.ecommrece.master')
@section('title', 'eCommerce | Home Page')

@section('main')
    <main>
        <div class="hero-section">
            <div class="container-md py-2">
                <div class="hero-title text-center text-lg-start">
                    <h6 class="current-season-ads">New trend</h6>
                    <h2 class="main-title mx-lg-0 mx-auto my-4">
                        Lorem ipsum, dolor sit amet consectetur .
                    </h2>
                    <h5 class="offers-ads">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    </h5>
                    <a href="{{ route('shop') }}"><button class="btn-12 mt-5"><span>
                                {{ __('customTranslate. Shop Now  ') }}</span></button></a>
                </div>
            </div>
        </div>



        <div class="all-product mt-5">

            <div class="container-md text-center">
                <div class="row mb-5 mt-5">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="customer-support-block border-hover aos-init aos-animate" data-aos="fade-right">
                            <div class="border-hover-two">
                                <div class="row">
                                    <div class="col-lg-3 col-4">
                                        <div class="support-img">
                                            <img src="https://emart.mediacity.co.in/demo/public/frontend/assets/images/support/shipping icon.png"
                                                class="img-fluid shipping-img" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-8">
                                        <div class="support-dtl">
                                            <h5 class="support-title">Shipping over all world</h5>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="customer-support-block border-hover aos-init aos-animate" data-aos="fade-up">
                            <div class="border-hover-two">
                                <div class="row">
                                    <div class="col-lg-3 col-4">
                                        <div class="support-img">
                                            <img src="https://emart.mediacity.co.in/demo/public/frontend/assets/images/support/headset-solid.png"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-8">
                                        <div class="support-dtl">
                                            <h5 class="support-title">24X7 Support</h5>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="customer-support-block border-hover aos-init aos-animate" data-aos="fade-up">
                            <div class="border-hover-two">
                                <div class="row">
                                    <div class="col-lg-3 col-4">
                                        <div class="support-img">
                                            <img src="https://emart.mediacity.co.in/demo/public/frontend/assets/images/support/security.png"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-8">
                                        <div class="support-dtl">
                                            <h5 class="support-title">30 Days Return</h5>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="customer-support-block border-hover aos-init aos-animate" data-aos="fade-left">
                            <div class="border-hover-two">
                                <div class="row">
                                    <div class="col-lg-3 col-4">
                                        <div class="support-img">
                                            <img src="https://emart.mediacity.co.in/demo/public/frontend/assets/images/support/money.png"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-8">
                                        <div class="support-dtl">
                                            <h5 class="support-title">Money Back Guarantee</h5>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="all-product-title py-3 fw-bold">{{ __('customTranslate. OUR TRENDY PRODUCTS ') }}</h3>
                <ul class="home-category d-flex justify-content-center">
                    <li class="active" data-category="recent"> {{ __('customTranslate.Recent') }}</li>
                    <li data-category="mobiles">{{ __('customTranslate. Mobiles ') }}</li>
                    <li data-category="clothes">{{ __('customTranslate. Colthes ') }}</li>
                    <li data-category="Electronics">{{ __('customTranslate. Electronics ') }}</li>
                </ul>
                @if (Auth::check())
                    @if (Auth::user()->hasRole(3))
                        <div class=" all-product home">
                            <div class="product row mb-5 active" data-category="recent">
                                @foreach ($Recents as $product)
                                    <div class="col-md-6 col-lg-3 mt-5">
                                        <div class="pro-card">
                                            <div class="pro-img w-100">
                                                <a href="{{ route('details', $product->id) }}">
                                                    <img src="{{ asset('images/' . $product->image) }}" alt="" />
                                                </a>

                                            </div>
                                            <div class="pro-name p-3 bg-light">
                                                <h6 class="text-center">{{ $product->name }}</h6>
                                                <p class="details">{{ Str::limit($product->description, 20) }}</p>
                                                <p class="price fw-bold">{{ $product->price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="product row mb-5 " data-category="Electronics">
                                @foreach ($Electronics as $product)
                                    <div class="col-md-6 col-lg-3 mt-5">
                                        <div class="pro-card">
                                            <div class="pro-img w-100">
                                                <a href="{{ route('details', $product->id) }}">
                                                    <img src="{{ asset('images/' . $product->image) }}" alt="" />
                                                </a>

                                            </div>
                                            <div class="pro-name p-3 bg-light">
                                                <h6 class="text-center">{{ $product->name }}</h6>
                                                <p class="details">{{ Str::limit($product->description, 20) }}</p>
                                                <p class="price fw-bold">{{ $product->price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="product row " data-category="mobiles">
                                @foreach ($Mobiles as $product)
                                    <div class="col-md-6 col-lg-3 mt-5">
                                        <div class="pro-card">
                                            <div class="pro-img w-100">
                                                <a href="{{ route('details', $product->id) }}">
                                                    <img src="{{ asset('images/' . $product->image) }}" alt="" />
                                                </a>

                                            </div>
                                            <div class="pro-name p-3 bg-light">
                                                <h6 class="text-center">{{ $product->name }}</h6>
                                                <p class="details">{{ Str::limit($product->description, 20) }}</p>
                                                <p class="price fw-bold">{{ $product->price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="product row mb-5 " data-category="clothes">
                                @foreach ($Clothes as $product)
                                    <div class="col-md-6 col-lg-3 mt-5">
                                        <div class="pro-card">
                                            <div class="pro-img w-100">
                                                <a href="{{ route('details', $product->id) }}">
                                                    <img src="{{ asset('images/' . $product->image) }}" alt="" />
                                                </a>

                                            </div>
                                            <div class="pro-name p-3 bg-light">
                                                <h6 class="text-center">{{ $product->name }}</h6>
                                                <p class="details">{{ Str::limit($product->description, 20) }}</p>
                                                <p class="price fw-bold">{{ $product->price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                            <a href="/shop" class="go-shop fw-bold text-uppercase">
                                {{ __('customTranslate. SEE ALL PRODUCTS ') }}</a>
                        </div>
                    @else
                        {{-- <div class=" all-product home">
                    <div class="product row mb-5 active" data-category="recent">
                        @foreach ($recents as $product)
                            <div class="col-md-6 col-lg-3 mt-5">
                                <div class="pro-card">
                                    <div class="pro-img w-100">
                                        <a href="{{ route('details', $product->id) }}">
                                            <img src="{{ asset('images/' . $product->image) }}" alt="" />
                                        </a>
                                        <div class="add-to-cart">
                                            <p class="">ADD TO CART</p>
                                        </div>
                                    </div>
                                    <div class="pro-name p-3 bg-light">
                                        <h6 class="text-center">{{ $product->name }}</h6>
                                        <p class="details">{{ Str::limit($product->description, 20) }}</p>
                                        <p class="price fw-bold">{{ $product->price }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="product row mb-5 " data-category="Electronics">
                        @foreach ($Electronics as $product)
                            <div class="col-md-6 col-lg-3 mt-5">
                                <div class="pro-card">
                                    <div class="pro-img w-100">
                                        <a href="{{ route('details', $product->id) }}">
                                            <img src="{{ asset($product->image) }}" alt="" />
                                        </a>
                                        <div class="add-to-cart">
                                            <p class="">ADD TO CART</p>
                                        </div>
                                    </div>
                                    <div class="pro-name p-3 bg-light">
                                        <h6 class="text-center">{{ $product->name }}</h6>
                                        <p class="details">{{ Str::limit($product->description, 20) }}</p>
                                        <p class="price fw-bold">{{ $product->price }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="product row " data-category="mobiles">
                        @foreach ($mobiles as $product)
                            <div class="col-md-6 col-lg-3 mt-5">
                                <div class="pro-card">
                                    <div class="pro-img w-100">
                                        <a href="{{ route('details', $product->id) }}">
                                            <img src="{{ asset('images/' . $product->image) }}" alt="" />
                                        </a>
                                        <div class="add-to-cart">
                                            <p class="">ADD TO CART</p>
                                        </div>
                                    </div>
                                    <div class="pro-name p-3 bg-light">
                                        <h6 class="text-center">{{ $product->name }}</h6>
                                        <p class="details">{{ Str::limit($product->description, 20) }}</p>
                                        <p class="price fw-bold">{{ $product->price }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="product row mb-5 " data-category="clothes">
                        @foreach ($clothes as $product)
                            <div class="col-md-6 col-lg-3 mt-5">
                                <div class="pro-card">
                                    <div class="pro-img w-100">
                                        <a href="{{ route('details', $product->id) }}">
                                            <img src="{{ asset('images/' . $product->image) }}" alt="" />
                                        </a>
                                        <div class="add-to-cart">
                                            <p class="">ADD TO CART</p>
                                        </div>
                                    </div>
                                    <div class="pro-name p-3 bg-light">
                                        <h6 class="text-center">{{ $product->name }}</h6>
                                        <p class="details">{{ Str::limit($product->description, 20) }}</p>
                                        <p class="price fw-bold">{{ $product->price }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <a href="/shop" class="go-shop fw-bold text-uppercase">
                        See all products</a>
                </div>    --}}

                    @endif
                @endif
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        document.querrySelector
    </script>
@endsection
