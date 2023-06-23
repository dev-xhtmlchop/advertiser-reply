@extends('layouts.default')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p10">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 card-main">
                        <div class="filter-box card">
                            <form method="post" id="dashboard_deal">
                                <div class="row">
                                    <div class="col-12 head d-flex justify-content-between align-items-center mb-4">
                                        <h2 class="mb-0">Filter</h2>
                                        <div class="d-flex align-items-center">
                                            <div class="daterange d-flex align-items-center">
                                                <div class="daterange-input">
                                                    <input type="text" name="daterange" id="daterange" value="" placeholder="mm/dd/yyyy - mm/dd/yyyy" />
                                                    <input type="hidden" name="start_daterange" id="start_daterange" value="" />
                                                    <input type="hidden" name="end_daterange" id="end_daterange" value="" />
                                                    <button class="btn btn-secondary" >Reset</button>
                                                </div>
                                            </div>
                                            <button class="btn btn-secondary">Reset</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        @if( $dashboard['advertiserList'] )
                                            <select name="deal_no" id="deal_no"  class="au-input au-input--full">
                                                <option value="">Deal</option>
                                                @foreach( $dashboard['advertiserList'] as $advertiserKey =>$advertiserValue )
                                                    <option value="{{ $advertiserValue['deal_id'] }}">{{ $advertiserValue['name'] }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        @if( $dashboard['campaignList'] )
                                            <select name="campaign" id="campaign"  class="au-input au-input--full">>
                                                <option value="">Campaign</option>
                                                @foreach( $dashboard['campaignList'] as $campaignKey =>$campaignValue )
                                                    <option value="{{ $campaignValue['id'] }}">{{ $campaignValue['title'] }}({{ $campaignValue['id'] }})</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        @if( $dashboard['demographicsList'] )
                                            <select name="demographics" id="demographics"  class="au-input au-input--full">>
                                                <option value="">Demographics</option>
                                                @foreach( $dashboard['demographicsList'] as $demographicsKey =>$demographicsValue )
                                                    <option value="{{ $demographicsValue['id'] }}">{{ $demographicsValue['name'] }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        @if( $dashboard['outletList'] )
                                            <select name="outlet" id="outlet"  class="au-input au-input--full">>
                                                <option value="">Out Let</option>
                                                @foreach( $dashboard['outletList'] as $outletKey =>$outletValue )
                                                    <option value="{{ $outletValue['id'] }}">{{ $outletValue['outlet_type'] }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        @if( $dashboard['agencyList'] )
                                            <select name="agency" id="agency"  class="au-input au-input--full">>
                                                <option value="">Agency</option>
                                                @foreach( $dashboard['agencyList'] as $agencyKey =>$agencyValue )
                                                    <option value="{{ $agencyValue['id'] }}">{{ $agencyValue['name'] }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        @if( $dashboard['locationList'] )
                                            <select name="location" id="location"  class="au-input au-input--full">>
                                                <option value="">Location</option>
                                                @foreach( $dashboard['locationList'] as $locationKey =>$locationValue )
                                                    <option value="{{ $locationValue['id'] }}">{{ $locationValue['name'] }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        @if( $dashboard['brandList'] )
                                            <select name="brand" id="brand"  class="au-input au-input--full">>
                                                <option value="">Brand</option>
                                                @foreach( $dashboard['brandList'] as $brandKey =>$brandValue )
                                                    <option value="{{ $brandValue['id'] }}">{{ $brandValue['product_name'] }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 card-main">
                        <div class="deal-view-box card">
                            <div
                            class="col-12 head d-flex justify-content-between align-items-center mb-4">
                            <h2 class="mb-0">Deal View</h2>
                            </div>
                            
                            <div class="row deal-view">
                                @if( count( $dealView ) > 0 )
                                    @foreach( $dealView as $dealViewKey => $dealViewVal )
                                        @php
                                            $imageUrl = "public/images/dashboard/".$dealViewVal['image'];
                                        @endphp
                                        <div class="col-md-6 form-group">
                                            <div class="deal-component {{ $dealViewVal['background'] }}">
                                                <h3>{{ $dealViewVal['name'] }}</h3>
                                                <h5 id="deal_{{ $dealViewVal['slug'] }}">{{ $dealViewVal['value'] }}</h5>
                                                <div class="icon-box">
                                                <img src="{{ asset($imageUrl) }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 card-main">
                        <div class="advertiser-dashboard-box card">
                            <div class="advertiser-view">
                                <div class="row">
                                    <div class="col-12 head d-flex justify-content-between align-items-center mb-4">
                                        <h2 class="mb-0">Advertiser Dashboard</h2>
                                        <div class="daterange advertiser-filter">
                                            <input type="text" name="advertiser_daterange"
                                                id="advertiser_daterange" value=""
                                                placeholder="mm/dd/yyyy - mm/dd/yyyy" />
                                            <input type="hidden" name="advertiser_start_daterange"
                                                id="advertiser_start_daterange" value="" />
                                            <input type="hidden" name="advertiser_end_daterange"
                                                id="advertiser_end_daterange" value="" />
                                        </div>
                                    </div>
                                    @if( count( $dealStatus ) > 0 )
                                        @foreach( $dealStatus as $dealStatusKey => $dealStatusVal )
                                            <div class="col-md-6 col-lg-4 col-xl-4 form-group">
                                                <div class="advertiser-component d-flex align-items-center">
                                                    <span class="info-icon {{ $dealStatusVal['background'] }}"><i class="{{ $dealStatusVal['icon'] }}"></i></span>
                                                    <h4 id="advertiser_{{ $dealStatusVal['slug'] }}" >0 {{ $dealStatusVal['name'] }}</h4>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="changepasswrod" class="modal fade popup-form" tabindex="-1" style="display:none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-notification text-center mb-3" role="alert"></div>
                    <form id="forgot_password" novalidate="novalidate">   
                        @csrf

                        <div class="form-group row">
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" >
                            <input type="hidden" id="user_id" class="form-control" name="user_id" value="{{ Session::get('user_id') }}">
                        </div>
                        <div class="form-group">
                            <label for="current password" class="col-form-label">Current Password</label>
                                <input type="password" id="current_password" class="form-control" name="current_password" value="">
                        </div>
                        <div class="form-group">
                            <label for="new password" class="col-form-label">New Password</label>
                                <input type="password" id="new_password" class="form-control" name="new_password" value="">
                        </div>
                        <div class="form-group">
                            <label for="confirm password" class="col-form-label">Confirm Password</label>
                                <input type="password" id="confirm_password" class="form-control" name="confirm_password">
                        </div>

                        <div class="text-center">
                            <input type="submit" class="au-btn au-btn--block au-btn--green" value="Change Password">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop