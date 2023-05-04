<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
     {{--  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button> --}}
        <a class="navbar-brand" href="/dashboard">Dashboard</a>
        <a class="navbar-brand" href="/animal">Animal</a>
        <a class="navbar-brand" href="/adopter">Adopter</a>
        <a class="navbar-brand" href="/personnel">Personnel</a>
        <a class="navbar-brand" href="/rescuer">Rescuer</a>
        <a class="navbar-brand" href="/injury">Injury/Disease</a>
        <a class="navbar-brand" href="/customer">Customer Emails</a>
              
        <div class=" float-right">
          <div class="bg-info clearfix">
            <ul class="nav navbar-nav navbar-right">
               {{-- <li>
              <form class="navbar-form navbar-left" method="POST" role="search" action="{{route('search')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <input type="text" name="search" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
                </li> --}}
              
        <li class="dropdown">
        {{--   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> User Account <span class="caret"></span></a> --}}
          <a href="#" class="btn btn-info dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> Admin <span class="caret"></span></a>
         
            <ul class="bg-info clearfix dropdown-menu">
            @if (Auth::check())
              <li><a href="{{ route('admin.show') }}">Admin Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('user.logout') }}">Logout</a></li>
            @else
              <li><a href="{{ route('user.signup') }}">Signup</a></li>
              <li><a href="{{ route('user.signin') }}">Login</a></li>
            @endif 
            </ul>
      </li>
    </ul>
  </div>
</div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>