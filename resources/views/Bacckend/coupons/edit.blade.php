@extends('Bacckend.master')

@section('content')
    <div class="container">
        <h1>Edit Coupon</h1>
        <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $coupon->code }}" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                    <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percent</option>
                </select>
            </div>
            <div class="form-group">
                <label for="value">Value</label>
                <input type="number" name="value" id="value" class="form-control" step="0.01" value="{{ $coupon->value }}" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" class="form-control" value="{{ $coupon->expiry_date }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
