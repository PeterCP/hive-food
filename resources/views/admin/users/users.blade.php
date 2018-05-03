@extends('admin.layout.layout')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_src/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">

    <!-- IzziToast -->
    <link rel="stylesheet" href="{{ asset('vendor/iziToast/css/iziToast.min.css') }}">
@endsection

@section('navbar')
    @include('admin.layout.navbar')
@endsection

@section('sidebar')
    @include('admin.layout.sidebar')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content container-fluid">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <strong style="text-transform: uppercase;">Usuarios</strong>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ URL::route('users') }}">
                            <i class="fa fa-list-ul"></i>Usuarios</a>
                    </li>
                    <li class="active">usuarios</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Aquí puedes administrar la información de los comensales.
                                </h3>
                                <div class="pull-right">
                                    <button id="displayMenuAndFormButton"
                                            class="btn btn-xs btn-success btn-flat c-font-14"
                                            data-msg="displayCreateForm">+
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <section class="box-body" id="users">

                                <table id="users_table" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>No. Cliente</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Creado</th>
                                        <th>Editar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $users)
                                        <tr>
                                            <td>{{$users->id}}</td>
                                            <td>{{$users->name}}</td>
                                            <td>{{$users->email}}</td>
                                            <td>{{$users->created_at}}</td>

                                            <td style="text-align: center">
                                                <a href="{{ url("admin/user/edit/$users->id") }}">
                                                    <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </section>



                            <section class="box-body hidden" id="create_menu">
                                <h3>Sube la información de imagen de tu nuevo comensal.</h3>
                                <!-- form start -->
                                <form role="form" method="POST" action="{{ route('user.store') }} ">
                                    {{ csrf_field() }}
                                    <div class="box-body">

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">Nombre (Max. 80 caracteres)</label>
                                                    <input type="text" class="form-control" name="name" id="name" required/>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="email">Correo</label>
                                                    <input type="email" class="form-control" required name="email" id="email"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <label for="room">Numero de habitación (opcional)</label>
                                                    <input type="text" class="form-control" name="room" id="room"/>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <label for="phone">Teléfono</label>
                                                    <input type="tel" class="form-control" required name="phone" id="phone"/>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <label for="password">Contraseña</label>
                                                    <input type="text" class="form-control" required name="password" id="password"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-block btn-success">Subir</button>
                                    </div>
                                </form>
                            </section>
                            <!-- /.box-body -->

                            <div class="container">
                                @include('admin.layout.messages')
                            </div>
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.Main content -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('footer')
    @include('admin.layout.footer')
@endsection

@section('control-bar')
    @include('admin.layout.control-bar')
@endsection

@section('scripts')

    <!-- DataTables -->
    <script src="{{ asset('admin_src/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_src/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#users_table').DataTable({
                dom: 'Bfrtipl',
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                order: [[0, "asc"]],
                info: true,
                autoWidth: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>


    <script src="{{ URL::asset('vendor/immutable.min.js') }}"></script>
    <script src="{{ URL::asset('js/admin/users/toggleSection.js') }}"></script>

    <script>
        $(document).ready(function () {

            toggleSection.update('displayUsers');

            $('#displayMenuAndFormButton').click(
                function (event) {
                    event.preventDefault();
                    const msg = document.querySelector("#displayMenuAndFormButton").dataset.msg;
                    toggleSection.update(msg);
                }
            );

        });
    </script>
@endsection