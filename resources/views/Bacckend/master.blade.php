<!DOCTYPE html>
<html>

@include('Bacckend.head')

@include('sweetalert::alert')


<body>
    {{-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="backend/vendors/images/deskapp-logo.svg" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">50%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div> --}}

    <div class="header">

        @include('Bacckend.nav')

    </div>

    @include('Bacckend.sidbar')

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">

        @yield('content')

    </div>
    @include('Bacckend.footer')

    @include('Bacckend.footerScript')
    @include('layouts.models')
    @include('layouts.footer-scripts')
    {{-- @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9']) --}}


</body>

</html>
