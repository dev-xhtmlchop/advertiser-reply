@extends('layouts.default')
@section('title') {{'Edit Campaign'}} @endsection
@section('content')
    <div class="main-content campaign-edit">
        <div class="section__content section__content--p10">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 card-main">
                        @if( !empty( $campaign ) )
                        <div class="deal-view-box">
                            <div class="campaign-number-time-sec mb-5">
                                <div class="campaign-number text-center">
                                    <h4>Editing Campaign : {{ $campaign['campaign_payloads_id'] }} {{ $campaign['campaign_payloads_name'] }}</h4>
                                </div>
                                <div class="campaign-date text-center">
                                    <span>Deal Valid Till Date</span>
                                    <span>{{ date('m-d-Y', strtotime($campaign['campaigns_valid_from'])) }}</span>
                                    <span>Deal Year {{ $campaign['campaigns_year'] }}</span>
                                </div>
                            </div>
                            <div class="responsive-tabs d-md-flex">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a id="general" href="#pane-A" class="nav-link active" data-bs-toggle="tab" role="tab"><i class="fa fa-wrench" aria-hidden="true"></i>General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="cpm-imp" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab"><i class="fa fa-users" aria-hidden="true"></i>CPM/IPM</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="flighting" href="#pane-C" class="nav-link" data-bs-toggle="tab" role="tab"><i class="fa fa-calendar-o" aria-hidden="true"></i>Flighting</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="summary" href="#pane-D" class="nav-link" data-bs-toggle="tab" role="tab"><i class="fa fa-file-text" aria-hidden="true"></i>Summary</a>
                                    </li>
                                </ul>
                                <div id="content" class="tab-content" role="tablist">
                                    <form method="post" id="edit_campaign">
                                        <input type="hidden" name="campaign_id" id="campaign_id" value="" />
                                        <div id="pane-A" class="general-tab card tab-pane fade show active" role="tabpanel"
                                            aria-labelledby="general">
                                            <div class="card-header" role="tab" id="heading-A">
                                                <h5 class="mb-0">
                                                    <a data-bs-toggle="collapse" href="#collapse-A"
                                                        aria-expanded="true" aria-controls="collapse-A">
                                                        General
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse-A" class="collapse show" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-A">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-4 form-group">
                                                            <label for="campaign_number">Campaign Number</label>
                                                            <input type="text" id="campaign_number" class="au-input au-input--full form-control campaign_number" name="campaign_number" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="campaign_name">Campaign Name</label>
                                                            <input type="text" id="campaign_name"class="au-input au-input--full form-control campaign_name"name="campaign_name" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="brand_name">Brand</label>
                                                            <input type="text" id="brand_name"class="au-input au-input--full form-control brand_name"name="brand_name" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="media_line">Media Line</label>
                                                            <input type="text" id="media_line"class="au-input au-input--full form-control media_line_name"name="media_line_name" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="dollar_rate">$ Rate</label>
                                                            <input type="text" id="dollar_rate"class="au-input au-input--full form-control"name="dollar_rate" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="agency_name">Agency Name</label>
                                                            <input type="text" id="agency_name"class="au-input au-input--full form-control"name="agency_name" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="demo_name">Demo</label>
                                                            <input type="text" id="demo_name"class="au-input au-input--full form-control"name="demo_name" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="ae_name">AE</label>
                                                            <input type="text" id="ae_name"class="au-input au-input--full form-control"name="ae_name" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="outlet_name">Outlet</label>
                                                            <input type="text" id="outlet_name"class="au-input au-input--full form-control"name="outlet_name" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="market_place">Market Place</label>
                                                            <input type="text" id="market_place"class="au-input au-input--full form-control"name="market_place" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="realistic">Realistic</label>
                                                            <input type="text" id="realistic"class="au-input au-input--full form-control"name="realistic" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="agency_commision">Agency Commision</label>
                                                            <input type="text" id="agency_commision"class="au-input au-input--full form-control"name="agency_commision" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="revenue_risk">Revenue Risk</label>
                                                            <input type="text" id="revenue_risk"class="au-input au-input--full form-control"name="revenue_risk" value="" disabled="">
                                                        </div>
                                                        <div class="col-lg-4 form-group">
                                                            <label for="budget">Budget</label>
                                                            <input type="text" id="budget"class="au-input au-input--full form-control"name="budget" value="" disabled="">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <a href="javascript:void(0);" class="btn btn-lg btn-secondary tab-btn" attr-active="cpm-imp" >Go To CPM/IPM</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pane-B" class="cpm-imp-tab card tab-pane fade" role="tabpanel" aria-labelledby="cpm-imp">
                                            <div class="card-header" role="tab" id="heading-B">
                                                <h5 class="mb-0">
                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                        href="#collapse-B" aria-expanded="false"
                                                        aria-controls="collapse-B">
                                                        CPM/IPM
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse-B" class="collapse" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-B">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4 form-group">
                                                            <select name="demographic_name" class="au-input au-input--full" id="demographic_name" disabled>
                                                                <option value="">Demographic</option>
                                                                @if( count( $demographicList ) > 0 )
                                                                    @foreach( $demographicList as $demographicListKey => $demographicListVal )
                                                                        <option value="{{ $demographicListVal['id'] }}">{{ $demographicListVal['name'] }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <a href="javascript:void(0);" class="btn btn-lg btn-secondary tab-btn" attr-active="general" >Go To General</a>
                                                            <a href="javascript:void(0);" class="btn btn-lg btn-secondary ml-md-3 tab-btn" attr-active="flighting" >Go To Flighting</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pane-C" class="flighting-tab card tab-pane fade" role="tabpanel" aria-labelledby="flighting">
                                            <div class="card-header" role="tab" id="heading-C">
                                                <h5 class="mb-0">
                                                    <a data-bs-toggle="collapse" href="#collapse-C"
                                                        aria-expanded="true" aria-controls="collapse-C">
                                                        Flighting
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse-C" class="collapse" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-C">
                                                <div class="card-body">
                                                    <div class="row mb-5">
                                                        <div class="col-md-6 pl-md-3">
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <input type="text" placeholder="Flight Start Date" id="flight_start_date" class="au-input au-input--full form-control" name="flight_start_date">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <input type="text" id="campaign_flight_start_date" placeholder="MM/DD/YYYY" class="au-input au-input--full form-control" name="campaign_flight_start_date" value=""disabled="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pr-md-3">
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="revenue_risk">Ad Length</label>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <input type="text" id="ad_length" class="au-input au-input--full form-control" name="ad_length" value="" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <input type="text" placeholder="Flight End Date" id="flight_end_date" class="au-input au-input--full form-control" name="flight_end_date">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <input type="text" id="campaign_flight_end_date" placeholder="MM/DD/YYYY" class="au-input au-input--full form-control" name="campaign_flight_end_date" value=""disabled="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <select name="day_parts"class="au-input au-input--full" id="day_parts">
                                                                    <option value="">Time / Day Part</option>
                                                                                @if( count( $dayPartList ) > 0 )
                                                                                    @foreach( $dayPartList as $dayPartListKey => $dayPartListVal )
                                                                                        <option value="{{ $dayPartListVal['id'] }}">{{ $dayPartListVal['name'] }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <input type="text" id="campaign_day_parts"class="au-input au-input--full form-control"name="campaign_day_parts" value=""disabled="">
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <table class="table custom-table table-borderless table-striped dataTable no-footer" id="edit_flight">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>S - Sunday</th>
                                                                    <th>M - Monday</th>
                                                                    <th>T - Tuesday</th>
                                                                    <th>W - Wednesday</th>
                                                                    <th>T - Thursday</th>
                                                                    <th>F - Friday</th>
                                                                    <th>S - Saturday</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Days</td>
                                                                    <td><input type="checkbox" class="form-check-input" name="days[]" value="sunday" id="sunday"  /></td>
                                                                    <td><input type="checkbox" class="form-check-input" name="days[]" value="monday" id="monday"  /></td>
                                                                    <td><input type="checkbox" class="form-check-input" name="days[]" value="tuesday" id="tuesday"  /></td>
                                                                    <td><input type="checkbox" class="form-check-input" name="days[]" value="wednesday" id="wednesday"  /></td>
                                                                    <td><input type="checkbox" class="form-check-input" name="days[]" value="thursday" id="thursday"  /></td>
                                                                    <td><input type="checkbox" class="form-check-input" name="days[]" value="friday" id="friday"  /></td>
                                                                    <td><input type="checkbox" class="form-check-input" name="days[]" value="saturday" id="saturday"  /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Split</td>
                                                                    <td><input type="number" class="au-input form-control" name="sunday_split" id="sunday_split" value="" max="100" /></td>
                                                                    <td><input type="number" class="au-input form-control" name="monday_split" id="monday_split" value="" max="100" /></td>
                                                                    <td><input type="number" class="au-input form-control" name="tuesday_split" id="tuesday_split" value="" max="100" /></td>
                                                                    <td><input type="number" class="au-input form-control" name="wednesday_split" id="wednesday_split" value="" max="100" /></td>
                                                                    <td><input type="number" class="au-input form-control" name="thursday_split" id="thursday_split" value="" max="100" /></td>
                                                                    <td><input type="number" class="au-input form-control" name="friday_split" id="friday_split" value="" max="100" /></td>
                                                                    <td><input type="number" class="au-input form-control" name="saturday_split" id="saturday_split" value="" max="100" /></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div> 
                                                    <div class="col-md-12">
                                                        <a href="javascript:void(0);" class="btn btn-lg btn-secondary tab-btn" attr-active="cpm-imp" >Go To CPM/IPM</a>
                                                        <a href="javascript:void(0);" class="btn btn-lg btn-secondary ml-md-3 tab-btn" attr-active="summary" >Go To Summary</a>
                                                    </div>     
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pane-D" class="summary-tab card tab-pane fade " role="tabpanel" aria-labelledby="summary">
                                            <div class="card-header" role="tab" id="heading-D">
                                                <h5 class="mb-0">
                                                    <a data-bs-toggle="collapse" href="#collapse-D"
                                                        aria-expanded="true" aria-controls="collapse-D">
                                                        Summary
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse-D" class="collapse" data-bs-parent="#content"
                                                role="tabpanel" aria-labelledby="heading-D">
                                                <div class="card-body" id="summary">
                                                    <div class="row mb-5">
                                                        <div class="col-md-6 form-group">
                                                            <label for="campaign_number">Campaign Number</label>
                                                            <span class="campaign_number au-input au-input--full form-control"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="campaign_name">Campaign Name</label>
                                                            <span class="campaign_name au-input au-input--full form-control"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="brand_name">Brand</label>
                                                            <span class="brand_name au-input au-input--full form-control"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="media_line">Media Line</label>
                                                            <span class="media_line_name au-input au-input--full form-control"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="demo_name">Demo</label>
                                                            <span class="demo_name au-input au-input--full form-control"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="ae_name">AE</label>
                                                            <span class="ae_name au-input au-input--full form-control"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="outlet_name">Outlet</label>
                                                            <span class="outlet_name au-input au-input--full form-control"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="market_place">Market Place</label>
                                                            <span class="market_place au-input au-input--full form-control"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="date_change">Date Change</label>
                                                            <span class="date_change au-input au-input--full form-control"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="chnage_by">Change By</label>
                                                            <span class="chnage_by au-input au-input--full form-control"></span>
                                                        </div>
                                                    </div>
                                                    <div class="new-campaign-table mb-5">
                                                    <h4>New Detail</h4>
                                                        <div class="flight-date row mb-4">
                                                            <div class="col-md-6 form-group flight-start-date">
                                                                <span class="label">Flight Start Date</span>
                                                                <span class="new-flight-stat-date-text au-input au-input--full form-control ">MM/DD/YYYY</span>
                                                            </div>
                                                            <div class="col-md-6 form-group flight-end-date">
                                                                <span class="label">Flight End Date</span>
                                                                <span class="new-flight-end-date-text au-input au-input--full form-control">MM/DD/YYYY</span>
                                                            </div>
                                                        </div>
                                                        <div class="new-campaign-table">
                                                            <table id="new_campaign_table"  class="table custom-table table-borderless table-striped dataTable no-footer"  style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Campaign Number</th>
                                                                        <th>Campaign Name</th>
                                                                        <th>Title</th>
                                                                        <th>Day/ Time</th>
                                                                        <th>Brand</th>
                                                                        <th>Start Flight</th>
                                                                        <th>End Flight</th>
                                                                        <th>Media Line</th>
                                                                        <th>Inv Type</th>
                                                                        <th>Inv Length</th>
                                                                        <th>$ Rate</th>
                                                                        <th>$ Rate</th>
                                                                        <th>% Rate</th>
                                                                        <th>Total Avails</th>
                                                                        <th>Total Unit</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="tr-shadow">
                                                                        <td class="new-campaign-id">110000003</td>
                                                                        <td class="new-campaign-name" >WWE Abc</td>
                                                                        <td class="new-campaign-deal-name" >WWE Abc</td>
                                                                        <td class="new-campaign_day-time" >PRIME</td>
                                                                        <td class="new-campaign-brand" >X3</td>
                                                                        <td class="new-campaign-start-flight-date" >2023-05-01</td>
                                                                        <td class="new-campaign-end-flight-date" >2024-06-30</td>
                                                                        <td class="new-campaign-media-line" >Linear</td>
                                                                        <td class="new-campaign-inv-type" >NR</td>
                                                                        <td class="new-campaign-inv-length" >20</td>
                                                                        <td class="new-campaign-rate" >29</td>
                                                                        <td class="new-campaign-do-rate" >29</td>
                                                                        <td class="new-campaign-per-rate" >140</td>
                                                                        <td class="new-campaign-total-avail" >144</td>
                                                                        <td class="new-campaign-total-unit" >1</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="old-campaign-table">
                                                        <h4>Old Detail</h4>
                                                        <div class="flight-date row mb-4">
                                                            <div class="flight-start-date form-group col-md-6">
                                                                <span class="label">Flight Start Date</span>
                                                                <span class="flight-stat-date-text au-input au-input--full form-control">MM/DD/YYYY</span>
                                                            </div>
                                                            <div class="flight-end-date form-group col-md-6">
                                                                <span class="label">Flight End Date</span>
                                                                <span class="flight-end-date-text au-input au-input--full form-control">MM/DD/YYYY</span>
                                                            </div>
                                                        </div>
                                                        <div class="old-campaign-table">
                                                            <table id="old_campaign_table" class="table custom-table table-borderless table-striped dataTable no-footer" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Campaign Number</th>
                                                                        <th>Campaign Name</th>
                                                                        <th>Title</th>
                                                                        <th>Day/ Time</th>
                                                                        <th>Brand</th>
                                                                        <th>Start Flight</th>
                                                                        <th>End Flight</th>
                                                                        <th>Media Line</th>
                                                                        <th>Inv Type</th>
                                                                        <th>Inv Length</th>
                                                                        <th>$ Rate</th>
                                                                        <th>$ Rate</th>
                                                                        <th>% Rate</th>
                                                                        <th>Total Avails</th>
                                                                        <th>Total Unit</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="tr-shadow">
                                                                        <td class="old-campaign-id">110000003</td>
                                                                        <td class="old-campaign-name" >WWE Abc</td>
                                                                        <td class="old-campaign-deal-name" >WWE Abc</td>
                                                                        <td class="old-campaign_day-time" >PRIME</td>
                                                                        <td class="old-campaign-brand" >X3</td>
                                                                        <td class="old-campaign-start-flight-date" >2023-05-01</td>
                                                                        <td class="old-campaign-end-flight-date" >2024-06-30</td>
                                                                        <td class="old-campaign-media-line" >Linear</td>
                                                                        <td class="old-campaign-inv-type" >NR</td>
                                                                        <td class="old-campaign-inv-length" >20</td>
                                                                        <td class="old-campaign-rate" >29</td>
                                                                        <td class="old-campaign-do-rate" >29</td>
                                                                        <td class="old-campaign-per-rate" >140</td>
                                                                        <td class="old-campaign-total-avail" >144</td>
                                                                        <td class="old-campaign-total-unit" >1</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <a href="javascript:void(0);" class="btn btn-lg btn-secondary" attr-active="cpm-imp" >Keep Original</a>
                                                        <a href="javascript:void(0);" class="btn btn-lg btn-secondary ml-md-3 tab-btn" attr-active="flighting" >Go To Flighting</a>
                                                        <a href="javascript:void(0);" class="btn btn-lg btn-secondary ml-md-3 tab-btn" >Send To Approval</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="deal-view-box card">
                            <h4>Error Please check Campaign Id</h4>
                        </div>    
                        @endif
                    </div>
                </div>
            </div>        
        </div>
    </div> 
@stop