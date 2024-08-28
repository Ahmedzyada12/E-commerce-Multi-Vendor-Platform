@extends('Bacckend.master')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-dark h4">Vendor Register</h4>
            </div>
        </div>
        <form method="POST" action="{{ route('vendor_register') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" type="text" placeholder=" Full Name" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" placeholder=" kua@gmail.com"type="email" />
            </div>


            <div class="form-group">
                <label>Password</label>
                <input class="form-control" value="password" name="password" type="password" />
            </div>

            <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" class="form-control" name="image" required>
            </div>

            <button class="btn btn-outline-dark btn-block" type="submit">Create
                Account</button>
        </form>
    </div>
@endsection
@section('js')
@endsection
