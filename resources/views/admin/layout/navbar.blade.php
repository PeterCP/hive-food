<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('') }}" target="blank" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <b>H.</b>F.</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <b>Hive</b> Food</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" id="profile-toggle" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ asset('admin_src/admin-lte/dist/img/avatar5.png') }}" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">Hive Food</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ asset('admin_src/admin-lte/dist/img/avatar5.png') }}" class="img-circle" alt="User Image">

                            <p>
                                Hive Food
                                <small>Administador</small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                {{--
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                --}}
                            </div>
                            <div class="center">
                                <a id="logout-button" href="{{ route('logout') }}" class="btn btn-flat btn-info"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sessión</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
                {{--
                <!-- Control Sidebar Toggle Button -->
                <li>
                <a href="#" data-toggle="control-sidebar">
                <i class="fa fa-gears"></i>
                </a>
                </li>
                --}}
            </ul>
        </div>
    </nav>
</header>