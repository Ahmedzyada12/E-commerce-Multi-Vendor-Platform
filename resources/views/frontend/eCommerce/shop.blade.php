@extends('layouts.ecommrece.master')
@section('title', 'eCommerce | Shop Page')

@section('main')

    {{-- <main>
        <div class="container-md mt-5">
            <div class="row">
                <!-- filter and categotries sidebar sidebar  -->

                <div class="col-md-3">
                    <div class="wrapper">
                        <ul class="pt-3 ">
                            <li>
                                <h6>Product categories</h6>
                                <ul class="category-list">
                                    @foreach ($subCats as $item)
                                        <li class="category"><a
                                                href="?subcategory={{ $item->id }}">{{ $item->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <h6>Price</h6>
                                <div class="price">
                                    <div class="">
                                        <div class="price-input">
                                            <div class="field">
                                                <span>Min</span>
                                                <input type="number" class="input-min" value="2500" />
                                            </div>
                                            <div class="separator">-</div>
                                            <div class="field">
                                                <span>Max</span>
                                                <input type="number" class="input-max" value="7500" />
                                            </div>
                                        </div>
                                        <div class="slider">
                                            <div class="progress"></div>
                                        </div>
                                        <div class="range-input">
                                            <input type="range" class="range-min" min="0" max="10000"
                                                value="2500" step="100" />
                                            <input type="range" class="range-max" min="0" max="10000"
                                                value="7500" step="100" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- main page content  -->
                <div class="col-md-9">
                    <!-- <div class="panner h-50 bg-dark">
                                                </div> -->
                    <div class="pagr-title p-5 bg-light">
                        <h6 class="d-inline-block">Home / the shope</h6>
                    </div>
                    <div class="product row mb-5">
                        @foreach ($products as $product)
                            <div class="col-md-6 col-lg-4 mt-5">
                                <div class="pro-card">
                                    <div class="pro-img  w-100">
                                        <a href="./productDetails.html">
                                            <img src="{{ asset($product->image) }}" alt="" />
                                        </a>
                                        <div class="add-to-cart">
                                            <p class="">ADD TO CART</p>
                                        </div>
                                    </div>
                                    <div class="pro-name p-3 bg-light">
                                        <h6 class="text-center">{{ $product->name }}</h6>
                                        <p class="details">{{ $product->description }}.</p>
                                        <p class="price fw-bold">${{ $product->price }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="p-5 mb-5 mt-5 d-flex justify-content-between align-items-center">
                        <span class="fw-bold">
                            < Prev</span>
                                <span class="page-num">
                                    <ul class="d-flex">
                                        <li>1</li>
                                        <li>2</li>
                                        <li>3</li>
                                        <li>4</li>
                                    </ul>
                                </span>
                                <span class="fw-bold"> Next ></span>
                    </div>
                </div>
            </div>
        </div> 
    </main>  --}}
    <main>
        <!-- filterModal -->

        <div class="offcanvas offcanvas-start" tabindex="-1" id="filterModal" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h3 class="offcanvas-title" id="offcanvasNavbarLabel">Filter</h3>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body ">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <h3> {{ __('customTranslate.Category') }}</h3>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            @foreach ($cats as $cat)
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ $cat->name }}" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    {{ $cat->name }}
                                </button>

                        </h2>
                        <div id="{{ $cat->name }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">

                            <li><a href="?category={{ $cat->id }}">All</a></li>

                            @foreach ($cat->subcategory as $item)
                                <li> <a href="?subcategory={{ $item->id }}">{{ $item->name }}</a> </li>
                            @endforeach
                        </div>
                        @endforeach

                        <div class="price-filter p-2">
                            <h3 class="border-bottom py-2">{{ __('customTranslate.Price') }} </h3>
                            <form class="handle-price" action="{{ route('shop') }}" method="GET">
                                <div class="price-input d-flex justify-content-between">
                                    <input class="w-50 p-2" type="text" name="min_price" minlength="1" maxlength="9"
                                        placeholder="min price" value="" />
                                    <input class="w-50 p-2 ms-2" type="text" name="max_price" minlength="1"
                                        maxlength="9" placeholder="max price" value="" />
                                </div>
                                <button type="submit" class="btn btn-dark w-100 mt-1">
                                    {{ __('customTranslate. Apply Price') }}
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- filterModal -->

        <div class="container-md mt-5">
            <div class="pagr-title p-5 bg-light">
                <h6 class="d-inline-block">{{ __('customTranslate.Home') }} / {{ __('customTranslate.Shop') }} </h6>
            </div>
            <div class="get-filter-modal d-flex justify-content-between px-4 pt-4">
                <a href="#" class="show-filter-btn px-4 py-2 rounded-pill" data-bs-toggle="offcanvas"
                    data-bs-target="#filterModal" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <i class="fa-solid fa-filter me-3"></i>Show filter</a>
                <a href="{{ route('shop') }}" class="clear-filter-btn px-4 py-2 rounded-pill">Clear filter</a>
            </div>
            <div class="product row mb-5">
                @foreach ($products as $product)
                    <div class="col-md-6 col-lg-4 col-xl-3 mt-5">
                        <div class="pro-card">
                            <div class="pro-img w-100">
                                <a href="{{ route('details', $product->id) }}">
                                    <img src="{{ asset('images/' . $product->image) }}" alt="" />
                                </a>

                            </div>
                            <div class="pro-name p-3 text-center bg-light">
                                <h6 class="text-center">{{ $product->name }}</h6>
                                <p class="details">{{ Str::limit($product->description, 20) }}.</p>
                                <p class="price fw-bold">${{ $product->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $products->links() }}

        </div>
    </main>

@endsection
