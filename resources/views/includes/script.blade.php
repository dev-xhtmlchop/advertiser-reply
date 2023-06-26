<script src="{{ asset('public/assets/js/common/jquery/jquery-3.7.0.min.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/bootstrap-5.1/popper.min.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/bootstrap-5.1/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/bootstrap-5.1/bootstrap.bundle.min.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/select2/select2.min.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/jquery/jquery.validate.min.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/jquery/additional-methods.min.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/daterangepicker/moment.min.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/daterangepicker/daterangepicker.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/datatable/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/datatable/dataTables.bootstrap5.min.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/common.js') }}" defer></script>
@if( request()->is('login') ) 
<script src="{{ asset('public/assets/js/custom/login.js') }}" defer></script>
@endif
@if( request()->is('/') ) 
<script src="{{ asset('public/assets/js/custom/dashboard.js') }}" defer></script>
<script src="{{ asset('public/assets/js/custom/forgotpassword.js') }}" defer></script>  
@endif

@if( request()->is('deal') ) 
<script src="{{ asset('public/assets/js/custom/deal.js') }}" defer></script>  
@endif
@if( request()->is('campaign/*') || request()->is('campaign') ) 
<script src="{{ asset('public/assets/js/custom/campaign.js') }}" defer></script>  
@endif