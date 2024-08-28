@extends('layouts.ecommrece.master')
@section('title', 'eCommerce | Search Page')

@section('main')

    @php
        $title = 'Search Result';
    @endphp
    <main>

        <div class="container-md mt-5">
            <div class="pagr-title p-5 bg-light">
                <h6 class="d-inline-block">{{ $title }}</h6>
            </div>
            <div class="get-filter-modal d-flex justify-content-between px-4 pt-4">
                <a href="{{ route('shop') }}" class="clear-filter-btn px-4 py-2 rounded-pill">Clear Search</a>
            </div>

            <div class="product row mb-5">
                @if ($products->isEmpty())
                    <div class="col-12 my-4">
                        <p class="text-center">No products found for your search.</p>
                    </div>
                @else
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3 mt-5">
                            <div class="pro-card">
                                <div class="pro-img w-100">
                                    <a href="{{ route('details', $product->id) }}">
                                        <img src="{{ asset('images/' . $product->image) }}" alt="" />
                                    </a>
                                </div>
                                <div class="pro-name p-3 bg-light">
                                    <h6 class="text-center">{{ $product->name }}</h6>
                                    <p class="details">{{ Str::limit($product->description, 20) }}.</p>
                                    <p class="price fw-bold">${{ $product->price }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="p-5 mb-5 mt-5 d-flex justify-content-between align-items-center">
                {{ $products->links() }}

            </div>
        </div>
    </main>

@endsection
