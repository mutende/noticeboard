<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/gif" sizes="16x16">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Zalego NoticeApp | @yield('title')</title>

        <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <!-- Include css files to support mdl -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="{{  URL::asset('css/w3.css')  }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap\css\material.light_blue-blue.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap\css\bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap\css\font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap\datetimepicker\build\jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap\styles.css') }}">
    <link rel="stylesheet" href="{{  URL::asset('datatables\datatables.min.css')  }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
</head>
<body>








<!-- my template -->
@if(Auth::check())



<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
  @if(!Auth::user()->status)
  <div class="container mt-5">



    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
      <h3>
        Your Account has been suspended, Kindly contact the admin
      </h3>
          @csrf
          <button class="btn btn-group-sm btn-outline-danger ml-3" type="submit">Logout</button>
      </form>
      </div>

  @else

<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
    <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">Welcome {{ Auth::user()->name }}</span>

        <div class="mdl-layout-spacer"></div>

        <!-- <span class="mdl-layout-title mr-5 "><a class=" nav-link text-secondary" href="#">Reset Password</a></span> -->
  <span class="mdl-layout-title mr-3">Role Group:<span class="text-success"> {{ Auth::user()->role->role }}</span></span>
      <span class="mdl-layout-title change">

      <form id="logout-form" action="{{ route('logout') }}" method="POST" >
            @csrf
            <button class="btn btn-group-sm btn-outline-danger ml-3" type="submit">Logout</button>
        </form>
      </span>
    </div>
</header>

<div class="demo-drawer mdl-layout__drawer logo-header-background-color">
    <header class="demo-drawer-header">
        <span>  <a href="staff-home.html" class="nav-link text-center" style="color:white;">{{ Auth::user()->email }}</a></span>
    </header>

    <nav class="demo-navigation mdl-navigation sidebar-nav-background">
        <ul id="navmenu">
          @if(Auth::user()->role_id == 1)
        <li><a href="{{ url('/')}}">View Notices</a></li>
        <li><a href="{{ route('notice.create') }}">Create Notices</a></li>
        <li><a href="{{ route('add.users') }}">Staff</a></li>
        <li><a href="{{ route('roles') }}">Roles</a></li>

        @else
          <li><a href="{{ url('/')}}">View Notices</a></li>
        @endif
          <li><a href="{{ route('user.edit.profile', Auth::user()->id )}}">Profile</a></li>

        </ul>
    </nav>
</div>


<!-- Main content goes here -->
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <div class="container-fluid">
          @include('alerts.message_alerts')
            @yield('content')



        </div>


    </div>

</main>
@endif
</div>

@else
<main class="py-4">
            <div class="container">
                    @include('alerts.message_alerts')
                    @yield('login_content')
            </div>
        </main>
@endif


     {{-- Bootstrap js --}}
<script type="text/javascript" src="{{ URL::asset('bootstrap\js\material.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bootstrap\js\main.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bootstrap\js\jquery-3.3.1.slim.min.js') }}"> jquery-3.3.1.min.js</script>
<!-- <script type="text/javascript" src="{{ URL::asset('bootstrap\js\jquery-3.3.1.min.js') }}"></script> -->


<script type="text/javascript" src="{{ URL::asset('bootstrap\js\popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bootstrap\js\bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bootstrap\datetimepicker\build\jquery.datetimepicker.full.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('datatables\datatables.min.js') }}"></script>



<script>

// $(document).ready(function() {
//     $('#table22').DataTable();
// } );

$(document).ready(function() {
    $('#alltables').DataTable();

} );
</script>

<script>


    $(function() {
    // Bootstrap DateTimePicker v4
    $('#dueDate').datetimepicker({
        format:'Y-m-d',
        inline:false,
        lang:'ru'
    });
  });

</script>


</body>
</html>
