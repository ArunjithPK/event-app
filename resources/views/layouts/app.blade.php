<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{  config('app.name', 'Event App')}} </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="{{ asset('js/plugins/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/datepicker/daterangepicker.css') }}" rel="stylesheet">

    <style>


    </style>
    @yield('css')

<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container">
        <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center" >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
          <strong>Events App</strong>
        </a>
        <nav class="nav" >
            <a href="{{ route('dashboard') }}" class="nav-link active text-white">Home</a>
            <a href="{{ route('event.reports.page') }}" class="nav-link active text-white">Reports</a>
            @if(Auth::user())
                <a href="{{ route('event.page') }}" class="nav-link active text-white">My Events</a>
                <a href="#" id="logout" class=" nav-link active text-white">Log Out</a></li>
                <a href="#" id="" class=" nav-link active text-white">Hi, {{substr(Auth::user()->first_name, 0, 10)}}</a></li>
            @else
                <a href="{{ route('login') }}" class=" nav-link active text-white">Login</a>
                <a href="{{ route('register.page') }}" class="nav-link active text-white">Register</a>
            @endif

        </nav>
      </div>
    </div>
  </header>

<body>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"  integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('js/plugins/datepicker/moment.min.js') }}"></script>
<script src="{{ asset('js/plugins/datepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
<script>
  $(function() {
      $('#logout').click(function(){
        $('#logout-form').submit()
      });

  });
</script>
@yield('scripts')
</html>

