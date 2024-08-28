@extends('layouts.ecommrece.master')
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection
@section('main')
    <main class="container-md py-5">
        <div class="row mt-4 h-75">

            <div class="col-md-6">

                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        @foreach ($product_image as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('product_images/' . $image->name) }}" />
                            </div>
                        @endforeach

                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div thumbsSlider="" class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($product_image as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('product_images/' . $image->name) }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- product details  -->
            <div class="col-md-6  text-lg-start">
                <div class="pagr-title p-2 bg-light">
                    <h6 class="d-inline-block">Home / the shope / {{ $product->name }}</h6>
                </div>

                <div class="main-details mt-3 justify-content-lg-start">
                    <h6 class="">{{ $product->name }} </< /h6>
                        <div class="reviews mt-2 d-flex justify-content-center justify-content-lg-start">
                            <div class="stars me-2">
                                <i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i
                                    class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i
                                    class="fa-regular fa-star"></i>
                            </div>
                            <span class="stars"> 5k+ reviews </span>
                        </div>

                        <div class="price mt-2">
                            <p>${{ $product->price }}</p>
                        </div>
                        <div>
                            <p class="">
                                {{ $product->description }}
                            </p>
                        </div>
                        <div class=" mt-2">

                            <p>
                                category :
                                {{ $product->subcategory->category->name }},
                                {{ $product->subcategory->name }}
                            </p>
                        </div>

                        <div class="d-flex flex-wrap" style="gap: 2px">
                            <h6>tags : </h6>
                            @foreach ($product->tag as $tag)
                                <span class="py-1 px-2 text-light"
                                    style="display:inline-block; width: fit-content; background-color:#00b9ff; border-radius: 10px">{{ $tag->name }}</span>
                            @endforeach
                        </div>

                </div>
                <form action="{{ route('addTocart') }}" method="POST">
                    @csrf
                    <div class="p-sizes mt-2 ">
                        <ul class="d-flex justify-content-between">
                            <div class="row mt-5">
                                @if (
                                    $product->subcategory &&
                                        $product->subcategory->category &&
                                        in_array($product->subcategory->category->name, ['Mobiles', 'Electronics']))
                                @else
                                    <div class="col-lg-6">
                                        <select class="form-select-lg mb-3 w-100" name="product_size"
                                            aria-label=".form-select-lg example">
                                            @foreach ($product->sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="col-lg-6">
                                    <select class=" form-select-lg mb-3 p-2" name="product_color"
                                        aria-label=".form-select-lg example">

                                        @foreach ($product->colors as $color)
                                            <option value="{{ $color->id }}">
                                                {{ $color->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </ul>
                    </div>

                    <div class="add-product container mt-4">
                        <div class="row">
                            <div class="container text-center">
                                <div class="row d-flex align-items-center">
                                    <div class="handle-quantity col-lg-6 d-flex ">
                                        <i class="fa-solid fa-minus"></i>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" id="vendor_id" value="{{ $product->vendor_id }}">
                                        
                                        <input type="number" name="quantity" value="1" min="1"
                                            class="form-control">
                                        <i class="fa-solid fa-plus "></i>
                                    </div>

                                    <div class="add-button col-lg-6">
                                        <button type="submit" class="magic-button w-100 py-3  text-uppercase">
                                            Add to cart
                                        </button>
                                    </div> <span class="sc-5c17cc27-0 eCGMdH wrapper1   ">
                                        <div class="sc-ba64d01c-0 laopGi">
                                            <div class="sc-ba64d01c-1 jqHMdQ d-flex">
                                                <div class="sc-ba64d01c-2 hpjkeA">
                                                    <div class="sc-ba64d01c-3 bZXrTi"><img
                                                            src="https://z.nooncdn.com/nr/product_badges/delivery_by_noon.png"
                                                            alt="Delivery 
                                        by noon"
                                                            class="sc-d13a0e88-1 cMrpQt"></div><span>Delivery </span>
                                                </div>
                                                <div class="sc-ba64d01c-4 bTuvqR"></div>
                                                <div class="sc-ba64d01c-2 hpjkeA">
                                                    <div class="sc-ba64d01c-3 bZXrTi"><img
                                                            src="https://z.nooncdn.com/nr/product_badges/high_rated_seller.png"
                                                            alt="High Rated
                                        Seller"
                                                            class="sc-d13a0e88-1 cMrpQt"></div><span>High Rated
                                                        Seller</span>
                                                </div>
                                                <div class="sc-ba64d01c-4 bTuvqR"></div>
                                                <div class="sc-ba64d01c-2 hpjkeA">
                                                    <div class="sc-ba64d01c-3 bZXrTi"><img
                                                            src="https://z.nooncdn.com/nr/product_badges/cash_on_delivery.png"
                                                            alt="Cash on 
                                        Delivery"
                                                            class="sc-d13a0e88-1 cMrpQt"></div><span>Cash on Delivery</span>
                                                </div>
                                                <div class="sc-ba64d01c-4 bTuvqR"></div>
                                                <div class="sc-ba64d01c-2 hpjkeA">
                                                    <div class="sc-ba64d01c-3 bZXrTi"><img
                                                            src="https://z.nooncdn.com/nr/product_badges/secure_transaction.png"
                                                            alt="Secure
                                        Transaction"
                                                            class="sc-d13a0e88-1 cMrpQt"></div><span>Secure
                                                        Transaction</span>
                                                </div>
                                            </div>
                                        </div>

                                    </span>
                                    <div class="product-payment-options"> <!-- Product Payment Option -->
                                        <div class="product-payment-options__container">
                                            <div class="product-payment-options__title">Discover Payment Options</div>
                                            <div class="product-payment-options__items">
                                                <div class="item"><img class="yall-loaded"
                                                        data-src="https://dfcdn.defacto.com.tr/AssetsV2/dist/img/paytabs/NBE.png"
                                                        src="https://dfcdn.defacto.com.tr/AssetsV2/dist/img/paytabs/NBE.png">
                                                </div>
                                                <div class="item"><img class="yall-loaded"
                                                        data-src="//dfcdn.defacto.com.tr/AssetsV2/dist/img/paytabs/valu.png"
                                                        src="//dfcdn.defacto.com.tr/AssetsV2/dist/img/paytabs/valu.png">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-payment-options__container">
                                            <div class="product-payment-options__title">Pay with Credit Card and Enjoy
                                                Extra Discount</div>
                                            <div class="product-payment-options__items">
                                                <div class="item"><img class="yall-loaded"
                                                        data-src="https://dfcdn.defacto.com.tr/AssetsV2/dist/img/bank-card.svg"
                                                        src="https://dfcdn.defacto.com.tr/AssetsV2/dist/img/bank-card.svg">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>


            </div>

        </div>
        </div>
        </div>
        </div>
        </div>
    </main>

    <div class="container">
        <h3>Product Ratings & Reviews</h3>
        <div class="row">
            {{-- <div class="col-6"> --}}
            <div class="reviews  overflow-auto" style="height: 200px; over">
                @foreach ($reviews as $review)
                    <div class="card mb-3">
                        <h5 class="card-header">{{ $review->user->name }}</h5>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">{{ $review->comment }}</p>
                            <a href="#" class="btn btn-primary"> {{ $review->rating }}</a>
                        </div>
                    </div>
                @endforeach

            </div>
            @auth
                <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <select name="rating" id="rating" class="form-control" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            @endauth
        </div>

        {{-- <div class="col-md-6">

                <div class="row">
                    <div class="col-xs-12 col-md-6 w-100">
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 text-center">
                                    <h1 class="rating-num">
                                        4.0</h1>
                                    <div class="rating">
                                        <span class="glyphicon glyphicon-star"></span><span
                                            class="glyphicon glyphicon-star">
                                        </span><span class="glyphicon glyphicon-star"></span><span
                                            class="glyphicon glyphicon-star">
                                        </span><span class="glyphicon glyphicon-star-empty"></span>
                                    </div>
                                    <div>
                                        <span class="glyphicon glyphicon-user"></span>1,050,008 total
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="row rating-desc">
                                        <div class="col-xs-3 col-md-3 text-right">
                                            <span class="glyphicon glyphicon-star"></span>5
                                        </div>
                                        <div class="col-xs-8 col-md-9">
                                            <div class="progress progress-striped">
                                                <div class="progress-bar progress-bar-success" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 80%">
                                                    <span class="sr-only">80%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end 5 -->
                                        <div class="col-xs-3 col-md-3 text-right">
                                            <span class="glyphicon glyphicon-star"></span>4
                                        </div>
                                        <div class="col-xs-8 col-md-9">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 60%">
                                                    <span class="sr-only">60%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end 4 -->
                                        <div class="col-xs-3 col-md-3 text-right">
                                            <span class="glyphicon glyphicon-star"></span>3
                                        </div>
                                        <div class="col-xs-8 col-md-9">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 40%">
                                                    <span class="sr-only">40%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end 3 -->
                                        <div class="col-xs-3 col-md-3 text-right">
                                            <span class="glyphicon glyphicon-star"></span>2
                                        </div>
                                        <div class="col-xs-8 col-md-9">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 20%">
                                                    <span class="sr-only">20%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end 2 -->
                                        <div class="col-xs-3 col-md-3 text-right">
                                            <span class="glyphicon glyphicon-star"></span>1
                                        </div>
                                        <div class="col-xs-8 col-md-9">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar"
                                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 15%">
                                                    <span class="sr-only">15%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end 1 -->
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> --}}

        {{-- <h4>{{ $product->name }}</h4> --}}

    </div>

@endsection
@section('js')
    <script src="{{ asset('scrtipt/productDetails.js') }}"></script>
    <script src="{{ asset('scrtipt/swiper.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>

    {{-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
@endsection
