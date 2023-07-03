<header class="header-desktop white-bg">
    <div class="section__content section__content--p10">
        <div class="container-fluid">
            <div class="header-wrap d-flex justify-content-between">
                <a class="bars-icon" href="#" role="button"><i class="fas fa-bars"></i></a>
                <div class="account-info-main d-flex align-items-center">
        
                    <div class="account-info account-wrap">
                    <div class="account-item clearfix js-item-menu">
                        <div class="image">
                            <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            @if(Session::has('advertiser_name'))
                                <a class="js-acc-btn" href="/">{{ Session::get('advertiser_name')}}</a>
                            @endif
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                        <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        @if(Session::has('advertiser_name'))
                                            <a href="/">{{ Session::get('advertiser_name')}}</a>
                                        @endif
                                    </h5>
                                    @if(Session::has('advertiser_email_address'))
                                        <span class="email">{{ Session::get('advertiser_email_address')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <p><strong>Advertiser ID: </strong>@if(Session::has('advertiser_id')){{ Session::get('advertiser_id')}}@endif</p>
                                </div>
                                <div class="account-dropdown__item">
                                    <p><strong>Login Time: </strong>@if(Session::has('advertiser_logintime')){{ Session::get('advertiser_logintime')}}@endif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="account-log">
                        <a href="{{ route('logout') }}"><i class="zmdi zmdi-power"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-notification-success text-center mb-3 alert-success" role="alert">
        <button type="button" class="close" aria-label="Close">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <p><i class="fa fa-check"></i><span class="success-message">Success</span></p>
    </div>
    <div class="alert alert-notification-error text-center mb-3 alert-danger" role="alert">
        <button type="button" class="close" aria-label="Close">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <p><i class="fa fa-warning"></i><span class="error-message">Error</span></p>
    </div>
</header>