@extends('Bacckend.master')

<!-- breadcrumb -->

<!-- breadcrumb -->

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

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
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
            <div class="card-box mg-b-20">
                <div class="card-body">
                    <div class="breadcrumb-header justify-content-between">

                        <div class="my-auto mb-5">
                            <div class="d-flex mb-5">
                                <h4 class="content-title mb-5 my-auto">Colors</h4>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Color</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($colors as $color)
                                    <tr>
                                        <td>{{ $color->id }}</td>
                                        <td>
                                            {{ $color->name }} </td>
                                        <td>
                                            {{ $color->color }} </td>
                                        <td>
                                            <div class="d-flex flex-wrap" style="gap: 3px">
                                                <a href="">
                                                    <form action="{{ route('Color_destroy', $color->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class=" btn btn-sm btn-info">Delete</button>
                                                    </form>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- edit -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit category </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('categories.update', 'update') }}" method="post" autocomplete="off">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input class="form-control id" type="hidden" name="id" value="">
                            <label for="recipient-name" class="col-form-label"> name</label>
                            <input class="form-control name" name="name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">description</label>
                            <textarea class="form-control description" name="description"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancle</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Delete category </h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('categories.destroy', 'delete') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>are you sure ?</p><br>
                        <input class="form-control id" type="hidden" name="id" value="">
                        <input class="form-control name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancle</button>
                        <button type="submit" class="btn btn-danger">delete</button>
                    </div>
                </form>
            </div>

        </div>
    </div>




    <!-- row closed -->
    </div>

    <!-- Container closed -->
    </div>

    <!-- main-content closed -->

@endsection
