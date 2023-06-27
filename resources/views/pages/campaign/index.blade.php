@extends('layouts.default')
@section('title') {{'Campaign'}} @endsection
@section('content')
    <div class="main-content campaign-view-sec">
        <div class="section__content section__content--p10">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 card-main">
                        <div class="deal-view-box card">
                            <div class="head d-flex justify-content-center align-items-center mb-4">
                                <h2 class="mb-0">Campaign View</h2>
                                <div class="d-flex align-items-center flight-range">
                                    <div class="daterange d-flex align-items-center">
                                        <button class="btn btn-lg btn-secondary" >Create Campaign</button>    
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table-responsive-data2">
                                <table id="campaign_table" class="table custom-table table-borderless table-striped dataTable no-footer" style="width:100%;" >
                                    <thead>
                                        <tr>
                                            @foreach( $tableTitle as $tableTitleKey => $tableTitleRow )
                                                @if( $tableTitleKey == 1 )
                                                    <th class="reorder">{{ $tableTitleRow }}</th>
                                                @else
                                                    <th>{{ $tableTitleRow }}</th>
                                                @endif
                                            @endforeach    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $tableData as $tableDetailRowKey => $tableDetailRowVal )
                                            <tr class="tr-shadow">
                                                @foreach( $tableDetailRowVal as $tableRowDetailKey => $tableRowDetailVal )
                                                    @if( $tableRowDetailKey == 'deal_auto_id' )
                                                    <td>
                                                        <label class="form-check au-radio deal-number">
                                                            <input class="form-check-input" type="radio" value="{{ $tableDetailRowVal['campaign_id'] }}" name="deal_number" id="deal_number" autoid="" >
                                                        </label>
                                                    </td>
                                                    @elseif( $tableRowDetailKey == 'day_time' )
                                                    <td class="{{ $tableRowDetailKey }}">{{ $dayTableData[$tableDetailRowKey] }} {{ $tableRowDetailVal }}</td>
                                                    @else
                                                        <td key="{{ $tableRowDetailKey }}">{{ $tableRowDetailVal }}</td>    
                                                    @endif
                                                @endforeach    
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="head d-flex justify-content-center align-items-center mb-4">
                                <button class="btn btn-lg btn-secondary" id="edit_campaign_id" dealid="" autoincrementid="" disabled>Edit Campaign</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div> 
@stop