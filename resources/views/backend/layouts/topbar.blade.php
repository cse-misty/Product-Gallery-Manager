<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar"
                            class="nav-link nav-link-lg
                          collapse-btn"> <i
                                data-feather="align-justify"></i></a></li>
                    <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a></li>

                </ul>
            </div>
            <ul class="navbar-nav navbar-right">
                
                <li class="dropdown"><a href="#" data-toggle="dropdown"
                        class="nav-link dropdown-toggle nav-link-lg nav-link-user">




                        <img alt="image" src="{{ asset('images/user_defult.png') }}"
                            style="border-radius: 50%; height: 30px; width: 30px;" class="user-img-radious-style">


                        <span class="d-sm-none d-lg-inline-block"></span></a>
                    <div class="dropdown-menu dropdown-menu-right pullDown">
                        <div class="dropdown-title">{{ Auth::user()->name }}</div>

                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link class="dropdown-item d-flex align-items-center" :href="route('logout')"
                                onclick="event.preventDefault();
                                              this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
