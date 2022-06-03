@extends('layouts.app')

@section('css')
<link href="{{ asset('js/plugins/datepicker/daterangepicker.css') }}" rel="stylesheet">
@stop

@section('content')

<div class="page-wrapper p-t-20 p-b-100 font-poppins">
    <div class="wrapper wrapper--w680">
        <div class="card card-4">
            <div class="card-body">
                <h2 class="title">Login Form</h2>
                {{ Form::open(array('url'=> "#",'id'=>'login-form','class'=>'form-horizontal', 'method'=> 'POST')) }}

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
                        <div class="col-12">
                            <div class="input-group" id="password">
                                <label class="label">Password</label>
                                <input class="input--style-4" type="password" name="password">
                                <small class="help-block"></small>
                            </div>
                        </div>
                    </div>

                    <div class="p-t-15">
                        <button class="btn btn--radius-2 btn--blue" type="submit">Login</button>
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

    $('#login-form').submit(function (e) {
        e.preventDefault();
        var message = 'Successfully logged in.';
        formSubmit($('#login-form'), "{{ route('login.triger') }}",'', e, message,false,"{{ route('dashboard') }}");
    });

    // function formSubmit($form, url, e, message) {
    //     var $form = $form;
    //     var url = url;
    //     var e = e;
    //     var formData = new FormData($form[0]);
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: url,
    //         type: 'POST',
    //         data: formData,
    //         success: function (data) {
    //             if (data.success) {
    //                 swal("Saved", message, "success");
    //                 // $("#myModal").modal('hide');
    //             } else {
    //                 console.log(data);
    //             }
    //         },
    //         fail: function (response) {
    //             console.log('Unknown error');
    //         },
    //         error: function (xhr, textStatus, thrownError) {
    //             associate_errors(xhr.responseJSON.errors, $form);
    //         },
    //         contentType: false,
    //         processData: false,
    //     });
    // }

});
</script>

  <script src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>


  @stop
