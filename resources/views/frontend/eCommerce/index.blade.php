                                              @extends('layouts.ecommrece.master')
                                              @section('title', 'eCommerce | Home Page')

                                              @section('main')



                                                  @if (Session::has('status'))
                                                      <p
                                                          class="alert
                                                  {{ Session::get('alert-class', 'alert-info') }}">
                                                          {{ Session::get('status') }}</p>
                                                  @endif

                                                  {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                    <div class="container-fluid">
                                                        <a class="navbar-brand" href="#">{{ __('customTranslate.Category') }}</a>
                                                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                                                            aria-expanded="false" aria-label="Toggle navigation">
                                                            <span class="navbar-toggler-icon"></span>
                                                        </button>
                                                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                                            <ul class="navbar-nav">
                                                                @foreach ($cats as $cat)
                                                                    <li class="nav-item dropdown">
                                                                        <a class="nav-link dropdown-toggle" href="#"
                                                                            id="navbarDropdown{{ $cat->id }}" role="button"
                                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                                            {{ $cat->name }}
                                                                        </a>
                                                                        <ul class="dropdown-menu"
                                                                            aria-labelledby="navbarDropdown{{ $cat->id }}">
                                                                            <li><a class="dropdown-item"
                                                                                    href="?category={{ $cat->id }}">{{ __('All') }}</a></li>
                                                                            @foreach ($cat->subcategory as $subcat)
                                                                                <li><a class="dropdown-item"
                                                                                        href="?subcategory={{ $subcat->id }}">{{ $subcat->name }}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </nav> --}}


                                                  <main>
                                                      <div class="hero-section ">
                                                          <div class="container-md py-2  ">
                                                              <div class="hero-title ">
                                                                  <h6 class="current-season-ads">{{ __('customTranslate. Discover ') }}

                                                                  </h6>

                                                                  <h5 class="offers-ads  my-4">
                                                                      {{ __('customTranslate.hero') }}
                                                                  </h5>

                                                                  <a href="{{ route('shop') }}"><button
                                                                          class="btn-12 mt-5"><span>
                                                                              {{ __('customTranslate. Shop Now  ') }}</span></button></a>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="all-product mt-5">

                                                          <div class="container-md text-center">
                                                              <div class="row mb-5 mt-5">
                                                                  <div class="col-lg-3 col-md-6 col-sm-6">
                                                                      <div class="customer-support-block border-hover aos-init aos-animate"
                                                                          data-aos="fade-right">
                                                                          <div class="border-hover-two">
                                                                              <div class="row">
                                                                                  <div class="col-lg-3 col-4">
                                                                                      <div class="support-img">
                                                                                          <img src="https://emart.mediacity.co.in/demo/public/frontend/assets/images/support/shipping icon.png"
                                                                                              class="img-fluid shipping-img"
                                                                                              alt="">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-lg-9 col-8">
                                                                                      <div class="support-dtl">
                                                                                          <h5 class="support-title">Shipping
                                                                                              over all world</h5>
                                                                                          <p></p>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-lg-3 col-md-6 col-sm-6">
                                                                      <div class="customer-support-block border-hover aos-init aos-animate"
                                                                          data-aos="fade-up">
                                                                          <div class="border-hover-two">
                                                                              <div class="row">
                                                                                  <div class="col-lg-3 col-4">
                                                                                      <div class="support-img">
                                                                                          <img src="https://emart.mediacity.co.in/demo/public/frontend/assets/images/support/headset-solid.png"
                                                                                              class="img-fluid"
                                                                                              alt="">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-lg-9 col-8">
                                                                                      <div class="support-dtl">
                                                                                          <h5 class="support-title">24X7
                                                                                              Support</h5>
                                                                                          <p></p>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-lg-3 col-md-6 col-sm-6">
                                                                      <div class="customer-support-block border-hover aos-init aos-animate"
                                                                          data-aos="fade-up">
                                                                          <div class="border-hover-two">
                                                                              <div class="row">
                                                                                  <div class="col-lg-3 col-4">
                                                                                      <div class="support-img">
                                                                                          <img src="https://emart.mediacity.co.in/demo/public/frontend/assets/images/support/security.png"
                                                                                              class="img-fluid"
                                                                                              alt="">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-lg-9 col-8">
                                                                                      <div class="support-dtl">
                                                                                          <h5 class="support-title">30 Days
                                                                                              Return</h5>
                                                                                          <p></p>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-lg-3 col-md-6 col-sm-6">
                                                                      <div class="customer-support-block border-hover aos-init aos-animate"
                                                                          data-aos="fade-left">
                                                                          <div class="border-hover-two">
                                                                              <div class="row">
                                                                                  <div class="col-lg-3 col-4">
                                                                                      <div class="support-img">
                                                                                          <img src="https://emart.mediacity.co.in/demo/public/frontend/assets/images/support/money.png"
                                                                                              class="img-fluid"
                                                                                              alt="">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-lg-9 col-8">
                                                                                      <div class="support-dtl">
                                                                                          <h5 class="support-title">Money
                                                                                              Back Guarantee</h5>
                                                                                          <p></p>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <h3 class="all-product-title py-3 fw-bold">
                                                                  {{ __('customTranslate. OUR TRENDY PRODUCTS ') }}
                                                              </h3>
                                                              <ul class="home-category d-flex justify-content-center">
                                                                  <li class="active" data-category="recent">
                                                                      {{ __('customTranslate.Recent') }}</li>
                                                                  {{-- <li data-category="mobiles">
                                                                      {{ __('customTranslate. Mobiles ') }}</li>
                                                                  <li data-category="clothes">
                                                                      {{ __('customTranslate. Colthes ') }}</li>
                                                                  <li data-category="Electronic">
                                                                      {{ __('customTranslate. Electronics ') }}</li> --}}
                                                              </ul>
                                                              <div class=" all-product home">
                                                                  <div class="product row mb-5 active gy-3"
                                                                      data-category="recent">


                                                                      @foreach ($recents as $product)
                                                                          <div
                                                                              class="col-md-6 col-lg-3 text-lg-start text-center rounded">
                                                                              <div class="card shadow ">
                                                                                  <div class="image text-center border ">
                                                                                      <a
                                                                                          href="{{ route('details', $product->id) }}">
                                                                                          <img src="{{ asset('images/' . $product->image) }}"
                                                                                              width="100%"
                                                                                              height="200px" />
                                                                                      </a>
                                                                                  </div>
                                                                                  <div class="card-body">
                                                                                      <h5 class="card-title">
                                                                                          {{ $product->name }}</h5>
                                                                                      <h5 class="card-title">
                                                                                          {{ $product->price }}$ </h5>
                                                                                      <p class="card-text">
                                                                                          {{ Str::limit($product->description, 20) }}
                                                                                      </p>
                                                                                      <a href="{{ route('details', $product->id) }}"
                                                                                          class="btn btn-dark text-uppercase">
                                                                                          view more</a>
                                                                                  </div>
                                                                              </div>
                                                                          </div>

                                                                          {{-- <div class="col-md-6 col-lg-3 mt-5">
                                                                              <div class="pro-card">
                                                                                  <div class="pro-img w-100">
                                                                                     
                                                                                  </div>
                                                                                  <div class="pro-name p-3 bg-light">
                                                                                      <h6 class="text-center">
                                                                                          {{ $product->name }}</h6>
                                                                                      <p class="details">
                                                                                          {{ Str::limit($product->description, 20) }}
                                                                                      </p>
                                                                                      <p class="price fw-bold">
                                                                                         $ {{ $product->price }}</p>
                                                                                  </div>
                                                                              </div>
                                                                          </div> --}}
                                                                      @endforeach
                                                                  </div>
                                                                  {{-- <div class="product row mb-5 "
                                                                      data-category="Electronic">
                                                                      @foreach ($Electronics as $product)
                                                                          <div class="col-md-6 col-lg-3 mt-5">
                                                                              <div class="pro-card">
                                                                                  <div class="pro-img w-100">
                                                                                      <a
                                                                                          href="{{ route('details', $product->id) }}">
                                                                                          <img src="{{ asset('images/' . $product->image) }}"
                                                                                              alt="" />
                                                                                      </a>

                                                                                  </div>
                                                                                  <div class="pro-name p-3 bg-light">
                                                                                      <h6 class="text-center">
                                                                                          {{ $product->name }}</h6>
                                                                                      <p class="details">
                                                                                          {{ Str::limit($product->description, 20) }}
                                                                                      </p>
                                                                                      <p class="price fw-bold">
                                                                                          {{ $product->price }}</p>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      @endforeach
                                                                  </div> --}}
                                                                  {{-- <div class="product row " data-category="mobiles">
                                                                      @foreach ($mobiles as $product)
                                                                          <div class="col-md-6 col-lg-3 mt-5">
                                                                              <div class="pro-card">
                                                                                  <div class="pro-img w-100">
                                                                                      <a
                                                                                          href="{{ route('details', $product->id) }}">
                                                                                          <img src="{{ asset('images/' . $product->image) }}"
                                                                                              alt="" />
                                                                                      </a>

                                                                                  </div>
                                                                                  <div class="pro-name p-3 bg-light">
                                                                                      <h6 class="text-center">
                                                                                          {{ $product->name }}</h6>
                                                                                      <p class="details">
                                                                                          {{ Str::limit($product->description, 20) }}
                                                                                      </p>
                                                                                      <p class="price fw-bold">
                                                                                          {{ $product->price }}</p>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      @endforeach
                                                                  </div> --}}
                                                                  {{-- <div class="product row mb-5 " data-category="clothes">
                                                                      @foreach ($clothes as $product)
                                                                          <div class="col-md-6 col-lg-3 mt-5">
                                                                              <div class="pro-card">
                                                                                  <div class="pro-img w-100">
                                                                                      <a
                                                                                          href="{{ route('details', $product->id) }}">
                                                                                          <img src="{{ asset('images/' . $product->image) }}"
                                                                                              alt="" />
                                                                                      </a>

                                                                                  </div>
                                                                                  <div class="pro-name p-3 bg-light">
                                                                                      <h6 class="text-center">
                                                                                          {{ $product->name }}</h6>
                                                                                      <p class="details">
                                                                                          {{ Str::limit($product->description, 20) }}
                                                                                      </p>
                                                                                      <p class="price fw-bold">
                                                                                          {{ $product->price }}</p>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      @endforeach
                                                                  </div> --}}

                                                                  <a href="/shop" class="go-shop fw-bold text-uppercase">
                                                                      {{ __('customTranslate. SEE ALL PRODUCTS ') }}</a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </main>
                                              @endsection

                                              @section('js')
                                                  <script>
                                                      document.querrySelector
                                                  </script>
                                              @endsection
