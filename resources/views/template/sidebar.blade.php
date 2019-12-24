<div class="sidebar bg-dark">
    <nav class="sidebar-nav">
        <ul class="nav">

        @if(Auth::user()->role_id !=1 )
            <li class="nav-item">
                    <a class="nav-link" href="{{url('home')}}" onclick="event.preventDefault(); document.getElementById('home-form').submit();"><i class="icon-speedometer"></i> Dashboard</a>
                    
                    <form id="home-form" action="{{url('home')}}" method="GET" style="display: none;">
                    {{csrf_field()}} 
                    </form>
            </li>
            <li class="nav-title">
                Menú
            </li>

        
            <li class="nav-item">
                    <a class="nav-link" href="{{url('categories')}}" onclick="event.preventDefault(); document.getElementById('categories-form').submit();"><i class="fa fa-list"></i> Categorías</a>
                    
                    <form id="categories-form" action="{{url('categories')}}" method="GET" style="display: none;">
                    {{csrf_field()}} 
                    </form>
            </li>
            
            <li class="nav-item">
                    <a class="nav-link" href="{{url('products')}}" onclick="event.preventDefault(); document.getElementById('products-form').submit();"><i class="fa fa-shopping-basket"></i> Productos</a>
                    
                    <form id="products-form" action="{{url('products')}}" method="GET" style="display: none;">
                    {{csrf_field()}} 
                    </form>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{url('orders')}}" onclick="event.preventDefault(); document.getElementById('orders-form').submit();"><i class="fa fa-shopping-basket"></i> Ordenes</a>
                
                <form id="orders-form" action="{{url('orders')}}" method="GET" style="display: none;">
                    {{csrf_field()}} 
                </form>
            </li>         


            <li class="nav-item">
                    <a class="nav-link" href="{{url('pubs')}}" onclick="event.preventDefault(); document.getElementById('pubs-form').submit();"><i class="fa fa-indent" aria-hidden="true"></i> Bares</a>
                    
                    <form id="pubs-form" action="{{url('pubs')}}" method="GET" style="display: none;">
                    {{csrf_field()}} 
                    </form>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{url('stocks')}}" onclick="event.preventDefault(); document.getElementById('stocks-form').submit();"><i class="fa fa-line-chart" aria-hidden="true"></i> Stock Ideal</a>
                
                <form id="stocks-form" action="{{url('stocks')}}" method="GET" style="display: none;">
                {{csrf_field()}} 
                </form>
            </li>
                
        @else
            <li class="nav-item">
                    <a class="nav-link" href="{{url('users')}}" onclick="event.preventDefault(); document.getElementById('users-form').submit();"><i class="fa fa-user"></i> Usuarios</a>
                    
                    <form id="users-form" action="{{url('users')}}" method="GET" style="display: none;">
                    {{csrf_field()}} 
                    </form>
            </li>

            <li class="nav-item">
                    <a class="nav-link" href="{{url('roles')}}" onclick="event.preventDefault(); document.getElementById('roles-form').submit();"><i class="fa fa-users" aria-hidden="true"></i> Roles</a>
                    
                    <form id="roles-form" action="{{url('roles')}}" method="GET" style="display: none;">
                    {{csrf_field()}} 
                    </form>
            </li>
        @endif
                         
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>