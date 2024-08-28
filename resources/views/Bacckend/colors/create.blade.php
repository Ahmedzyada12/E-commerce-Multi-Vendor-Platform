@extends('Bacckend.master')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card-box p-4 mb-4">
        <form action="{{ route('Color_store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">name</label>
                <input type="text" class="form-control name" name="name" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">color</label>
                <input type="text" class="form-control name" name="color" autocomplete="off" required>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-dark">Add</button>
            </div>
        </form>
    </div>
@endsection
