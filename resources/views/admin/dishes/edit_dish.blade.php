@extends('admin.layout.layout')

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
                    <strong style="text-transform: uppercase;">Platillo:</strong>
                    <small>{{ $dish->name }}</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ url('admin/platillos') }}">
                            <i class="fa fa-dashboard"></i> Platillos</a>
                    </li>
                    <li class="active">{{ $dish->name }}</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Aquí puedes editar tu platillo.</h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">
                                <h3>Edita tu imagen</h3>
                                <!-- form start -->
                                <form role="form" method="POST" action="{{ route('dish.update', $dish->id) }}"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">Nombre (Max. 80 caracteres)</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                           required value="{{ $dish->name }}"/>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="price">Precio</label>
                                                    <input type="number" step="0.01" min="0" max="150"
                                                           class="form-control" required name="price" id="price"
                                                           value="{{ $dish->price }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Descripción (Max. 250 caracteres)</label>
                                            <textarea class="form-control" name="description" id="description" required
                                                      cols="30">{{ $dish->description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Imagen</label>
                                            <input type="file" name='image' id='image'>
                                            <p class="help-block">El peso de la imagen afectara gravemente el tiempo de
                                                carga de la pagina. Recomendamos
                                                <a href="https://compressor.io">Compressor</a> para aligerar tus
                                                imagenes (maximo 2Mb).</p>
                                            <li>Dimensiones: 500 X 500.</li>
                                            <li>Las imagenes seran escaladas a esta dimensión.</li>
                                            <li>Formato: Solo PNG, JPG y JPEG.</li>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-block btn-success">Subir</button>
                                    </div>
                                </form>
                            </div>

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