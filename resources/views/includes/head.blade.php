<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
   
    <meta name="description" content="@yield('meta_description', 'Laravel Starter')">
    <meta name="author" content="@yield('meta_author', 'FasTrax Infotech')">
    <meta name="web-url" content="{{ url('') }}" />
    <meta name="storage-path" content="{{ storage_path() }}" />

    @yield('meta')
    
    <link rel="shortcut icon" href="{{ asset('public/favicon.ico') }}">
    <!-- Fontfaces CSS-->
    <link href="{{ asset('public/assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/assets/css/common/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/assets/css/common/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/assets/css/common/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    
    <!-- Bootstrap 5 css -->
    <link href="{{ asset('public/assets/css/common/bootstrap-5.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/assets/css/common/bootstrap-5.1/bootstrap.bundle.min.css') }}" rel="stylesheet" media="all">   
    <link href="{{ asset('public/assets/css/common/bootstrap-5.1/twitter-bootstrap.min.css') }}" rel="stylesheet" media="all"/>
   
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/common/datatable/dataTables.bootstrap5.min.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/common/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/common/bootstrap-5.1/bootstrap-datepicker.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/common/select2/select2.min.css') }}" media="all">
    
    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/theme.css') }}" media="all">
    
    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/custom.css') }}" media="all">