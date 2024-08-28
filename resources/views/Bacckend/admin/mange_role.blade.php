@extends('Bacckend.master')
@section('css')

@section('content')
    <!-- row opened -->
    <div class="row row-sm card-box  p-5">
        <div class="col-xl-12 ">
            <h2 class="mb-4">Manage Role</h2>

            <form action="{{ route('updateRole') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Select User</label>
                    </div>
                    <div class="col-md-4">
                        <select name="user_id" required class="form-control" style="border: 1px solid;">
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                           
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="">Select Role</label>
                    </div>
                    <div class="col-md-4">
                        <select name="role_id" required class="form-control" style="border: 1px solid;">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                            {{-- <option value="0">User</option> --}}
                        </select>
                    </div>
                </div>
                <input type="submit" value="Update Role" class="btn btn-outline-dark">
            </form>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
