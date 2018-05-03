@extends('admin.layout.layout')

@section('styles')
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
                    <strong style="text-transform: uppercase;">Historial</strong>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ URL::route('prepayments') }}">
                            <i class="fa fa-list-ul"></i>Prepagos</a>
                    </li>
                    <li class="active">historial</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Aquí puedes ver el historial del los registros de los prepagos.
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <section class="box-body">
                                <table id="history" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No. Cliente</th>
                                            <th>Cambio</th>
                                            <th>Fecha de Registro</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($history as $entry)
                                        <tr>
                                            <td>{{$entry->user_id}}</td>
                                            <td>{{$entry->number}}</td>
                                            <td>{{$entry->created_at}}</td>
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

    <script>
        $(document).ready(function () {
            $("#history").DataTable({
                dom: 'Bfrtipl',
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                order: [[2, "desc"]],
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
@endsection