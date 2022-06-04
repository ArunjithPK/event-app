@extends('layouts.app')

@section('css')
    <link href="{{ asset('js/plugins/datepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .p-t-30 {
            padding-top: 50px !important;
        }

        h3 {
            margin-bottom: 2%;
        }

        .create-btn {
            height: 40px !important;
            line-height: 0px !important;
            padding: 0 10px !important;
            font-size: 14px !important;
        }

        .daterangepicker select.yearselect {
            width: 46%;
        }

        .edit {
            margin: 0% 21% 0% 28%;
            font-size: 17px;
        }

        .delete {
            /* margin: 0% 21% 0% 28%; */
            font-size: 17px;
        }

    </style>

@stop

@section('content')

    <div class="page-wrapper p-t-30 p-b-100 font-poppins">
        <div class="wrapper wrapper--w700">
            <div class="card card-6">
                <div class="card-body">
                    <h3 style="float: left">{{ $event->name }} : Users List</h1>
                        <button type="button" class="btn btn-primary create-btn pull-right add-new" data-toggle="modal"
                            data-target="#myModal">Add New</button>
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Invited At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                        </table>
                </div>
            </div>
        </div>
    </div>


      <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="width: 550px;">
                <div class="modal-header">
                    <h4 class="modal-title" style="width: 80%; margin-left: -9%;">Events</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                {{ Form::open(['url' => '#', 'id' => 'form', 'class' => '', 'method' => 'POST']) }}
                {{ Form::hidden('event_id', null) }}
                    <div class="modal-body">
                        <div class="input-group form-group" id="name">
                            <label for="name">Email:</label>
                            <input type="email" name="email" class="form-control" >
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>


@stop

@section('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="  https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {

            eventId = {{ $event->id }};
            $.fn.dataTable.ext.errMode = 'throw';
            try {
                let id ={{ $event->id }};
                let base_url = "{{ route('event.invited-users.data', ':id') }}";
                let url = base_url.replace(':id', id);

                table = $('#table').DataTable({
                    ajax: {
                        "url":url,
                        "error": function(xhr, textStatus, thrownError) {
                            if (xhr.status === 401) {
                                window.location = "{{ route('login') }}";
                            }
                        }
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: '',
                            sortable: false
                        },
                        {
                            data: 'user.full_name',
                            name: 'user.full_name',
                        },
                        {
                            data: 'user.email',
                            name: 'user.email',
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: null,
                            orderable: false,
                            render: function(o) {
                                var actions = "";
                                actions += '<a href="#" class="delete fa fa-trash" data-id=' + o.id + '></a>';
                                return actions;
                            },
                        }
                    ]
                });
            } catch (e) {
                console.log(e.stack);
            }

            /// Delete
            $('#table').on('click', '.delete', function(e) {
                var id = $(this).data('id');
                var base_url = "{{ route('event.invited-users.destroy', ':id') }}";
                var url = base_url.replace(':id', id);
                var message = 'Invited user has been deleted successfully';
                deleteServiceRecord(url, table, message);
            });

             // On modal click
             $('.add-new').click(function() {
                $("#form")[0].reset();
                $('#myModal input[name="event_id"]').val(eventId);
                $('#form').find('.form-group').removeClass('has-error').find('.help-block').text('');
                $('#myModal .modal-title').text("Event's User Invite")
            });

            // Form submit
            $('#form').submit(function(e) {
                e.preventDefault();
                var message = 'Successfully invited';
                var base_url = "{{ route('event.invited-users.page', ':id') }}";
                var url = base_url.replace(':id', eventId);
                formSubmit($('#form'), "{{ route('event.invited-users.store') }}", table, e, message, true,url);
            });

        });
    </script>


@stop
