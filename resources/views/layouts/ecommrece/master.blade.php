<!DOCTYPE html>
<?php
$lang = '';
if (session()->get('locale') != '') {
    $lang = session()->get('locale');
}
$dir = '';
if ($lang == 'AR') {
    $dir = 'rtl';
} else {
    $dir = 'ltr';
}
?>
<html lang="<?= $lang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.ecommrece.head')

</head>



<body  dir="<?= $dir ?>">

    @include('layouts.ecommrece.nav')
    @include('layouts.ecommrece.flash')
    @yield('main')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

@include('layouts.ecommrece.footer')
@include('layouts.ecommrece.footerscript')

{{-- <div  style="background-color: #5cb85c; width:fit-content; padding:0.5rem 1rem; position:fixed; bottom:5rem; right:3rem;color:white;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;font-size:1.3rem; text-transform:capitalize;"> 
    please sign-in

</div> --}}

</html>
