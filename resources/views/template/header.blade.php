<header class="app-header navbar bg-info">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!--PONER LOGO-->
    <!--<a class="navbar-brand" href="#"></a>-->

    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link " href="#">
                <img src="https://www.decameron.com/images/logos/logo-decameron-all-inclusive.png" alt="" srcset="">
            </a>
        </li>
       
    </ul>
    <ul class="nav navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-4 nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="d-md-down-none text-white">{{ Auth::user()->names }} </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right mr-1">
                <div class="dropdown-header text-center">
                    <strong>Cuenta</strong>
                </div>

                <a class="dropdown-item" href="{{url('profile')}}"
                   onclick="event.preventDefault();
                   document.getElementById('profile-form').submit();">
                   <i class="fa fa-user text-dark"></i> Perfil
                </a>
                        
                <form id="profile-form" action="{{url('profile')}}" method="GET" style="display: none;">
                    {{csrf_field()}} 
                </form>

                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                   <i class="fa fa-sign-out text-dark"></i> {{ __('Cerrar sesión') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
</header>