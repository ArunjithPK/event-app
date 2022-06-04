@extends('layouts.app')

@section('css')
    <style>

    </style>

@stop

@section('content')

    <div class="page-wrapper p-t-30 p-b-100 font-poppins">
        <div class="wrapper wrapper--w700">
            <h3 style="">Reports</h3>
            <div class="card card-6">
                <div class="card-body">
                    <h4 style=""> 1. Event Created Wise Report</h4>
                    <table class="table table-bordered" id="event-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Event Counts</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td> {{ $key + 1 }}</td>
                                    <td> {{ $user->first_name.' '.$user->last_name }}</td>
                                    <td> {{ $user->event_count }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th>Total</th>
                                <th> {{ count($users) }}</th>
                                <th> {{ $users->sum('event_count') }} </th>
                            </tr>
                            <tr>
                                <th colspan="2">Average events count created by the users</th>
                                <th>{{ round($users->avg('event_count'), 2) }} </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-6" style="margin-top: 1%;">
                <div class="card-body">
                    <h4 style=""> 1. Event's Invited Wise Report</h4>
                    <table class="table table-bordered" id="event-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Events</th>
                                <th>User Counts</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $key => $event)
                                <tr>
                                    <td> {{ $key + 1 }}</td>
                                    <td> {{ $event->name }}</td>
                                    <td> {{ $event->invites_count }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th>Total</th>
                                <th> {{ count($events) }}</th>
                                <th> {{ $events->sum('invites_count') }} </th>
                            </tr>
                            <tr>
                                <th colspan="2">Average users invited to the events</th>
                                <th>{{ round($events->avg('invites_count'), 2) }} </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>



@stop

@section('scripts')

    <script>
        $(function() {

        });
    </script>


@stop
