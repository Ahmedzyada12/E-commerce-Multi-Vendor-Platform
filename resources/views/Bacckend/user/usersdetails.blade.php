@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> Users details</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="row">

                        @forelse ($data->orders as $order)
                            <div class="col-md-4 mt-3">
                                <label for="">Name</label>
                                <div class="p-2 border">
                                    {{ $order->first_name . ' ' . $order->last_name }}
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Email</label>
                                <div class="p-2 border">
                                    {{ $order->email }}
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Contact No</label>
                                <div class="p-2 border">
                                    {{ $order->phone }}
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Address 1</label>
                                <div class="p-2 border">
                                    {{ $order->street_address }}
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">City</label>
                                <div class="p-2 border">
                                    {{ $order->city }}
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">Country</label>
                                <div class="p-2 border">
                                    {{ $order->country }}
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Zip Code</label>
                                <div class="p-2 border">
                                    {{ $order->postal_code }}
                                </div>
                            </div>
                        @empty
                            <div class="text-center">There are no orders for this user.</div>
                        @endforelse
                        <div class="col-md-4 mt-3">
                            <label for="">Order count</label>
                            <div class="p-2 border">
                                {{ $data->orders->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
