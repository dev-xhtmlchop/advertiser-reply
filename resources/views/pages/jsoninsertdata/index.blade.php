@extends('layouts.default')
@section('title') {{'JSON Data'}} @endsection
@section('content')
<style>

/*---------signup-step-------------*/
.bg-color{background-color: #333; } .signup-step-container{padding: 150px 0px; padding-bottom: 60px; } .wizard .nav-tabs {position: relative; margin-bottom: 0; border-bottom-color: transparent; } .wizard > div.wizard-inner {position: relative; margin-bottom: 50px; text-align: center; } .connecting-line {height: 2px; background: #e0e0e0; position: absolute; width: 75%; margin: 0 auto; left: 0; right: 0; top: 15px; z-index: 1; } .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {color: #555555; cursor: default; border: 0; border-bottom-color: transparent; } span.round-tab {width: 30px; height: 30px; line-height: 30px; display: inline-block; border-radius: 50%; background: #fff; z-index: 2; position: absolute; left: 0; text-align: center; font-size: 16px; color: #0e214b; font-weight: 500; border: 1px solid #ddd; } span.round-tab i{color:#555555; } .wizard li.active span.round-tab {background: #0db02b; color: #fff; border-color: #0db02b; } .wizard li.active span.round-tab i{color: #5bc0de; } .wizard .nav-tabs > li.active > a i{color: #0db02b; } .wizard .nav-tabs > li {width: 25%; } .wizard li:after {content: " "; position: absolute; left: 46%; opacity: 0; margin: 0 auto; bottom: 0px; border: 5px solid transparent; border-bottom-color: red; transition: 0.1s ease-in-out; } .wizard .nav-tabs > li a {width: 30px; height: 30px; margin: 20px auto; border-radius: 100%; padding: 0; background-color: transparent; position: relative; top: 0; } .wizard .nav-tabs > li a i{position: absolute; top: -15px; font-style: normal; font-weight: 400; white-space: nowrap; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: 700; color: #000; } .wizard .nav-tabs > li a:hover {background: transparent; } .wizard .tab-pane {position: relative; padding-top: 20px; } .wizard h3 {margin-top: 0; } .prev-step, .next-step{font-size: 13px; padding: 8px 24px; border: none; border-radius: 4px; margin-top: 30px; } .next-step{background-color: #0db02b; } .skip-btn{background-color: #cec12d; } .step-head{font-size: 20px; text-align: center; font-weight: 500; margin-bottom: 20px; } .term-check{font-size: 14px; font-weight: 400; } .custom-file {position: relative; display: inline-block; width: 100%; height: 40px; margin-bottom: 0; } .custom-file-input {position: relative; z-index: 2; width: 100%; height: 40px; margin: 0; opacity: 0; } .custom-file-label {position: absolute; top: 0; right: 0; left: 0; z-index: 1; height: 40px; padding: .375rem .75rem; font-weight: 400; line-height: 2; color: #495057; background-color: #fff; border: 1px solid #ced4da; border-radius: .25rem; } .custom-file-label::after {position: absolute; top: 0; right: 0; bottom: 0; z-index: 3; display: block; height: 38px; padding: .375rem .75rem; line-height: 2; color: #495057; content: "Browse"; background-color: #e9ecef; border-left: inherit; border-radius: 0 .25rem .25rem 0; } .footer-link{margin-top: 30px; } .all-info-container{} .list-content{margin-bottom: 10px; } .list-content a{padding: 10px 15px; width: 100%; display: inline-block; background-color: #f5f5f5; position: relative; color: #565656; font-weight: 400; border-radius: 4px; } .list-content a[aria-expanded="true"] i{transform: rotate(180deg); } .list-content a i{text-align: right; position: absolute; top: 15px; right: 10px; transition: 0.5s; } .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {background-color: #fdfdfd; } .list-box{padding: 10px; } .signup-logo-header .logo_area{width: 200px; } .signup-logo-header .nav > li{padding: 0; } .signup-logo-header .header-flex{display: flex; justify-content: center; align-items: center; } .list-inline li{display: inline-block; } .pull-right{float: right; } /*-----------custom-checkbox-----------*/ /*----------Custom-Checkbox---------*/ input[type="checkbox"]{position: relative; display: inline-block; margin-right: 5px; } input[type="checkbox"]::before, input[type="checkbox"]::after {position: absolute; content: ""; display: inline-block; } input[type="checkbox"]::before{height: 16px; width: 16px; border: 1px solid #999; left: 0px; top: 0px; background-color: #fff; border-radius: 2px; } input[type="checkbox"]::after{height: 5px; width: 9px; left: 4px; top: 4px; } input[type="checkbox"]:checked::after{content: ""; border-left: 1px solid #fff; border-bottom: 1px solid #fff; transform: rotate(-45deg); } input[type="checkbox"]:checked::before{background-color: #18ba60; border-color: #18ba60; }
</style>
    <div class="main-content campaign-view-sec">
        <div class="section__content section__content--p10">
            <div class="container-fluid">
                <section class="signup-step-container">
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6">
                                <div class="wizard">
                                    <div class="wizard-inner">
                                        <div class="connecting-line"></div>
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#upload" data-toggle="tab" aria-controls="upload" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Upload</i></a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#fieldmapping" data-toggle="tab" aria-controls="fieldmapping" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Column Mapping</i></a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#preview" data-toggle="tab" aria-controls="preview" role="tab"><span class="round-tab">3</span> <i>Preview</i></a>
                                            </li>
                                        </ul>
                                    </div>
                                
                                    <form role="form" method="post" class="login-box" id="json_add_data_form">
                                        <div class="tab-content" id="main_form">
                                            <div class="tab-pane active" role="tabpanel" id="upload">
                                                <h4 class="text-center">Upload</h4>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-4 form-group">
                                                            <label for="upload_json">Upload json File</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                        <input class="au-input au-input--full form-control" type="file" name="json_file" id="json_file" accept=".json">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-4 form-group">
                                                            <label for="table_list">Table List</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                        @if( count( $tableList ) > 0 )
                                                            <select name="table_list" id="table_list"  class="au-input au-input--full valid" aria-invalid="false">
                                                                <option value="">Table Option</option>
                                                                @foreach( $tableList as $tableListKey => $tableListVal )
                                                                    <option value="{{ $tableListVal }}">{{ ucwords($tableListVal) }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-inline pull-right">
                                                    <li><button type="button" class="default-btn next-step">Next step</button></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane" role="tabpanel" id="fieldmapping">
                                                <h4 class="text-center">Column Mapping</h4>
                                                <div class="row" id="db_fields_mapping">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <p><strong>Column Name</strong></p>
                                                            </div>  
                                                            <div class="col-md-6 form-group">
                                                                <p><strong>Map Fields</strong></p>
                                                            </div>         
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <span><strong>Name</strong></span>
                                                                <p>Sample:Test Data</p>
                                                            </div>  
                                                            <div class="col-md-6 form-group">
                                                                <select name="table_field_list" id="table_field_list"  class="au-input au-input--full valid" aria-invalid="false">
                                                                    <option value="">Table Fields Option</option>
                                                                    <option value="name">Name</option>
                                                                    <option value="deal_unit">Deal Unit</option>
                                                                    <option value="demo">Demo</option>
                                                                    <option value="ae">AE</option>
                                                                </select>
                                                            </div>         
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <span><strong>Deal Unit</strong></span>
                                                                <p>Sample:123</p>
                                                            </div>  
                                                            <div class="col-md-6 form-group">
                                                                <select name="table_field_list" id="table_field_list"  class="au-input au-input--full valid" aria-invalid="false">
                                                                    <option value="">Table Fields Option</option>
                                                                    <option value="name">Name</option>
                                                                    <option value="deal_unit">Deal Unit</option>
                                                                    <option value="demo">Demo</option>
                                                                    <option value="ae">AE</option>
                                                                </select>
                                                            </div>         
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <span><strong>AE</strong></span>
                                                                <p>Sample:789</p>
                                                            </div>  
                                                            <div class="col-md-6 form-group">
                                                                <select name="table_field_list" id="table_field_list"  class="au-input au-input--full valid" aria-invalid="false">
                                                                    <option value="">Table Fields Option</option>
                                                                    <option value="name">Name</option>
                                                                    <option value="deal_unit">Deal Unit</option>
                                                                    <option value="demo">Demo</option>
                                                                    <option value="ae">AE</option>
                                                                </select>
                                                            </div>         
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-inline pull-right">
                                                    <li><button type="button" class="default-btn prev-step">Back</button></li>
                                                    <li><button type="button" class="default-btn next-step skip-btn">Skip</button></li>
                                                    <li><button type="button" class="default-btn next-step">Next step</button></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane" role="tabpanel" id="preview">
                                                <h4 class="text-center">Preview</h4>
                                                <div class="row">
                                                    <div class="new-campaign-table-box table-responsive">
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
                                                                    <td class="new-campaign-id">1100000004</td>
                                                                    <td class="new-campaign-name">New I3 all Electric</td>
                                                                    <td class="new-campaign-deal-name">Electric at USA</td>
                                                                    <td class="new-campaign_day-time">S M T  T F  20H00</td>
                                                                    <td class="new-campaign-brand">X3</td>
                                                                    <td class="new-campaign-start-flight-date">07/19/2023</td>
                                                                    <td class="new-campaign-end-flight-date">07/19/2023</td>
                                                                    <td class="new-campaign-media-line">Linear</td>
                                                                    <td class="new-campaign-inv-type">NR</td>
                                                                    <td class="new-campaign-inv-length">10:00:20</td>
                                                                    <td class="new-campaign-rate">29</td>
                                                                    <td class="new-campaign-do-rate">29</td>
                                                                    <td class="new-campaign-per-rate">140</td>
                                                                    <td class="new-campaign-total-avail">144</td>
                                                                    <td class="new-campaign-total-unit">1</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <ul class="list-inline pull-right">
                                                    <li><button type="button" class="default-btn prev-step">Back</button></li>
                                                    <li><button type="button" class="default-btn next-step">Finish</button></li>
                                                    <li><button type="button" class="default-btn next-step">Cancel</button></li>
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop