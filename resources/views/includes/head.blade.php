<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
   
    <meta name="description" content="@yield('meta_description', 'Laravel Starter')">
    <meta name="author" content="@yield('meta_author', 'FasTrax Infotech')">
    <meta name="web-url" content="{{ url('') }}";
    @yield('meta')
    
    <!-- Fontfaces CSS-->
    <link href="{{ asset('public/assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/assets/css/common/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/assets/css/common/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    
    <!-- Bootstrap 5 css -->
    <link href="{{ asset('public/assets/css/common/bootstrap-5.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/assets/css/common/bootstrap-5.1/bootstrap.bundle.min.css') }}" rel="stylesheet" media="all">

    <!-- Select2 -->
    <link href="{{ asset('public/assets/css/common/select2/select2.min.css') }}" rel="stylesheet" media="all">
    
    <!-- Theme css -->
    <link href="{{ asset('public/assets/css/theme.css') }}" rel="stylesheet" media="all">
    
    <!-- Custom css -->
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" media="all">
