@extends('layouts.default')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p10">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 card-main">
                        <div class="deal-view-box card">
                            <div class=" head d-flex justify-content-center align-items-center mb-4">
                                <h2 class="mb-0">Deal View</h2>
                                <select name="deal_status" id="deal_status" class="au-input" >
                                    <option value="">Deal Status</option>
                                    @if( count( $dealStatus ) > 0 )
                                        @foreach( $dealStatus as $dealStatusKey => $dealStatusVal )
                                            <option value="{{ $dealStatusVal['slug'] }}">{{ $dealStatusVal['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            
                            <div class="row deal-view">
                                @if( count( $dealView ) > 0 )
                                    @foreach( $dealView as $dealViewKey => $dealViewVal )
                                        @php
                                            $imageUrl = "public/images/dashboard/".$dealViewVal['image'];
                                        @endphp
                                        <div class="col-md-3 form-group">
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
                </div>
                <div class="row">
                    <div class="col-md-12 card-main">
                        <div class="deal-view-box card">
                            <div class="row table-responsive table-responsive-data2">
                                <table id="deals_table" class="table custom-table table-borderless table-striped dataTable no-footer " style="width:100%">
                                    <thead>
                                        <tr>
                                            @foreach( $tableTitle as $tableTitleRow )
                                                <th>{{ $tableTitleRow }}</th>
                                            @endforeach    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $tableData as $key => $tableDetailRowVal )
                                            <tr class="tr-shadow">
                                                @foreach( $tableDetailRowVal as $tableRowDetail )
                                                    <td>{{ $tableRowDetail }}</td>
                                                @endforeach    
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div> 
@stop