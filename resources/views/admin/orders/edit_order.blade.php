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
                    <strong style="text-transform: uppercase;">Editar Ordern</strong>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('all_orders') }}">
                            <i class="fa fa-dashboard"></i> Ordenes</a>
                    </li>
                    <li class="active">{{ $order->id }}</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Aquí puedes editar la orden {{ $order->id }} | {{ $order->created_at }}.</h3>
                            </div>
                            <!-- /.box-header -->

                            <section class="box-body">

                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Platillo</th>
                                        <th>Cantidad</th>
                                        <th>P. Unitario</th>
                                        <th>Subtotal</th>
                                        <th>Descuento</th>
                                        <th>Total</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dishes as $dish)
                                            <tr>
                                                <td>{{ $dish->dish_name }}</td>
                                                <td>{{ $dish->dish_quantity }}</td>
                                                <td>{{ $dish->dish_price }}</td>
                                                <td>{{ $dish->subtotal }}</td>
                                                <td>{{ $dish->discount }}</td>
                                                <td>{{ $dish->total }}</td>

                                                <td style="text-align: center">
                                                    <a href="{{ url("admin/orderItem/edit/$dish->id") }}">
                                                        <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                                                    </a>
                                                </td>

                                                <td style="text-align: center">
                                                    <a href="javascript:void(0);" class="btn btn-default btn-flat"
                                                       onclick="event.preventDefault(); document.getElementById('delete-form-{{ $dish->id }}').submit();">
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </a>
                                                    <form id="delete-form-{{ $dish->id }}"
                                                          action="{{ route('orderItem.destroy', $dish->id) }}"
                                                          style="display: none;" method="POST">
                                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </section>
                            <!-- /.box-body -->
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