<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('admin_src/admin-lte/dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Hive Food</p>
                <!-- Status -->
                <a href="#">
                    <i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-cutlery"></i>
                    <span>Menu</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ URL::route('dishes') }}">Platillos</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/menu') }}">Editar Menu</a>
                    </li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>Ordenes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ URL::route('today_orders') }}">Hoy</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('this_month_orders') }}">Este Mes</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('six_month_orders') }}">Seis Meses</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('all_orders') }}">Todas</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>Prepagos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ url('admin/prepagos') }}">Comidas</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/efectivo') }}">Efectivo</a>
                    </li>
                </ul>
            </li>

            {{--
            <li>
                <a href="{{ url('admin/fidelidad') }}">
                    <i class="fa fa-check-circle"></i>
                    <span>Fidelidad</span>
                </a>
            </li>
            --}}

            <li>
                <a href="{{ url('admin/estadisticas') }}">
                    <i class="fa fa-bar-chart"></i>
                    <span>Estadisticas</span>
                </a>
            </li>

            <li>
                <a href="{{ url('admin/usuarios') }}">
                    <i class="fa fa-user"></i>
                    <span>Usuarios</span>
                </a>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>