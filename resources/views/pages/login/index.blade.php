@extends('layouts.default')

@section('content')

    <div class="page-wrapper login">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="/">
                                <img src="{{ asset('public/assets/images/logo/logo.png') }}" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <h3 class="text-center mb-3">Login</h3>
                            <div class="alert alert-notification text-center mb-3" role="alert"></div>
                            <form id="login_form" method="post">   
                                @csrf
                                <div class="form-group">
                                    <label for="user_name">User Name</label>
                                    <input type="text" id="user_name" class="au-input au-input--full form-control" name="user_name" value="{{ old('user_name') }}"  autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="au-input au-input--full form-control" name="password" value="{{ old('password') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="password">Media Line</label>
                                    <select name="media" id="media" class="au-input au-input--full form-control">
                                        <option value="">Select Option</option>
                                        @if( $data['mediaList'] )
                                            @foreach( $data['mediaList'] as $mediaKey => $mediaValue)
                                            <option value="{{ $mediaValue['id'] }}" 
                                                @if ( $mediaValue['id'] == old('media') ) selected="selected" @endif>{{ $mediaValue['name'] }}</option>
                                            @endforeach;
                                        @endif;
                                </select>
                                </div>
        
                                <div class="text-center">
                                    <input type="submit" class="au-btn au-btn--block au-btn--green" value="Advertiser Reply Login" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('includes.script')
    @stop