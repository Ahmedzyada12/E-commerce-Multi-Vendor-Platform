@extends('Bacckend.master')

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-box p-5 mt-5  mg-b-20">
            <div class="card-body">
         <div class="table-responsive">
        <table class="table mt-3 table key-buttons text-md-nowrap" data-page-length='50' style="text-align: center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Expiry Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->type }}</td>
                        <td>{{ $coupon->value }}</td>
                        <td>{{ $coupon->expiry_date }}</td>
                        <td>
                            <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
@endsection
