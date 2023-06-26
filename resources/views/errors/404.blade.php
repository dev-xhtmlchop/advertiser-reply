@extends('layouts.default')
@section('title') {{'Error'}} @endsection
@section('content')

    <div class="page-wrapper login">
        <div class="page-content--bge5">
            <img src="{{ asset('public/images/login/login-bg.png') }}" alt="" class="bg-img">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="{{ route('dashboard') }}">
                                <img src="{{ asset('public/images/logo/logo.png') }}" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <h3 class="text-center mb-3">404</h3>
                            <div class="error-messag">
                                <h5 class="text-center">Oops! Something is wrong. Crew is working on it.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('includes.script')
    @stop