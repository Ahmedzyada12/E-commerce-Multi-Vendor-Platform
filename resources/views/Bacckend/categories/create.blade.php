@extends('Bacckend.master')
@section('content')

@if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <div class="card-box p-4 mb-4">
        <form action="{{ route('categories.store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name_en">Category Name (English)</label>
                <input class="form-control description" type="text" id="name_en" name="name_en" required>
            </div>
            <div class="form-group">
                <label for="name_ar">Category Name (Arabic)</label>
                <input class="form-control description" type="text" id="name_ar" name="name_ar" required>
            </div>

            <div class="form-group">
                <label for="description_en">Category Description (English)</label>
                <textarea class="form-control description" id="description_en" name="description_en"></textarea>
            </div>
            <div class="form-group">
                <label for="description_ar">Category Description (Arabic)</label>
                <textarea class="form-control description"  id="description_ar" name="description_ar"></textarea>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-dark">Add</button>
            </div>
        </form>
    </div>
@endsection
