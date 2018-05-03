@extends('admin.layout.layout') @section('styles')
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
                <a href="">
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
                        <h3 class="box-title">Aquí puedes administrar el banner de la página de:
                            <strong>{{ $pagina }}</strong>
                        </h3>
                        <div class="pull-right">
                            <label class="switch" title="Activar/Desactivar">
                                <input id="toggle_banner_switch" data-banner-id="{{ $banner[0]->id }}" data-banner-status="{{ $banner[0]->activa }}" type="checkbox" {{ $banner[0]->activa }}>
                                <span class="slider"></span>
                                <button class="btn btn-xs" title="Agregar slide"> </button>
                            </label>
                            <button id="agregar_slide" class="btn btn-xs btn-success btn-flat c-font-14" title="Agregar slide" data-agregar-visible="false" 
                            data-alternate-label="&nbsp;&nbsp;&nbsp;regresar&nbsp;&nbsp;&nbsp;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>+</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="tabla">
                        <table id="tabla_banners" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Alt</th>
                                    <th>Descripción</th>
                                    <th>Editar</th>
                                    <th>Activar/Desactivar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slides as $slide)
                                <tr>
                                    <td>{{$slide->imagen}}</td>
                                    <td>{!! str_limit($slide->titulo, $limit = 50, $end = '...') !!}</td>
                                    <td>{!! str_limit($slide->descripcion, $limit = 50, $end = '...') !!} </td>
                                    <td class="center">
                                        <a href="{{url("admin/banner/slide/editar/$slide->id")}}">
                                            <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td class="center">
                                        @php if($slide->activa == 'checked'){ $class = 'checked-slide'; } else { $class = ''; } @endphp
                                        <label class="switch">
                                            <input class="check-slide {{ $class }}" id="slide_{{ $slide->id }}" data-slide-id="{{ $slide->id }}" data-slide-status="{{ $slide->activa }}"
                                                type="checkbox" {{ $slide->activa }}>
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                    <td class="center">
                                        <a href="javascript:void(0);" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $slide->id }}').submit();">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        <form id="delete-form-{{ $slide->id }}" action="{{ route('slide.destroy', $slide->id) }}" style="display: none;" method="POST">
                                            {{ csrf_field() }} {{ method_field('DELETE') }}
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="box-body hidden" id="menu_agregar">
                        <h3>Sube la información de imagen de tu nuevo slide</h3>
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('slide.store') }} " enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="banner" value="{{ $pagina }}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="titulo">Alt. Text (Max. 50 caracteres)</label>
                                    <textarea class="form-control" name="titulo" id="titulo" cols="30"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción (Max. 100 caracteres)</label>
                                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <input type="file" name='imagen' id='imagen' required>
                                    <p class="help-block">El peso de la imagen afectara gravemente el tiempo de carga de la pagina. Recomendamos
                                        <a href="https://compressor.io">Compressor</a> para aligerar tus imagenes (maximo 2Mb).</p>
                                    <li>Dimensiones: 1300 X 500.</li>
                                    <li>Las imagenes seran escaladas a esta dimensión.</li>
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
@endsection @section('scripts')
<!-- DataTables -->
<script src="{{ asset('admin_src/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_src/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('admin_src/iCheck/icheck.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin_src/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

<script>
    $(function () {
        $('#tabla_banners').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    });

    function swapClasses(element, original_class, new_class) {
        $(element).removeClass(original_class).addClass(new_class);
    }

    $(document).ready(function () {

        $('#agregar_slide').click(
            function (event) {
                event.preventDefault();
                const previous_label = $(this).html();
                $(this).html($(this).data('alternate-label'));
                $(this).data('alternate-label', previous_label);
                agregar_visible = $(this).data('agregar-visible') == 'true';

                if (agregar_visible) {
                    $(this).data('agregar-visible', 'false')
                    $(this).removeClass('btn-warning').addClass('btn-success');
                    swapClasses($('#menu_agregar'), 'visible', 'hidden');
                    swapClasses($('#tabla'), 'hidden', 'visible');
                } else {
                    $(this).data('agregar-visible', 'true')
                    $(this).removeClass('btn-success').addClass('btn-warning');
                    swapClasses($('#tabla'), 'visible', 'hidden');
                    swapClasses($('#menu_agregar'), 'hidden', 'visible');
                }
            }
        );

        //actualizar el estado de un slide
        $('.check-slide').on('change', function (event) {
            const active_slides = $(".checked-slide").length;
            const task_id = $(this).data('slide-id');
            const task_status = $(this).data('slide-status');

            if (active_slides >= 4 && !$(this).hasClass("checked-slide")) {
                $(this).prop('checked', false); // UnChecks it
                $.notify("Error. No es posible tener mas de 4 slides activas a la vez.", "error");
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/slide/change_status') }}" + '/' + task_id + '/' +
                        task_status,
                    success: function (data) {
                        console.log('success:', data);
                        if (task_status == 'checked') {
                            $('#slide_' + task_id).data('slide-status', 'un-checked');
                            $('#slide_' + task_id).removeClass('checked-slide');
                        } else {
                            $('#slide_' + task_id).data('slide-status', 'checked');
                            $('#slide_' + task_id).prop('checked', true);
                            $('#slide_' + task_id).addClass('checked-slide');
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });


        //actualizar el estado del banner completo
        $('#toggle_banner_switch').on('change', function (event) {

            const $bannerToggle = $('#toggle_banner_switch');
            const bannerId = $(this).data('banner-id');
            const task_status = $(this).data('banner-status');

            $.ajax({
                type: "GET",
                url: "{{ url('admin/banner/change_status') }}" + '/' + bannerId + '/' +
                task_status,
                success: function (data) {
                    console.log('success:', data);
                    if (task_status == 'checked') {
                        $bannerToggle.data('banner-status', 'un-checked');
                    } else {
                        $bannerToggle.data('banner-status', 'checked');
                        $bannerToggle.prop('checked', true);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });


    });
</script>
@endsection