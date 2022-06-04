@extends('layouts.app')

@section('css')

    <style>
        .container nav {
            margin-top: 1%;
            margin-bottom: 1%;
            float: right;
        }

        form {
            margin-bottom: 1%;
        }

        #search button {
            line-height: 1.5;
            padding: 4px 12px;
            margin-left: -8px;
            background-color: #212529;
        }


    </style>

@stop

@section('content')


    <div class="album py-5 bg-light">
        <div class="container">

            <form action="{{ route('dashboard') }}" method="GET" id="search">
                <div class="row">
                    <div class="form-group col-md-4">
                    </div>
                        <div class="form-group col-md-3">
                        <input type="text" placeholder="Name or Description " class="form-control" name="search" id="search"
                            value="{{ request()->get('search') }}">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" placeholder="Start Date" class="form-control js-datepicker" name="start_date"
                            id="start_date" value="{{ request()->get('start_date') }}">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" placeholder="End Date" class="form-control js-datepicker" name="end_date"
                            id="end_date" value="{{ request()->get('end_date') }}">
                    </div>
                    <div class="form-group col-md-1">
                        <button type="submit" class="btn btn-primary" style="">Search</button>
                    </div>
                </div>
            </form>


            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($events as $event)
                    <div class="col">
                        <div class="card shadow-sm">
                            {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>{{ $event->name }}</title>
                                <rect width="100%" height="100%" fill="#55595c" />
                                <text x="39%" y="48%" fill="#eceeef" dy=".3em">Thumbnail</text>
                            </svg> --}}
                            <div class="card-body">
                                <h5 class="card-title">{{ ucwords($event->name) }}</h5>
                                <p class="card-text" style="color: #565b60;">
                                    @if ($event->description)
                                        {{ substr($event->description, 0, 216) }}
                                    @endif
                                </p>
                                <div class="d-flex justify-content-between align-items-center" style="margin-top: 2%;">
                                    <small class="text-muted">From :
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('M d Y') }}</small>
                                    <small class="text-muted">To :
                                        {{ \Carbon\Carbon::parse($event->end_date)->format('M d Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $events->appends($params)->links() }}
        </div>
    </div>


@stop

@section('scripts')


@stop
