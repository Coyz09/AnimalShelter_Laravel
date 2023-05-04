<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">      
        <a class="navbar-brand" href="/front">HOME</a>
        <a class="navbar-brand" href="/animals">ANIMALS</a>
        <a class="navbar-brand" href="/adopters">ADOPTERS</a>
            <a>
              <form class="navbar-form navbar-left" method="POST" role="search" action="{{route('search')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <input type="text" name="search" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
                </a>     
     <div class="float-right">
        <div class="bg-info clearfix">
          <ul class="nav navbar-nav navbar-right">           
            <li class="dropdown">
              <a href="#" class="btn btn-info dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> User <span class="caret"></span></a>
                  <ul class="bg-info clearfix dropdown-menu">
                  @if (Auth::check())
                   @if(auth()->user()->role == 'rescuer')
                    <li><a href="{{ route('rescuer.profile') }}">User Profile</a></li>
                    @elseif(auth()->user()->role == 'adopter')
                    <li><a href="{{ route('adopter.profile') }}">User Profile</a></li>
                    @elseif(auth()->user()->role == 'personnel')
                    <li><a href="{{ route('personnel.profile') }}">User Profile</a></li>
                    @elseif(auth()->user()->role == 'user')
                    <li><a href="{{ route('user.profile') }}">User Profile</a></li>
                    @endif 
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
        <a class="bg-info clearfix navbar-brand " href="{{ route('user.adoptersignup') }}">Adopter Registration</a>
       {{--  <a class="bg-info clearfix navbar-brand " href="{{ route('user.rescuersignup') }}">Rescuer Registration</a> --}}
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>