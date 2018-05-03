@extends('client.layout')

@section('content')

    @include('client.navbar')

    <!-- WRAPPER -->
    <div class="wrapper animsition">


        <!--========== BREADCRUMBS ==========-->
        <section class="breadcrumbs-v5 padding-100"
                 style="background: url('{{ URL::asset('images/patron_negro.png') }}') center no-repeat; -webkit-background-size: cover;background-size: cover; )">
            <div class="container">
                <h2 class="breadcrumbs-v5-title">Bienvenido, {{ $userName }}</h2>
                <span class="breadcrumbs-v5-subtitle">We all fit at Hive.</span>
            </div>
        </section>
        <!--========== END BREADCRUMBS ==========-->


        <!--========== PAGE CONTENT ==========-->
        <main id="app"></main>
        <!--========== END PAGE CONTENT ==========-->


        @include('client.footer')


    </div>
    <!-- END WRAPPER -->
@endsection


@section('pages-plugins')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/jquery.back-to-top.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/jquery.smooth-scroll.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/jquery.animsition.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/validation/jquery.validate.min.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('pages-scripts')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/components/header-sticky.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/components/animsition.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/components/scrollbar.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/components/form-modal.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/components/magnific-popup.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/components/comment-form.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->


    <script src="{{ URL::asset('js/order.js') }}"></script>
    <script>
        $(document).ready(function () {
            let node = document.getElementById('app');
            let app = Elm.Main.embed(node, {
                imagePath : '{{ URL::asset('uploads/dishes/') }}/',
                csrf_token: '{{ csrf_token() }}',
                foodPrepayments: {{ $plates }},
                cashPrepayments: {{ $cash }},
                loyaltyPoints: {{ $userPoints }},
                getMenuUrl: '{{ url('menu') }}',
                getOrdersUrl: '{{ $getOrdersUrl }}',
                createNewOrdenUrl: '{{ $createNewOrdersUrl }}',
                thankyou: '{{ url('gracias') }}',
                errorCreatingOrder: '{{ url('error-creando-orden') }}'
            });
        });
    </script>



@endsection
