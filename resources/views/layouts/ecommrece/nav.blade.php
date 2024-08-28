<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 py-lg-0">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div>
            {{-- <div class="container fixed-top fixed-bottom"
                style="position: fixed;          left: 50%;top: 50%;
            transform: translate(-50%, -50%);   background-color: lightblue; ">

                <div class="row height d-flex justify-content-center align-items-center">

                    <div class="col-md-8">

                        <div class="search">
                            <i class="fa fa-search"></i>
                            <input type="text" class="form-control" placeholder="Have a question? Ask Now">
                            <button class="btn btn-primary">Search</button>
                        </div>

                    </div>

                </div>
            </div> --}}

            <button class="btn btn-dark search-submit mx-3 d-lg-none" type="submit" value="search"
                data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body">
                            <form class="d-flex flex-grow-1 	" action="{{ route('search') }}" method="get">
                                @csrf
                                <input class="form-control me-2" id="searchInput" name="search" type="search"
                                    placeholder="Search" aria-label="Search" />
                                <button class="btn btn-dark search-submit" type="submit" value="search">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <a class="navbar-brand" href="{{ route('homePage') }}">E-commerce</a>
        </div>

        <div class="collapse navbar-collapse text-center" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item text-center">
                    <a class="nav-link active" aria-current="page" href="{{ route('homePage') }}">
                        {{ __('customTranslate.home') }}</a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link" href="{{ route('shop') }}">{{ __('customTranslate.shop') }}</a>
                </li>
                <li class="nav-item  w-50 mx-auto">
                    <div class="btn-group d-flex flex-column ">
                        <button class="btn btn-secondary dropdown-toggle"
                            style="background-color: #f5e6e0; color: #000;" type="button" data-bs-toggle="dropdown"
                            aria-expanded="true">
                            {{ session('locale', app()->getLocale()) }}
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ url('set-locale?locale=EN') }}"
                                    class="dropdown-item {{ session('locale', app()->getLocale()) == 'EN' ? 'active' : '' }}">
                                    EN
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('set-locale?locale=AR') }}"
                                    class="dropdown-item {{ session('locale', app()->getLocale()) == 'AR' ? 'active' : '' }}">
                                   AR
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <!-- drawer -->

            <div class="Drawer d-flex justify-content-center align-items-center flex-column-reverse flex-lg-row w-100">
                <form class="d-lg-flex flex-grow-1 	d-none" action="{{ route('search') }}" method="get">
                    @csrf
                    <input class="form-control me-2" id="searchInput" name="search" type="search" placeholder="Search"
                        aria-label="Search" />
                    <button class="btn btn-dark search-submit" type="submit" value="search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                </form>

                {{-- @if (auth()->user()->role_id == 2) --}}
                <a href="{{ route('productcart') }}" class="go-cart mx-0 mx-lg-3 py-4">
                    <span class="navbar-toggler-i"><i
                            class="fa-solid fa-cart-shopping me-2"></i>{{ __('customTranslate.Cart') }}</span>
                </a>
                {{-- @else --}}
                {{-- @endif --}}
                <button class="navbar-toggler show text-center fs-6" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-i ">
                        @auth
                            <div class="avatar" data-bs-toggle="offcanvas" data-bs-target="#userDataModal"
                                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                                <div class="avatar-user-name">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            </div>
                        @else
                            <i class="fa-solid fa-user me-2"></i>
                            {{ __('customTranslate.Account') }}
                        @endauth

                    </span>
                </button>
                <?php
                $lang = '';
                $align = 'end';
                if (session()->get('locale') != '') {
                    $lang = session()->get('locale');
                }
                if ($lang == 'ar') {
                    $align = 'start';
                }
                ?>
                @auth
                @else
                @endauth
                <div class="offcanvas offcanvas-<?= $align ?>" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            {{ __('customTranslate.Account') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="account-tabs">
                        <ul class="tabs d-flex gap-5 justify-content-center">
                            <li class="tab-option active" data-account="login">
                                <span class="login" href="#">{{ __('customTranslate.Login') }}</span>
                            </li>
                            <li class="tab-option" data-account="register">
                                <span class="Register" href="#">{{ __('customTranslate.Register') }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="offcanvas-body">
                        <!-- login form -->
                        <form class="form-input login user-wrapper active" method="POST" data-account="login"
                            action="{{ route('loginpost') }}">
                            @csrf
                            <div class="input-wrapper">
                                <input required type="email" placeholder="Email" name="email" value="" />
                                <label for="email">{{ __('customTranslate.Email') }}</label>
                                <span class="Email-icon form-icon">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                            </div>
                            <div class="input-wrapper mt-5">
                                <input minlength="8" maxlength="12" required type="password" placeholder="Password"
                                    id="Password" name="password" />
                                <label for="email">{{ __('customTranslate.Password') }}</label>
                                <span class="show-password form-icon">
                                    <i class="fa-solid fa-eye"></i>
                                    <i class="fa-solid fa-eye-slash"></i>
                                </span>
                            </div>
                            <div class="control-password d-flex justify-content-between align-items-center">
                                <div class="remember-account">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input bg-black" name="remember" type="checkbox"
                                            value="" id="flexCheckChecked" />
                                        <label class="form-check-label" for="flexCheckChecked">
                                            {{ __('customTranslate.Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="lost-password">{{ __('customTranslate. Lost password ?') }}</div>
                            </div>

                            <button class="mt-4" type="submit"
                                id="loginButton">{{ __('customTranslate.Login') }}</button>
                        </form>
                        <form class="form-input register user-wrapper" method="POST"
                            action="{{ route('registerpost') }}" data-account="register">
                            @csrf
                            <div class="input-wrapper">
                                <input required type="text" placeholder="name" name="name"
                                    id="Register-name" />
                                <label for="Register-name">{{ __('customTranslate. Username') }}</label>
                                <span class="Email-icon form-icon">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                            </div>
                            <div class="input-wrapper my-5">
                                <input required type="email" name="email" placeholder="Register-Email"
                                    name="Register-Email" id="Register-Email" />
                                <label for="Register-Email">{{ __('customTranslate.Email') }}</label>
                                <span class="Email-icon form-icon">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                            </div>
                            <div class="input-wrapper my-5">
                                <input required maxlength="12" minlength="8" type="password"
                                    placeholder="Register-Password" id="Register-Password" name="password" />
                                <label for="Register-Password">{{ __('customTranslate.Password') }}</label>
                                <span class="show-password form-icon">
                                    <i class="fa-solid fa-eye"></i>
                                    <i class="fa-solid fa-eye-slash"></i>

                                </span>
                            </div>
                            <div class="input-wrapper">
                                <input required maxlength="12" minlength="8" type="password"
                                    placeholder="confirm-Password" id="confirm-Password"
                                    name="password_confirmation" />
                                <label for="confirm-Password">{{ __('customTranslate. confirm password') }}</label>
                                <span class="show-password form-icon">
                                    <i class="fa-solid fa-eye"></i>
                                    <i class="fa-solid fa-eye-slash"></i>

                                </span>
                            </div>

                            <button class="mt-4" type="submit"
                                id="loginButton">{{ __('customTranslate.Register') }}</button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- drawer -->
        </div>
    </div>
    {{-- User-data --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="userDataModal" aria-labelledby="offcanvasNavbarLabel">
        <div class="container-md ">
            <div class="offcanvas-header">
                <h3 class="offcanvas-title" id="offcanvasNavbarLabel">{{ __('customTranslate. User Info ') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body  ">
                @if (Auth::check())
                    {{ __('customTranslate. Username') }}: {{ auth()->user()->name }} <br>
                    {{ __('customTranslate.Email') }} : {{ auth()->user()->email }}<br>
                @endif

                <form action="{{ route('logoutpost') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark w-100 mt-1">{{ __('customTranslate. Logout  ') }}
                    </button>
                </form>
                {{-- <a href="{{ route('logoutpost') }}"class="btn btn-dark w-100 mt-1 ">
                    logout
                </a> --}}
            </div>

        </div>

    </div>
    {{-- User-data --}}
</nav>

<script></script>
