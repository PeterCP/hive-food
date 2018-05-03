@extends('admin.layout.layout')

@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin_src/select2/dist/css/select2.min.css') }}">
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
                    <strong style="text-transform: uppercase;">Menu</strong>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ URL::route('menu') }}">
                            <i class="fa fa-cutlery"></i> Menu</a>
                    </li>
                    <li class="active">Menu</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Aquí puedes administrar tus platillos dispolnibles en el menu.
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <section class="box-body" id="dishes">

                                <div class="row">
                                    @foreach($menu as $dish)
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="text-center" style="padding: 30px;">
                                                <img src="{{ URL::asset('uploads/dishes/' . $dish->image) }}"
                                                     style="text-align: center; margin: 0 auto;"
                                                     width="70%">
                                                <h3>{{ str_limit($dish->name, $limit = 50, $end = '...') }}</h3>
                                                <h4>${{$dish->price}}</h4>

                                                <a style="text-align: center; margin: 5px auto;"
                                                   href="{{ url("admin/menu/remove/$dish->id") }}"
                                                   class="btn btn-danger btn-flat form-control">
                                                    <span class="glyphicon glyphicon-trash"></span> Remover del ménu
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="col-xs-12">
                                        <!-- form start -->
                                        <form role="form" method="POST" action="{{ url('admin/menu/add') }} "
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="box-body">
                                                <label>Elige de los platillos disponibles para agregarlos al
                                                    menu.</label>
                                                <select class="select2" required name="dishes[]"
                                                        multiple="multiple" data-placeholder="Platillos"
                                                        style="width: 100%;" required>
                                                    @foreach($available_dishes as $dish)
                                                        <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-block btn-primary">Agregar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

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
    <!-- Select2 -->
    <script src="{{ asset('admin_src/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection