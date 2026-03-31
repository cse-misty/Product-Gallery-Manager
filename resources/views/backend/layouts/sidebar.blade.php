<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="m-auto pb-2 text-center border-bottom">
            <a href="{{ route('dashboard') }}"> <img alt="image"
                    src="{{ asset('backend') }}/img/logo_sidbar.png" class="header-logo py-1"
                    style="height:60px; width:100px;" />
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ Route('dashboard') }}" class="nav-link"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>




            <li class="dropdown {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}" class="nav-link">
                    <i class="fas fa-box"></i><span>Products</span>
                </a>
            </li>




            <li class="dropdown">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-lock"></i> {{ __('Log Out') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </aside>
</div>
