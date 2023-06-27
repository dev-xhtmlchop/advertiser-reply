@extends('layouts.default')
@section('title') {{'Edit Campaign'}} @endsection
@section('content')
    <div class="main-content campaign-edit">
        <div class="section__content section__content--p10">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 card-main">
                        @if( !empty( $campaign ) )
                        <div class="deal-view-box card">
                            <div class="campaign-number-time-sec">
                                <div class="campaign-number">
                                    <h5>Editing Campaign : {{ $campaign['campaign_payloads_id'] }} {{ $campaign['campaign_payloads_name'] }}</h5>
                                </div>
                                <div class="campaign-date">
                                    <span>Deal Valid Till Date</span>
                                    <span>{{ date('m-d-Y', strtotime($campaign['campaigns_valid_from'])) }}</span>
                                    <span>Deal Year {{ $campaign['campaigns_year'] }}</span>
                                </div>
                            </div>
                            <div class="head d-flex justify-content-between align-items-center mb-4">
                                <div class="card-body">
                                    <div class="default-tab">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                                                <a class="nav-item nav-link" id="cpm-imp-tab" data-toggle="tab" href="#cpm-imp" role="tab" aria-controls="cpm-imp" aria-selected="false">CPM/IPM</a>
                                                <a class="nav-item nav-link" id="flighting-tab" data-toggle="tab" href="#flighting" role="tab" aria-controls="flighting" aria-selected="false">Flighting</a>
                                                <a class="nav-item nav-link" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="false">Summary</a>
                                            </div>
                                        </nav>
                                            <form method="post" id="edit_campaign">
                                                <input type="hidden" name="campaign_id" id="campaign_id" value="" />
                                                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">    
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-4">    
                                                                    <div class="form-group">
                                                                        <label for="campaign_number">Campaign Number</label>
                                                                        <input type="text" id="campaign_number" class="au-input au-input--full form-control campaign_number" name="campaign_number" value="" disabled />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="campaign_name">Campaign Name</label>
                                                                        <input type="text" id="campaign_name" class="au-input au-input--full form-control campaign_name" name="campaign_name" value="" disabled />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="brand_name">Brand</label>
                                                                        <input type="text" id="brand_name" class="au-input au-input--full form-control brand_name" name="brand_name" value="" disabled />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="media_line">Media Line</label>
                                                                        <input type="text" id="media_line" class="au-input au-input--full form-control media_line_name" name="media_line_name" value="" disabled />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="dollar_rate">$ Rate</label>
                                                                        <input type="text" id="dollar_rate" class="au-input au-input--full form-control" name="dollar_rate" value="" disabled />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="agency_name">Agency Name</label>
                                                                        <input type="text" id="agency_name" class="au-input au-input--full form-control" name="agency_name" value="" disabled />
                                                                    </div>
                                                                </div>
                                                                <div class="col-4"> 
                                                                    <div class="form-group">
                                                                        <label for="demo_name">Demo</label>
                                                                        <input type="text" id="demo_name" class="au-input au-input--full form-control" name="demo_name" value="" disabled />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ae_name">AE</label>
                                                                        <input type="text" id="ae_name" class="au-input au-input--full form-control" name="ae_name" value="" disabled />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="outlet_name">Outlet</label>
                                                                        <input type="text" id="outlet_name" class="au-input au-input--full form-control" name="outlet_name" value="" disabled />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="market_place">Market Place</label>
                                                                        <input type="text" id="market_place" class="au-input au-input--full form-control" name="market_place" value="" disabled />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="realistic">Realistic</label>
                                                                        <input type="text" id="realistic" class="au-input au-input--full form-control" name="realistic" value="" disabled />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="agency_commision">Agency Commision</label>
                                                                        <input type="text" id="agency_commision" class="au-input au-input--full form-control" name="agency_commision" value="" disabled />
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <label for="revenue_risk">Revenue Risk</label>
                                                                        <input type="text" id="revenue_risk" class="au-input au-input--full form-control" name="revenue_risk" value="" disabled />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="budget">Budget</label>
                                                                        <input type="text" id="budget" class="au-input au-input--full form-control" name="budget" value="" disabled />
                                                                    </div>
                                                                </div>
                                                                <div class="head d-flex justify-content-center align-items-center mb-4">
                                                                    <a href="javascript:void(0);" class="btn btn-lg btn-secondary tab-btn" attr-active="cpm-imp" >Go To CPM/IPM</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="cpm-imp" role="tabpanel" aria-labelledby="cpm-imp-tab">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                        <div class="form-group">
                                                                        <select name="demographic_name" class="au-input au-input--full" id="demographic_name">
                                                                            <option value="">Demographic</option>
                                                                            @if( count( $demographicList ) > 0 )
                                                                                @foreach( $demographicList as $demographicListKey => $demographicListVal )
                                                                                    <option value="{{ $demographicListVal['id'] }}">{{ $demographicListVal['name'] }}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="head d-flex justify-content-center align-items-center mb-4">
                                                                    <a href="javascript:void(0);" class="btn btn-lg btn-secondary tab-btn" attr-active="general" >Go To General</a>
                                                                    <a href="javascript:void(0);" class="btn btn-lg btn-secondary ml-5 tab-btn" attr-active="flighting" >Go To Flighting</a>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="flighting" role="tabpanel" aria-labelledby="flighting-tab">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="col-4">
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="Flight Start Date" id="flight_start_date" class="au-input au-input--full form-control" name="flight_start_date" />
                                                                            <input type="text" id="campaign_flight_start_date" placeholder="MM/DD/YYYY" class="au-input au-input--full form-control" name="campaign_flight_start_date" value="" disabled />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="Flight End Date" id="flight_end_date" class="au-input au-input--full form-control" name="flight_end_date" />
                                                                            <input type="text" id="campaign_flight_end_date" placeholder="MM/DD/YYYY" class="au-input au-input--full form-control" name="campaign_flight_end_date" value="" disabled />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="form-group">
                                                                            <label for="revenue_risk">Ad Length</label>
                                                                            <input type="text" id="ad_length" class="au-input au-input--full form-control" name="ad_length" value="" disabled />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <select name="day_parts" class="au-input au-input--full" id="day_parts">
                                                                                <option value="">Time / Day Part</option>
                                                                                @if( count( $dayPartList ) > 0 )
                                                                                    @foreach( $dayPartList as $dayPartListKey => $dayPartListVal )
                                                                                        <option value="{{ $dayPartListVal['id'] }}">{{ $dayPartListVal['name'] }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                            <input type="text" id="campaign_day_parts" class="au-input au-input--full form-control" name="campaign_day_parts" value="" disabled />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <table>
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
                                                                                <td><input type="checkbox"  name="days[]" value="sunday"  /></td>
                                                                                <td><input type="checkbox" name="days[]" value="monday"  /></td>
                                                                                <td><input type="checkbox" name="days[]" value="tuesday"  /></td>
                                                                                <td><input type="checkbox" name="days[]" value="wednesday"  /></td>
                                                                                <td><input type="checkbox" name="days[]" value="thursday"  /></td>
                                                                                <td><input type="checkbox" name="days[]" value="friday"  /></td>
                                                                                <td><input type="checkbox" name="days[]" value="saturday"  /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Split</td>
                                                                                <td><input type="text" class="au-input form-control"  name="sunday_split" value=""  /></td>
                                                                                <td><input type="text" class="au-input form-control" name="monday_split" value=""  /></td>
                                                                                <td><input type="text" class="au-input form-control" name="tuesday_split" value=""  /></td>
                                                                                <td><input type="text" class="au-input form-control" name="wednesday_split" value=""  /></td>
                                                                                <td><input type="text" class="au-input form-control" name="thursday_split" value=""  /></td>
                                                                                <td><input type="text" class="au-input form-control" name="friday_split" value=""  /></td>
                                                                                <td><input type="text" class="au-input form-control" name="saturday_split" value=""  /></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="head d-flex justify-content-center align-items-center mb-4">
                                                                    <a href="javascript:void(0);" class="btn btn-lg btn-secondary tab-btn" attr-active="cpm-imp" >Go To CPM/IPM</a>
                                                                    <a href="javascript:void(0);" class="btn btn-lg btn-secondary ml-5 tab-btn" attr-active="summary" >Go To Summary</a>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="col-4">    
                                                                        <div class="form-group">
                                                                            <label for="campaign_number">Campaign Number</label>
                                                                            <span class="campaign_number"></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="campaign_name">Campaign Name</label>
                                                                            <span class="campaign_name" ></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="brand_name">Brand</label>
                                                                            <span class="brand_name"></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="media_line">Media Line</label>
                                                                            <span class="media_line_name"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4"> 
                                                                        <div class="form-group">
                                                                            <label for="demo_name">Demo</label>
                                                                            <span class="demo_name"></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="ae_name">AE</label>
                                                                            <span class="ae_name"></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="outlet_name">Outlet</label>
                                                                            <span class="outlet_name"></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="market_place">Market Place</label>
                                                                            <input type="text" id="market_place" class="au-input au-input--full form-control" name="market_place" value="" disabled />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="form-group">
                                                                            <label for="date_change">Date Change</label>
                                                                            <input type="text" id="date_change" class="au-input au-input--full form-control" name="date_change" value="" disabled />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="chnage_by">Change By</label>
                                                                            <input type="text" id="chnage_by" class="au-input au-input--full form-control" name="chnage_by" value="" disabled />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 new-campaign-table">
                                                                    <div class="flight-date">
                                                                          <div class="flight-start-date">
                                                                            <span>Flight Start Date</span>
                                                                            <span class="flight-stat-date-text">MM/DD/YYYY</span>
                                                                          </div> 
                                                                          <div class="flight-end-date">
                                                                            <span>Flight End Date</span>
                                                                            <span class="flight-end-date-text">MM/DD/YYYY</span>
                                                                          </div>  
                                                                    </div>
                                                                    <div class="new-campaign-table">
                                                                        <table id="new_campaign_table" class="table custom-table table-borderless table-striped dataTable no-footer" style="width:100%" >
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
                                                                                        <td>110000003</td>    
                                                                                        <td>WWE Abc</td>    
                                                                                        <td>WWE Abc</td>    
                                                                                        <td>PRIME</td>    
                                                                                        <td>X3</td>    
                                                                                        <td>2023-05-01 13:33:50</td>    
                                                                                        <td>2024-06-30 13:33:50</td>    
                                                                                        <td>Linear</td>    
                                                                                        <td>NR</td>    
                                                                                        <td>20</td>    
                                                                                        <td>29</td>    
                                                                                        <td>29</td>    
                                                                                        <td>140</td>    
                                                                                        <td>144</td>    
                                                                                        <td>1</td>    
                                                                                    </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 old-campaign-table">
                                                                    <div class="flight-date">
                                                                          <div class="flight-start-date">
                                                                            <span>Flight Start Date</span>
                                                                            <span class="flight-stat-date-text">MM/DD/YYYY</span>
                                                                          </div> 
                                                                          <div class="flight-end-date">
                                                                            <span>Flight End Date</span>
                                                                            <span class="flight-end-date-text">MM/DD/YYYY</span>
                                                                          </div>  
                                                                    </div>
                                                                    <div class="new-campaign-table">
                                                                        <table id="old_campaign_table" class="table custom-table table-borderless table-striped dataTable no-footer" style="width:100%" >
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
                                                                                        <td>110000003</td>    
                                                                                        <td>WWE Abc</td>    
                                                                                        <td>WWE Abc</td>    
                                                                                        <td>PRIME</td>    
                                                                                        <td>X3</td>    
                                                                                        <td>2023-05-01 13:33:50</td>    
                                                                                        <td>2024-06-30 13:33:50</td>    
                                                                                        <td>Linear</td>    
                                                                                        <td>NR</td>    
                                                                                        <td>20</td>    
                                                                                        <td>29</td>    
                                                                                        <td>29</td>    
                                                                                        <td>140</td>    
                                                                                        <td>144</td>    
                                                                                        <td>1</td>    
                                                                                    </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="head d-flex justify-content-center align-items-center mb-4">
                                                                    <a href="javascript:void(0);" class="btn btn-lg btn-secondary tab-btn" attr-active="cpm-imp" >Go To CPM/IPM</a>
                                                                    <a href="javascript:void(0);" class="btn btn-lg btn-secondary ml-5 tab-btn" attr-active="summary" >Go To Summary</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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