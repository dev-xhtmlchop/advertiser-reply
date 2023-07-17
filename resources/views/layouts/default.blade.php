<!DOCTYPE html>
<html>

<head>
   @include('includes.head')
</head>

<body>
@if(auth()->check())
    <div class="page-wrapper">
        <!-- MOBILE HEADER START -->
            @include('includes.mobile-header')
        <!-- MOBILE HEADER END -->

        <!-- LEFT SIDE BAR MENU START -->
            @include('includes.left-sidebar')
        <!-- LEFT SIDE BAR MENU END -->

            @include('includes.main-content')
        
        <!-- FOOTER START -->
            
        <!-- FOOTER END -->
    </div>
@else
    @yield('content')
@endif
</body>

</html>