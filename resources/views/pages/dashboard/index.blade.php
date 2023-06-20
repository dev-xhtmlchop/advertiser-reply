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
                                        <div class="daterange">
                                            <label>Flight Date Range</label>
                                            <div class="daterange-input">
                                                <input type="text" name="daterange" id="daterange" value="" placeholder="mm/dd/yyyy - mm/dd/yyyy" />
                                                <input type="hidden" name="start_daterange" id="start_daterange" value="" />
                                                <input type="hidden" name="end_daterange" id="end_daterange" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        @if( $dashboard['advertiserList'] )
                                            <select name="deal_no" id="deal_no"  class="au-input au-input--full">>
                                                <option value="">Deal No</option>
                                                @foreach( $dashboard['advertiserList'] as $advertiserKey =>$advertiserValue )
                                                    <option value="{{ $advertiserValue['id'] }}">{{ $advertiserValue['title'] }}</option>
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
                        <?php /*
                        <div class="deal-view-box card">
                            <h2>Deal View</h2>
                            <div class="row deal-view">
                                <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                    <div class="deal-component">
                                        <label>Dollars</label>
                                        <input type="text" name="" id="deal_dollars" value=""
                                            class="au-input au-input--full form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                    <div class="deal-component">
                                        <label>CPM</label>
                                        <input type="text" name="" id="deal_cpm" value=""
                                            class="au-input au-input--full form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                    <div class="deal-component">
                                        <label>Impressions</label>
                                        <input type="text" name="" id="deal_impressions" value=""
                                            class="au-input au-input--full form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                    <div class="deal-component">
                                        <label>GRP</label>
                                        <input type="text" name="" id="deal_grp" value=""
                                            class="au-input au-input--full form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                    <div class="deal-component">
                                        <label>Deal Unit</label>
                                        <input type="text" name="" id="deal_deal_unit" value=""
                                            class="au-input au-input--full form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="advertiser-dashboard-box card">
                            <div class="advertiser-view">
                                <div class="row advertiser-component">
                                    <div
                                        class="col-12 head d-flex justify-content-between align-items-center mb-4">
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
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        <input type="text" name="advertiser_inflight" id="advertiser_inflight"
                                            value="0 Inflight" class="au-input au-input--full form-control"
                                            disabled>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        <input type="text" name="advertiser_proposal" id="advertiser_proposal"
                                            value="0 Proposal" class="au-input au-input--full form-control"
                                            disabled>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        <input type="text" name="advertiser_ended" id="advertiser_ended"
                                            value="0 Ended" class="au-input au-input--full form-control"
                                            disabled>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        <input type="text" name="advertiser_approved" id="advertiser_approved"
                                            value="0 Approved" class="au-input au-input--full form-control"
                                            disabled>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        <input type="text" name="advertiser_order" id="advertiser_order"
                                            value="0 Ordered" class="au-input au-input--full form-control"
                                            disabled>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        <input type="text" name="advertiser_planning" id="advertiser_planning"
                                            value="0 Planning" class="au-input au-input--full form-control"
                                            disabled>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 form-group">
                                        <input type="text" name="advertiser_expired" id="advertiser_expired"
                                            value="0 Expired" class="au-input au-input--full form-control"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                        </div> */?>
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
                                <div class="col-md-6 form-group">
                                    <div class="deal-component bg-blue">
                                        <h3>Dollars</h3>
                                        <h5 id="deal_dollars">$0</h5>
                                        <div class="icon-box">
                                        <img src="{{ asset('public/images/dashboard/doller-icon.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="deal-component bg-green">
                                        <h3>CPM</h3>
                                        <h5 id="deal_cpm">$0</h5>
                                        <div class="icon-box">
                                        <img src="{{ asset('public/images/dashboard/cpm-icon.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="deal-component bg-yellow">
                                        <h3>Impressions</h3>
                                        <h5 id="deal_impressions">$0</h5>
                                        <div class="icon-box">
                                        <img src="{{ asset('public/images/dashboard/impressions-icon.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="deal-component bg-red">
                                        <h3>GRP</h3>
                                        <h5 id="deal_grp">$0</h5>
                                        <div class="icon-box">
                                        <img src="{{ asset('public/images/dashboard/grp-icon.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="deal-component bg-orange">
                                        <h3>Deal Unit</h3>
                                        <h5 id="deal_deal_unit">$0</h5>
                                        <div class="icon-box">
                                        <img src="{{ asset('public/images/dashboard/deal-icon.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
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
                                    <div class="col-md-6 col-lg-4 col-xl-4 form-group">
                                        <div class="advertiser-component d-flex align-items-center">
                                            <span class="info-icon overview-item--c1"><i class="fa fa-plane"></i></span>
                                            <h4 id="advertiser_inflight" >0 Inflight</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 form-group">
                                        <div class="advertiser-component d-flex align-items-center">
                                            <span class="info-icon overview-item--c2"><i class="fa fa-file"></i></span>
                                            <h4 id="advertiser_proposal">0 Proposal</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 form-group">
                                        <div class="advertiser-component d-flex align-items-center">
                                            <span class="info-icon overview-item--c3"><i class="fa fa-clock-o"></i></span>
                                            <h4 id="advertiser_ended" >0 Ended</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 form-group">
                                        <div class="advertiser-component d-flex align-items-center">
                                            <span class="info-icon overview-item--c4"><i class="fa fa-thumbs-up"></i></span>
                                            <h4 id="advertiser_approved">0 Approved</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 form-group">
                                        <div class="advertiser-component d-flex align-items-center">
                                            <span class="info-icon overview-item--c1"><i class="fa fa-shopping-cart"></i></span>
                                            <h4 id="advertiser_order">0 Ordered</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 form-group">
                                        <div class="advertiser-component d-flex align-items-center">
                                            <span class="info-icon overview-item--c2"><i class="fa fa-list-alt"></i></span>
                                            <h4 id="advertiser_planning">0 Planning</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 form-group">
                                        <div class="advertiser-component d-flex align-items-center">
                                            <span class="info-icon overview-item--c3"><i class="fa fa-clock-o"></i></span>
                                            <h4 id="advertiser_expired">0 Expired</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="forgot_password">   
                        @csrf

                        <div class="form-group row">
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" >
                            <input type="hidden" id="user_id" class="form-control" name="user_id" value="{{ Session::get('user_id') }}">
                            <span class="message"></span>
                        </div>
                        <div class="form-group row">
                            <label for="current password" class="col-md-4 col-form-label text-md-right">Current Password</label>
                            <div class="col-md-6">
                                <input type="password" id="current_password" class="form-control" name="current_password" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new password" class="col-md-4 col-form-label text-md-right">New Password</label>
                            <div class="col-md-6">
                                <input type="password" id="new_password" class="form-control" name="new_password" value=""  >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" >
                            </div>
                        </div>

                        <div class="col-md-6 offset-md-4">
                            <input type="submit" class="btn btn-primary" value="Chnage Password" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop