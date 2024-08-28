@extends('Bacckend.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">products</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    add product</span>
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

    <div class="pd-20 card-box mb-30 ">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row  box-shadow-0 p-3">
                {{-- {{ dd($errors) }} --}}
                <div class="col-12 col-lg-12">

                    <h6 class="mb-4">Enter your main Image <span style="color: red">*</span></h6>

                    <div class=" mg-t-10 mg-sm-t-0">
                        <input type="file" id="image" class="dropify form-control-file form-control height-auto "
                            name="image" data-height="200" accept="image/*" />
                    </div>
                </div>


                <div class="col-12 col-lg-12 mt-3">
                    <label for="other" class="col-form-label">More Images (multiabla)</label>
                    <div class="custom-file">
                        <input class=" p-4 custom-file-input" name="images[]" id="customFile" type="file"
                            accept="image/*" multiple>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group d-flex flex-column">
                        <label for="category" class="col-form-label w-100">Category <span
                                style="color: red">*</span></label>
                        <select class="form-control select2 w-100" id="category">
                            <option value=""></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group d-flex flex-column">
                        <label for="category" class="col-form-label w-100">SubCategory<span
                                style="color: red">*</span></label>
                        <select class="form-control select2 w-100" name="category_id" id="subCategory">
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group d-flex flex-column ">
                        <label for="name" class="col-form-label">Name <span style="color: red">*</span></label>
                        <input class="  form-control name" placeholder="iphone 8" id="name" name="name"
                            type="text"required>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="price" class="col-form-label">Price <span style="color: red">*</span></label>
                        <input class=" form-control name" placeholder="99" id="price" name="price" type="number"
                            min="1"required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="amount" class="col-form-label">Amount <span style="color: red">*</span></label>
                        <input class=" form-control name" placeholder="4" id="amount" name="amount" type="number"
                            min="1" required>
                    </div>
                </div>



                <div class="form-group">
                    <label for="size" class="col-form-label">Size</label>
                    <div class="dropdown bootstrap-select show-tick form-control"><select
                            class="selectpicker form-control" name="size[]" id="size" data-size="5"
                            data-style="btn-outline-secondary" multiple="" data-max-options="5" tabindex="-98">
                            <optgroup label="Condiments">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="size" class="col-form-label">Tags</label>
                    <div class="dropdown bootstrap-select show-tick form-control"><select
                            class="selectpicker form-control" name="tag[]" data-size="5"
                            data-style="btn-outline-secondary" multiple="" data-max-options="5" tabindex="-98">
                            <optgroup label="Condiments">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>



                <div class="form-group">
                    <label for="size" class="col-form-label">Colors</label>
                    <div class="dropdown bootstrap-select show-tick form-control"><select
                            class="selectpicker form-control" name="color[]" data-size="5"
                            data-style="btn-outline-secondary" multiple="" data-max-options="5" tabindex="-98">
                            <optgroup label="Condiments">
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">
                                        {{ $color->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="inches" class="col-form-label">Inches(cm)</label>
                        <input class=" p-4 form-control name" placeholder="15*15*15" id="inches" name="inches"
                            type="text">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="description" class="col-form-label">description</label>
                        <textarea class="form-control description" name="description" id="description"></textarea>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="form-group">
                        <div class="col-sm-6 col-md-3" style="margin: auto">
                            <button type="submit" class="btn btn-outline-dark btn-block">Save</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>


        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script>
        $('#category').on('change', function() {
            id = $(this).val();
            $.ajax({
                url: "{{ route('getSubCategory') }}",
                type: "GET",
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#subCategory').empty();
                    $.each(response, function(key, item) {
                        $('#subCategory').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error: ", error);
                }
            });
        })
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#category').on('change', function() {
                var selectedCategoryId = $(this).val();
                $('#subCategory option').each(function() {
                    var $option = $(this);
                    if ($option.data('category-id') == selectedCategoryId || $option.val() == '') {
                        $option.show();
                    } else {
                        $option.hide();
                    }
                });
            });

            // Initially hide all subcategory options
            $('#subCategory option').not(':first').hide();
        });
    </script> --}}



    {{-- <script>
        $('#category').on('change', function() {
            id = $(this).val();
            $.ajax({
                url: "{{ route('getSubCategory') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#subCategory').empty();
                    $.each(response, function(key, item) {
                        $('#subCategory').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error: ", error);
                }
            });
        })
    </script> --}}

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
