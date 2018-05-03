@extends('admin/layout') @section('styles')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('admin_src/iCheck/flat_all.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_src/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin_src/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}"> @endsection @section('navbar') @include('admin/navbar') @endsection @section('sidebar') @include('admin/sidebar') @endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <strong style="text-transform: uppercase;">{{ $pagina }}</strong>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin/banner/' . $pagina)  }}">
                        <i class="fa fa-dashboard"></i> Banners</a>
                </li>
                <li class="active">{{ $pagina }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Aquí puedes administrar el slide del banner de la página de:
                                <strong>{{ $pagina }}</strong>
                            </h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <h3>Edita tu slide.</h3>
                            <!-- form start -->
                            <form role="form" method="POST" action="{{ route('slide.update', $slide->id) }} " enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="titulo">Alt. Text (Max. 50 caracteres)</label>
                                        <textarea class="form-control" name="titulo" id="titulo" cols="30">{{$slide->titulo}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Descripción (Max. 100 caracteres)</label>
                                        <textarea class="form-control" name="descripcion" id="descripcion" cols="30">{{$slide->descripcion}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <input type="file" name='imagen' id='imagen'>
                                        <p class="help-block">El peso de la imagen afectara gravemente el tiempo de carga de la pagina. Recomendamos
                                            <a href="https://compressor.io">Compressor</a> para aligerar tus imagenes (maximo 2Mb).</p>
                                        <li>Dimensiones: 1500 X 535.</li>
                                        <li>Formato: Solo PNG, JPG y JPEG.</li>
                                        <li>Los textos se mostraran encima del banner.</li>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-block btn-success">Subir</button>
                                </div>
                            </form>
                        </div>

                        <!-- /.box-body -->

                        <div class="container">
                            @include('admin.messages')
                        </div>
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection @section('footer') @include('admin/footer') @endsection @section('control-bar') @include('admin/control-bar')
@endsection