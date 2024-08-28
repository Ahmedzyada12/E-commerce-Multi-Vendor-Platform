@extends('Bacckend.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">category</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    products</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
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
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-outline-primary btn-block" href="{{ route('products.create') }}">Add Product</a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Image</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Price</th>
                                    <th class="border-bottom-0">Amount</th>
                                    <th class="border-bottom-0">Colors</th>
                                    <th class="border-bottom-0">Sizes</th>
                                    <th class="border-bottom-0">Inches (cm)</th>
                                    <th class="border-bottom-0">Tags</th>
                                    <th class="border-bottom-0">Control</th>
                                    <th class="border-bottom-0">Descripion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <img style="border-radius: 50%;width: 40px; height:40px"
                                                src="{{ asset($product->image) }}" alt="">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->amount }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap">
                                                @foreach ($product->colors as $color)
                                                    <span
                                                        style="display:inline-block; width: 20px;height: 20px; border: 1px solid #000; border-radius: 50%;margin-right: -4px ; background-color:{{ $color->color }}"></span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap" style="gap: 2px">
                                                @foreach ($product->sizes as $size)
                                                    <span class="py-1 px-2"
                                                        style="display:inline-block; width: fit-content; background-color:#cdcdcd; border-radius: 10px">{{ $size->size }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>{{ $product->inches }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap" style="gap: 2px">
                                                @foreach ($product->tag as $tag)
                                                    <span class="py-1 px-2 text-light"
                                                        style="display:inline-block; width: fit-content; background-color:#00b9ff; border-radius: 10px">{{ $tag->name }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <a class=" btn btn-sm btn-info"
                                                href="{{ route('VendorediteProduct', $product->id) }}" title="تعديل"><i
                                                    class="las la-pen"></i>
                                            </a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                data-toggle="modal" href="#modaldemo9" title="حذف"><i
                                                    class="las la-trash"></i></a>
                                        </td>
                                        <td>{{ $product->description }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Add category</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('categories.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="exampleInputEmail1">name </label>
                                <input type="text" class="form-control name" name="name">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">description</label>
                                <textarea class="form-control description" name="description" rows="3"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">add</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Basic modal -->


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
                </div>
                </form>
            </div>
        </div>




        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body .id').val(id);
            modal.find('.modal-body .name').val(name);
            modal.find('.modal-body .description').val(description);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body .id').val(id);
            modal.find('.modal-body .name').val(name);
        })
    </script>
@endsection
