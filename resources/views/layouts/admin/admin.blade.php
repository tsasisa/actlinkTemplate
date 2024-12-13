<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('assets/style.css')}}" rel="stylesheet">
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
  <div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">MyAdmin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
          aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">

        {{-- @auth('admin') --}}
            <ul class="navbar-nav side-nav">
              <li class="nav-item">
                <a class="nav-link text-white {{request()->is('/')? 'text-light' : 'text'}}" style="margin-left: 20px;" href="{{route('admin.home')}}">Dashboard
                  {{-- <span class="sr-only">(current)</span> --}}
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->is('admin-events')? 'text-light' : 'text-normal'}}" href="{{route('admin.events')}}" style="margin-left: 20px;">Events</a>
              </li>
             
              <li class="nav-item">
                  <a class="nav-link {{request()->is('admin/organizers') ? 'text-light' : 'text-normal'}}" href="{{route('admin.organizers')}}" style="margin-left: 20px;">Organizations</a>
              </li>

              <li class="nav-item">
                  <a class="nav-link {{request()->is('admin/members') ? 'text-light' : 'text-normal'}}" href="{{route('admin.members.indexMember')}}" style="margin-left: 20px;">Members</a>
              </li>
       
          
            </ul>
        {{-- @endauth --}}
          <ul class="navbar-nav ml-md-auto d-md-flex">

            {{-- @auth('admin') --}}
        <li class="nav-item">
          <a class="nav-link" href="#">Home
          <span class="sr-only">(current)</span>
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          {{-- {{ Auth::guard('admin')->user()->name }} --}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#" onclick=" event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="#" method="POST" class="d-none">
            @csrf

          </form>

      {{-- @else
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">login
      <span class="sr-only">(current)</span>
      </a>
    </li> --}}
  {{-- @endauth --}}


          </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid">

      <main class="py-4">
        @yield('content')
      </main>

    </div>
  </div>
  </div>
  <script type="text/javascript">

  </script>
</body>

</html>
