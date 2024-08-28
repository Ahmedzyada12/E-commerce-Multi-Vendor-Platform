@extends('Bacckend.master')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-5">

            <div class="card-box mg-b-20 p-3 ">

                <div class="single-icon notifications-parent  d-flex justify-content-end">
                    <a class="btn btn-outline-dark site-health-btn btn-icon-text" href="{{ route('homePageVendor') }}">
                        <i class="las la-eye"></i> <span class="d-none d-sm-inline-block">Visit Store</span>
                    </a>
                </div>

                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">Products</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Image</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Price</th>
                                    <th class="border-bottom-0">Amount</th>
                                    <th class="border-bottom-0">Colors</th>
                                    <th class="border-bottom-0">Sizes</th>
                                    <th class="border-bottom-0">Inches (cm)</th>
                                    <th class="border-bottom-0">Tags</th>
                                    <th class="border-bottom-0">Control</th>
                                    <th class="border-bottom-0">Descripion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <img style="border-radius: 50%;width: 40px; height:40px"
                                                src="{{ asset('images/' . $product->image) }}" alt="">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->amount }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap">
                                                @foreach ($product->colors as $color)
                                                    <span
                                                        style="display:inline-block; width: 20px;height: 20px; border: 1px solid #000; border-radius: 50%;margin-right: -4px ; background-color: {{ $color->color }}"></span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap" style="gap: 2px">
                                                @foreach ($product->sizes as $size)
                                                    <span class="py-1 px-2"
                                                        style="display:inline-block; width: fit-content; background-color:#cdcdcd; border-radius: 10px">{{ $size->size }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>{{ $product->inches }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap" style="gap: 2px">
                                                @foreach ($product->tag as $tag)
                                                    <span class="py-1 px-2 text-light"
                                                        style="display:inline-block; width: fit-content; background-color:#00b9ff; border-radius: 10px">{{ $tag->name }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap" style="gap: 2px">
                                                <a class=" btn btn-sm btn-info"
                                                    href="{{ route('VendorediteProduct', $product->id) }}"><i
                                                        class="las la-pen">Edit</i>
                                                </a>

                                                <a href="">
                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class=" btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            {{ Str::limit($product->description, 40) }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- row closed -->
    </div>

    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

@endsection
