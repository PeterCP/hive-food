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
                    <strong style="text-transform: uppercase;">Platillos</strong>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ URL::route('menu') }}">
                            <i class="fa fa-cutlery"></i> Menu</a>
                    </li>
                    <li class="active">Platillos</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Aquí puedes administrar tus platillos dispolnibles para usarse en el menu.
                                </h3>
                                <div class="pull-right">
                                    <button id="displayMenuAndFormButton"
                                            class="btn btn-xs btn-success btn-flat c-font-14"
                                            data-msg="displayCreateForm">+
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <section class="box-body" id="dishes">

                                <div class="row">
                                    @foreach($dishes as $dish)
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="text-center" style="padding: 30px;">
                                                <img src="{{ URL::asset('uploads/dishes/' . $dish->image) }}" style="text-align: center; margin: 0 auto;"
                                                     width="70%">
                                                <h3>{{ str_limit($dish->name, $limit = 50, $end = '...') }}</h3>
                                                <h4>${{$dish->price}}</h4>

                                                <a style="text-align: center; margin: 5px auto;"
                                                   href="{{ url("admin/dish/edit/$dish->id") }}"
                                                   class="btn btn-success btn-flat form-control">Editar</a>

                                                <a style="text-align: center; margin: 5px auto;"
                                                   href="javascript:void(0);"
                                                   class="btn btn-danger btn-flat form-control"
                                                   onclick="event.preventDefault();
                                                           document.getElementById('delete-form-{{ $dish->id }}').submit();">
                                                    <span class="glyphicon glyphicon-trash"></span> Eliminar
                                                </a>

                                                <form id="delete-form-{{ $dish->id }}"
                                                      action="{{ route('dish.destroy', $dish->id) }}"
                                                      style="display: none;" method="POST">
                                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </section>

                            <section class="box-body hidden" id="create_menu">
                                <h3>Sube la información de imagen de tu nuevo platillo</h3>
                                <!-- form start -->
                                <form role="form" method="POST" action="{{ route('dish.store') }} " enctype="multipart/form-data">
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
                                                    <label for="price">Precio</label>
                                                    <input type="number" step="0.01" min="0" max="150" class="form-control" required name="price" id="price"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="description">Descripción (Max. 250 caracteres)</label>
                                            <textarea class="form-control" name="description" id="description" required cols="30"></textarea>
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
    <script src="{{ URL::asset('vendor/immutable.min.js') }}"></script>
    <script src="{{ URL::asset('js/admin/dishes/toggleSection.js') }}"></script>

    <script>
        $(document).ready(function () {

            toggleSection.update('displayMenu');

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