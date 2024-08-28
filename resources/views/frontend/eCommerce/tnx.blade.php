@extends('layouts.ecommrece.master')
@section('title', 'eCommerce | Thank You')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
@section('main')
    <div class="text-center d-flex justify-content-center align-items-center flex-column" style="height: 80vh;">
        <header class="site-header" id="header">
            <h1 class="site-header__title" data-lead-id="site-header-title" style="font-size: 5rem;">Thank You for Your Order</h1>
        </header>

        <div class="main-content">
            <i class="fa fa-check main-content__checkmark fa-10x text-success" id="checkmark"></i>
            <p class="main-content__body" data-lead-id="main-content-body" style="font-size: 1.5rem;">Your order has been received and is now being processed. <br> You will receive an email confirmation shortly
            </p>
        </div>
        <a href="{{ route('homePage') }}" class="clear-filter-btn px-4 py-2 rounded-pill mt-3">Back To home</a>
    </div>
@endsection
