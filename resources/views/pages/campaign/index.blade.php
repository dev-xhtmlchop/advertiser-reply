@extends('layouts.default')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p10">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 card-main">
                        <div class="deal-view-box card">
                            <div class="col-12 head d-flex justify-content-between align-items-center mb-4">
                                <h2 class="mb-0">Campaign View</h2>
                                <button class="btn btn-secondary" >Edit Campaign</button>
                            </div>
                            <div class="row table-responsive table-responsive-data2">
                                <table id="campaign_table" class="table table-striped" style="width:100%" >
                                    <thead>
                                        <tr>
                                            @foreach( $tableTitle as $tableTitleRow )
                                                <th>{{ $tableTitleRow }}</th>
                                            @endforeach    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $tableData as $tableDetailRowKey => $tableDetailRowVal )
                                            <tr class="tr-shadow">
                                                @foreach( $tableDetailRowVal as $tableRowDetailKey => $tableRowDetailVal )
                                                    @if( $tableRowDetailKey == 'deal_auto_id' )
                                                    <td>
                                                        <label class="au-radio">
                                                            <input type="radio" value="{{ $tableRowDetailVal }}" name="deal_number" id="deal_number" attr-id="{{ $tableDetailRowVal['deal_id'] }}" >
                                                        </label>
                                                    </td>
                                                    @else
                                                        <td key="{{ $tableDetailRowKey }}">{{ $tableRowDetailVal }}</td>    
                                                    @endif
                                                @endforeach    
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 head d-flex justify-content-between align-items-center mb-4">
                                <button class="btn btn-secondary" >Create Campaign</button>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div> 
@stop