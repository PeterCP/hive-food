<!--========== HEADER TRANSPARENT WITH LOGIN ==========-->
<header class="header-transparent header-transparent-bb navbar-fixed-top header-sticky">
    <!-- Navbar -->
    <nav class="navbar mega-menu" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="toggle-icon"></span>
                </button>

                <!-- Logo -->
                <div class="navbar-logo">
                    <a class="navbar-logo-wrap" href="{{ url('comensal') }}">
                        <img class="navbar-logo-img navbar-logo-img-white" src="{{ URL::asset('images/logo_text.png') }}"
                             alt="Hive">
                        <img class="navbar-logo-img navbar-logo-img-dark" src="{{ URL::asset('images/logo_text.png') }}">
                    </a>
                </div>
                <!-- End Logo -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-collapse">
                <div class="menu-container">
                    <ul class="nav navbar-nav">

                        <!-- Login -->
                        <li class="nav-item form-modal-nav">
                            <a id="logout-button" class="nav-item-child form-modal-login radius-3" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                        </li>
                        <!-- End Login -->

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </ul>
                </div>
            </div>
            <!-- End Navbar Collapse -->
        </div>
        <!--/container-->
    </nav>
    <!-- Navbar -->
</header>
<!--========== END HEADER TRANSPARENT WITH LOGIN ==========-->
