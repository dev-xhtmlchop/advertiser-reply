 <script type="text/javascript" src="{{ asset('public/assets/js/common/jquery/jquery-3.7.0.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/bootstrap/popper.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/bootstrap/bootstrap.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/animsition/animsition.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/bootstrap/bootstrap.bundle.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/select2/select2.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/jquery/jquery.validate.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/jquery/additional-methods.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/daterangepicker/moment.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/daterangepicker/daterangepicker.js') }}" ></script>
<?php /* <script src="{{ asset('public/assets/js/common/datatable/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('public/assets/js/common/datatable/dataTables.bootstrap5.min.js') }}" defer></script> */ ?>
<script type="text/javascript" src="{{ asset('public/assets/js/common/datatable/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/datatable/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common/datatable/responsive.bootstrap5.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="{{ asset('public/assets/js/common/common.js') }}" ></script>
<script src="{{ asset('public/assets/js/common/main.js') }}" ></script>

@if( request()->is('login') ) 
<script src="{{ asset('public/assets/js/custom/login.js') }}" ></script>
@endif
@if( request()->is('/') ) 
<script src="{{ asset('public/assets/js/custom/dashboard.js') }}" ></script>
<script src="{{ asset('public/assets/js/custom/forgotpassword.js') }}" ></script>  
@endif

@if( request()->is('deal') ) 
<script src="{{ asset('public/assets/js/custom/deal.js') }}" ></script>  
@endif
@if( request()->is('campaign/*') || request()->is('campaign') ) 
<script src="{{ asset('public/assets/js/custom/campaign.js') }}" ></script>  
@endif

