@extends('layouts.app')

@section('css')
{{-- <link href="{{ asset('js/plugins/datepicker/daterangepicker.css') }}" rel="stylesheet"> --}}
@stop

@section('content')

<div class="page-wrapper p-t-20 p-b-100 font-poppins">
    <div class="wrapper wrapper--w680">
        <div class="card card-4">
            <div class="card-body">
                <h2 class="title">Registration Form</h2>
                {{ Form::open(array('url'=> '#','id'=>'registration-form','class'=>'form-horizontal', 'method'=> 'POST')) }}
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group" id="first_name">
                                <label class="label">First Name</label>
                                <input class="input--style-4" type="text" name="first_name">
                                <small class="help-block"></small>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group" id="last_name">
                                <label class="label">Last Name</label>
                                <input class="input--style-4" type="text" name="last_name">
                                <small class="help-block"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group"  id="dob">
                                <label class="label">Birthday</label>
                                <div class="input-group-icon">
                                    <input class="input--style-4 js-datepicker" type="text" name="dob" >
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    <small class="help-block"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group"  id="gender">
                                <label class="label">Gender</label>
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">Male
                                        <input type="radio" value='Male' checked="checked" name="gender">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">Female
                                        <input type="radio" value='Female' name="gender">
                                        <span class="checkmark"></span>
                                    </label>
                                    <small class="help-block"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-12">
                            <div class="input-group"  id="email">
                                <label class="label">Email</label>
                                <input class="input--style-4" type="email" name="email">
                                <small class="help-block"></small>
                            </div>
                        </div>

                    </div>

                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group" id="password">
                                <label class="label">Password</label>
                                <input class="input--style-4" type="password" name="password">
                                <small class="help-block"></small>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group" id="confirm_password">
                                <label class="label">Confirm Password</label>
                                <input class="input--style-4" type="password" name="password_confirmation">
                                <small class="help-block"></small>
                            </div>
                        </div>
                    </div>

                    <div class="p-t-15">
                        <button class="btn btn--radius-2 btn--blue" type="submit">Register</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

  @stop

  @section('scripts')

<script>

$(function () {

/* Register */
    $('#registration-form').submit(function (e) {
        e.preventDefault();
        var message = 'Successfully Registerd. Please loggin..';
        formSubmit($('#registration-form'), "{{ route('register.store') }}",'', e, message,false,"{{ route('login') }}");
    });



});
</script>

  <script src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>


  @stop
