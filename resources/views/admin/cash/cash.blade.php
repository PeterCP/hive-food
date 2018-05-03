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
                    <strong style="text-transform: uppercase;">Efectivo</strong>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ URL::route('cash') }}">
                            <i class="fa fa-list-ul"></i>Prepagos</a>
                    </li>
                    <li class="active">Efectivo</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Aquí puedes administrar el efectivo prepagado de los comensales.
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <section class="box-body">

                                <table id="users_table" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>No. Cliente</th>
                                        <th>Nombre</th>
                                        <th>Efectivo Disponibles</th>
                                        <th>Disminuir Efectivo</th>
                                        <th>Aumentar Efectivo</th>
                                        <th>Ver Historial</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <td>{{$client->id}}</td>
                                            <td>{{$client->name}}</td>
                                            <td style="text-align: center">{{$client->cash}}</td>

                                            @if($client->cash > 0)
                                                <td style="text-align: center">
                                                    <a href="#"
                                                       class="btn btn-md btn-danger btn-flat c-font-14 reducePrepayment"
                                                       data-username="{{$client->name}}" data-userid="{{$client->id}}">
                                                        Disminur
                                                    </a>
                                                </td>
                                            @else
                                                <td style="text-align: center">
                                                    <a href="#"
                                                       class="btn btn-md btn-default btn-flat c-font-14"
                                                       data-username="{{$client->name}}" data-userid="{{$client->id}}">
                                                        Disminur
                                                    </a>
                                                </td>
                                            @endif



                                            <td style="text-align: center">
                                                <a href="#"
                                                   class="btn btn-md btn-success btn-flat c-font-14 addPrepayment"
                                                   data-username="{{$client->name}}" data-userid="{{$client->id}}">
                                                    Añadir
                                                </a>
                                            </td>

                                            <td style="text-align: center">
                                                <a href="{{ url("admin/cash/history/$client->id") }}"
                                                   class="btn btn-md btn-primary btn-flat c-font-14">
                                                    Historial
                                                </a>
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

    <script>
        $(document).ready(function () {
            $('#users_table').DataTable({
                dom: 'Bfrtipl',
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                order: [[3, "desc"]],
                info: true,
                autoWidth: true,
                responsive: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>


    <!-- IzziToast -->
    <script src="{{ asset('vendor/iziToast/js/iziToast.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('.reducePrepayment').on('click', function (event) {
                event.preventDefault();
                let username = $(this).data('username');
                let userId = $(this).data('userid');

                iziToast.warning({
                    rtl: false,
                    layout: 1,
                    drag: false,
                    timeout: false,
                    close: true,
                    overlay: true,
                    toastOnce: false,
                    id: 'question',
                    title: `Reducir el efectivo de ${username}`,
                    message: '¿Cuanto dinero deseas disminuir?',
                    position: 'center',
                    inputs: [
                        ['<input type="number">', 'keydown', function (instance, toast, input, e) {
                        }]
                    ],
                    buttons: [
                        ['<button><b>Confirmar</b></button>', function (instance, toast, button, e, inputs) {
                            let number = inputs[0].value;
                            if(number > 0){
                                window.location = '{{ url('admin/cash/reduce') }}/' + userId + '/' + number;
                            }
                            instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                        }, false], // true to focus
                        ['<button>Cancelar</button>', function (instance, toast, button, e) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }]
                    ]
                });

            });

            $('.addPrepayment').on('click', function (event) {
                event.preventDefault();
                let username = $(this).data('username');
                let userId = $(this).data('userid');

                iziToast.question({
                    rtl: false,
                    layout: 1,
                    drag: false,
                    timeout: false,
                    close: true,
                    overlay: true,
                    toastOnce: false,
                    id: 'question',
                    title: `Aumentar efectivo de ${username}`,
                    message: '¿Cuanto dinero deseas agregar?',
                    position: 'center',
                    inputs: [
                        ['<input type="number">', 'keydown', function (instance, toast, input, e) {
                        }]
                    ],
                    buttons: [
                        ['<button><b>Confirmar</b></button>', function (instance, toast, button, e, inputs) {
                            let number = inputs[0].value;
                            if(number > 0){
                                window.location = '{{ url('admin/cash/add') }}/' + userId + '/' + number;
                            }
                            instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                        }, false], // true to focus
                        ['<button>Cancelar</button>', function (instance, toast, button, e) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }]
                    ]
                });

            });

        });
    </script>

@endsection