@extends('Bacckend.master')
@section('content')
    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card p-4 mb-4">
        <form action="{{ route('categories.update', $category->id) }}" method="post" autocomplete="off">
            {{ method_field('patch') }}
            {{ csrf_field() }}
            <div class="form-group">
                <input class="form-control id" type="hidden" name="id" value="">
                <label for="recipient-name" class="col-form-label"> name</label>
                <input class="form-control name" name="name" type="text" value="{{ $category->name }}">
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">description</label>
                <textarea class="form-control description" name="description"></textarea>
            </div>
    </div>
@endsection
