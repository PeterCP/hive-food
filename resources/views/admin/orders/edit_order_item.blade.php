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
                    <strong style="text-transform: uppercase;">Elemenot de la orden: {{ $orderItem->order_id }}</strong>
                    <small>{{ $orderItem->name }}</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('all_orders') }}">
                            <i class="fa fa-dashboard"></i> Ordenes</a>
                    </li>
                    <li class="active">{{ $orderItem->name }}</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Aquí puedes editar el elemento de tu orden.</h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">
                                <h3>Edita el elmento de la orden: {{ $orderItem->dish_name }}</h3>
                                <!-- form start -->
                                <form role="form" method="POST" action="{{ route('orderItem.update', $orderItem->id) }}"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">Nombre (Max. 80 caracteres)</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                           required value="{{ $orderItem->dish_price }}"/>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="price">Precio</label>
                                                    <input type="number" step="0.01" min="0" max="150"
                                                           class="form-control" required name="price" id="price"
                                                           value="{{ $orderItem->dish_quantity }}"/>
                                                </div>
                                            </div>
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

                        <pre>
                            {{ print_r($orderItem) }}
                        </pre>


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