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
                    <li class="active">editar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Aquí puedes editar la información de tu comensal.
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <section class="box-body">
                                <h3>Edita la información de: {{ $user->name }}</h3>
                                <!-- form start -->
                                <form role="form" method="POST" action="{{ route('user.update', $user->id) }} " enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="box-body">

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">Nombre (Max. 80 caracteres)</label>
                                                    <input type="text" class="form-control" name="name" id="name" required value="{{ $user->name }}"/>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="email">Correo</label>
                                                    <input type="email" class="form-control" required name="email" id="email" value="{{ $user->email }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <label for="room">Numero de habitación (opcional)</label>
                                                    <input type="text" class="form-control" name="room" id="room" value="{{ $user->room }}"/>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <label for="phone">Teléfono</label>
                                                    <input type="tel" class="form-control" required name="phone" id="phone" value="{{ $user->phone }}"/>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <label for="password">Contraseña</label>
                                                    <input type="text" class="form-control" name="password" id="password"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-block btn-success">Guardar</button>
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