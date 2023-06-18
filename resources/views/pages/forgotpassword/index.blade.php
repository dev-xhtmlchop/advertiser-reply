@extends('layouts.default')

@section('title') {{'Dashboard'}} @endsection

@section('content')

    <div class="col-12">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-8">
                    <h1>Change Password</h1>
                        <form id="forgot_password">   
                            @csrf

                            <div class="form-group row">
                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" >
                                <input type="hidden" id="user_id" class="form-control" name="user_id" value="{{ $data['user_id'] }}">
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
    </div>
    @stop