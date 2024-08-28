@extends('Bacckend.master')

@section('content')
    <div class="container">
        <h1>Create Coupon</h1>
        <form action="{{ route('coupons.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" name="code" id="code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="fixed">Fixed</option>
                    <option value="percent">Percent</option>
                </select>
            </div>
            <div class="form-group">
                <label for="value">Value</label>
                <input type="number" name="value" id="value" class="form-control" step="0.01" required>
            </div>
            {{-- <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" class="form-control">
            </div>
            <button type="submit" class="btn btn-outline-dark">Create</button>
        </form>
    </div>
@endsection
