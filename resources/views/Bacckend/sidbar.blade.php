<div class="right-sidebar">
    <div class="sidebar-title">
        <h3 class="weight-600 font-16 text-blue">
            Layout Settings
            <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
        </h3>
        <div class="close-sidebar" data-toggle="right-sidebar-close">
            <i class="icon-copy ion-close-round"></i>
        </div>
    </div>
    <div class="right-sidebar-body customscroll">
        <div class="right-sidebar-body-content">
            <h4 class="weight-600 font-18 pb-10">Header Background</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
            </div>

            <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
            </div>

            <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
            <div class="sidebar-radio-group pb-10 mb-10">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input"
                        value="icon-style-1" checked="" />
                    <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input"
                        value="icon-style-2" />
                    <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input"
                        value="icon-style-3" />
                    <label class="custom-control-label" for="sidebaricon-3"><i
                            class="fa fa-angle-double-right"></i></label>
                </div>
            </div>

            <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
            <div class="sidebar-radio-group pb-30 mb-10">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-1" checked="" />
                    <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-2" />
                    <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o"
                            aria-hidden="true"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-3" />
                    <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-4" checked="" />
                    <label class="custom-control-label" for="sidebariconlist-4"><i
                            class="icon-copy dw dw-next-2"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-5" />
                    <label class="custom-control-label" for="sidebariconlist-5"><i
                            class="dw dw-fast-forward-1"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-6" />
                    <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
                </div>
            </div>

            <div class="reset-options pt-30 text-center">
                <button class="btn btn-danger" id="reset-settings">
                    Reset Settings
                </button>
            </div>
        </div>
    </div>
</div>

<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="{{ asset('backend/images/1678618873.png') }}" alt="" class="dark-logo ml-4 w-25" />
            {{-- <img src="{{ asset('backend/images/1678618873.png') }}" alt=""  class="dark-logo ml-4 w-25" /> --}}
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">


                <!-- Ensure user is authenticated -->
                @if (Auth::check())
                    @if (Auth::user()->hasRole(3))
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-house"></span><span class="mtext">Home</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('dashboard_vendor') }}">Home</a></li>
                            </ul>
                        </li>

                        {{-- <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-textarea-resize"></span><span class="mtext">Forms</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="form-basic.html">Form Basic</a></li>
                                <li><a href="advanced-components.html">Advanced Components</a></li>
                                <li><a href="form-wizard.html">Form Wizard</a></li>
                                <li><a href="html5-editor.html">HTML5 Editor</a></li>
                                <li><a href="form-pickers.html">Form Pickers</a></li>
                                <li><a href="image-cropper.html">Image Cropper</a></li>
                                <li><a href="image-dropzone.html">Image Dropzone</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span class="mtext">Tables</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="basic-table.html">Basic Tables</a></li>
                                <li><a href="datatable.html">DataTables</a></li>
                            </ul>
                        </li> --}}
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span
                                    class="mtext">{{ __('customTranslate.Category') }}</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('categories.index') }}">{{ __('customTranslate.Category') }}</a>
                                </li>
                                <li><a href="{{ route('categories.create') }}">
                                        {{ __('customTranslate.Add category') }}</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span
                                    class="mtext">{{ __('customTranslate.Tags') }}</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('tags') }}"> {{ __('customTranslate.Tags list') }}</a></li>
                                <li><a href="{{ route('tag_create') }}"> {{ __('customTranslate.Add Tag') }}</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span
                                    class="mtext">{{ __('customTranslate.Size') }}</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('sizes') }}"> {{ __('customTranslate.Size list') }}</a></li>
                                <li><a href="{{ route('size_create') }}"> {{ __('customTranslate.Add Size') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span
                                    class="mtext">{{ __('customTranslate.Colors') }}</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('Colors') }}"> {{ __('customTranslate.Colors list') }}</a></li>
                                <li><a href="{{ route('Color_create') }}"> {{ __('customTranslate.Add Color') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span
                                    class="mtext">{{ __('customTranslate.Products') }}</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('VendorAllProduct') }}">
                                        {{ __('customTranslate.Products list') }}</a></li>
                                <li><a href="{{ route('VendorAddProduct') }}">
                                        {{ __('customTranslate.Add Products') }}</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span
                                    class="mtext">{{ __('customTranslate.Orders') }}</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('indexorder') }}"> {{ __('customTranslate.Orders list') }}</a>
                                </li>
                                {{-- <li><a href="{{ route('viewOrder') }}">Add Products</a></li> --}}
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span
                                    class="mtext">{{ __('customTranslate.Coupons') }}</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('coupons.index') }}">
                                        {{ __('customTranslate.Colors list') }}</a>
                                </li>
                                <li><a href="{{ route('coupons.create') }}">
                                        {{ __('customTranslate.add Coupon') }}</a>
                                </li>
                                {{-- <li><a href="{{ route('viewOrder') }}">Add Products</a></li> --}}
                            </ul>
                        </li>
                        {{-- <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span class="mtext">Role</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('manageRole') }}"> manageRole</a></li>
                                <li><a href="{{ route('manageAdmin') }}"> manageAdmin</a></li>
                                <li><a href="{{ route('manageVendor') }}"> manageVendor</a></li>
                                <li><a href="{{ route('manageUser') }}"> manageUser</a></li>
                                <li><a href="{{ route('manger') }}"> manger register</a></li>
                                <li><a href="{{ route('vendor') }}"> vendor register</a></li>
                            </ul>
                        </li> --}}
                    @endif
                @endif
                @if (Auth::check())
                    @if (Auth::user()->hasRole(1))
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-house"></span><span
                                    class="mtext">{{ __('customTranslate.home') }}</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('dashboard_admin') }}">{{ __('customTranslate.home') }}</a>
                                </li>
                            </ul>
                        </li>


                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span
                                    class="mtext">{{ __('customTranslate.Reviews') }}</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('index.reviews') }}">
                                        {{ __('customTranslate.Reviews list') }}</a></li>
                                {{-- <li><a href="{{ route('VendorAddProduct') }}"></a></li> --}}
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span
                                    class="mtext">{{ __('customTranslate.Orders') }}</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('indexorders') }}"> {{ __('customTranslate.Orders list') }}</a>
                                </li>
                                {{-- <li><a href="{{ route('viewOrder') }}">Add Products</a></li> --}}
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span class="mtext">vendorsWithBalances</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('vendorsWithBalances') }}">vendorsWithBalances </a>
                                </li>
                                {{-- <li><a href="{{ route('viewOrder') }}">Add Products</a></li> --}}
                            </ul>
                        </li>
                        {{-- <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span class="mtext">Tables</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="basic-table.html">Basic Tables</a></li>
                                <li><a href="datatable.html">DataTables</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span class="mtext">Category</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('categories.index') }}">category list</a></li>
                                <li><a href="{{ route('categories.create') }}">Add category</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span class="mtext">Tags</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('tags') }}">Tags list</a></li>
                                <li><a href="{{ route('tag_create') }}">Add Tag</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span class="mtext">Size</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('sizes') }}">Size list</a></li>
                                <li><a href="{{ route('size_create') }}">Add Size</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span class="mtext">Colors</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('Colors') }}">Colors list</a></li>
                                <li><a href="{{ route('Color_create') }}">Add Color</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span class="mtext">Products</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('getproducts') }}">Products list</a></li>
                                <li><a href="{{ route('products.create') }}">Add Products</a></li>
                            </ul>
                        </li> --}}
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-table"></span><span
                                    class="mtext">{{ __('customTranslate.Role ') }}</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('manageRole') }}"> {{ __('customTranslate.Role manage') }}</a>
                                </li>
                                <li><a href="{{ route('manageAdmin') }}">
                                        {{ __('customTranslate.Role manageAdmin') }}</a></li>
                                <li><a href="{{ route('manageVendor') }}">
                                        {{ __('customTranslate.Role manageVendor') }}</a></li>
                                <li><a href="{{ route('manageUser') }}">
                                        {{ __('customTranslate.Role manageUser') }}</a></li>
                                <li><a href="{{ route('manger') }}">{{ __('customTranslate.Manager register') }}</a>
                                </li>
                                <li><a href="{{ route('vendor') }}"> {{ __('customTranslate.Vendor register') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif

                {{-- <li>
                    <a href="invoice.html" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Invoice</span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>

</div>
