@extends('client.layout')

@section('content')

    <!-- WRAPPER -->
    <div class="wrapper animsition">

        <!--========== PAGE CONTENT ==========-->
        <!-- thankyou -->
        <div class="coming-soon fullheight" style="background: url('//placehold.it/1200x800/000') no-repeat center center fixed; background-size: cover;">
            <div class="container vertical-center-aligned">
                <div class="margin-b-60">
                    <h2 class="coming-soon-title" style="font-size: 60px">Ocurrio un error procesando tu orden.</h2>
                    <p class="coming-soon-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, repudiandae.</p>
                </div>
                <a class="btn-white-bg btn-base-md radius-3" href="{{ route('client') }}">Regresar</a>
            </div>
        </div>
        <!-- End thankyou -->
        <!--========== END PAGE CONTENT ==========-->

    </div>
    <!-- END WRAPPER -->
@endsection

@section('pages-plugins')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/jquery.smooth-scroll.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/jquery.animsition.min.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('pages-scripts')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/components/animsition.js') }}"></script>
@endsection