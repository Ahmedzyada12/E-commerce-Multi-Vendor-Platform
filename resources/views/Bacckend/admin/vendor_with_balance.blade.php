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


        <div class="col-xl-12">
            <div class="card-box  mg-b-20">

                <div class="card-body">
                    <div class="breadcrumb-header justify-content-between">
                        <div class="my-auto">
                            <div class="d-flex">
                                <h4 class="content-title mb-0 my-auto">Data of balance</h4><span
                                    class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-md-nowrap">
                            <thead>
                                <th>Vendor Name</th>
                                <th>Balance</th>
                                <th>Discount (30%)</th>
                            </thead>
                            <tbody>
                                @foreach ($vendorsWithBalances as $vendor)
                                    <tr>
                                        <td>{{ $vendor->name }}</td>
                                        <td>${{ $vendor->balance }}</td>
                                        <td>${{ $vendor->discount }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
