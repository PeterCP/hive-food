@extends('admin.layout.layout')

@section('styles')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('admin_src/iCheck/flat_all.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_src/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
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
                    <strong style="text-transform: uppercase;">Ordenes</strong>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ URL::route('all_orders') }}">
                            <i class="fa fa-list-ul"></i> Ordenes</a>
                    </li>
                    <li class="active">ordenes</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    {{ $message }}
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <section class="box-body">

                                <table id="orders_table" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Cliente</th>
                                        <th>Platillos</th>
                                        <th>Creada</th>
                                        <th>Subtotal</th>
                                        <th>Descuento</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        {{--
                                        <th>Editar</th>
                                        --}}
                                        <th>Eliminar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->username}}</td>

                                            <td>
                                                @foreach($platillos["order_id_$order->id"] as $platillo)
                                                    {{ $platillo->dish_name }} ({{ $platillo->dish_quantity }}),
                                                @endforeach
                                            </td>

                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->subtotal}}</td>
                                            <td>{{$order->discount}}</td>
                                            <td>{{$order->total}}</td>

                                            <td style="text-align: center">
                                                <select class="cambioEstado" data-id="{{$order->id}}">
                                                    <option value="pending"   {{ $order->state == 'pending'   ? 'selected' : '' }}>Pendiente</option>
                                                    <option value="ready"     {{ $order->state == 'ready'     ? 'selected' : '' }}>Lista</option>
                                                    <option value="delivered" {{ $order->state == 'delivered' ? 'selected' : '' }}>Entregada</option>
                                                </select>
                                            </td>

                                            {{--
                                            <td style="text-align: center">
                                                <a href="{{ url("admin/order/edit/$order->id") }}">
                                                    <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            --}}

                                            <td style="text-align: center">
                                                <a href="javascript:void(0);" class="btn btn-default btn-flat"
                                                   onclick="event.preventDefault(); document.getElementById('delete-form-{{ $order->id }}').submit();">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                                <form id="delete-form-{{ $order->id }}"
                                                      action="{{ route('order.destroy', $order->id) }}"
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
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('admin_src/iCheck/icheck.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#orders_table').DataTable({
                dom: 'Bfrtipl',
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                order: [[3, "desc"]],
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('.cambioEstado').on('change',
                function (event) {
                    const state = $(this).find(":selected").val();
                    const id = $(this).data('id');
                    window.location = '{{ url("admin/order/changeStatus") }}' + '/' + id + '/' + state;
                }
            );
        });
    </script>
@endsection