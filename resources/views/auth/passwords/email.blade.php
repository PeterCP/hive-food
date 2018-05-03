@extends('auth.layout')

@section('content')

    <!-- WRAPPER -->
    <div class="wrapper animsition">
        <!--========== PAGE CONTENT ==========-->
        <!-- Login -->
        <div class="content-sm container center-block">
            <!-- Login -->
            <div class="login">
                <!-- Login Form Logo -->
                <div class="margin-b-50">
                    <a href="{{ url('') }}">
                        <img class="login-form-logo" src="{{ URL::asset('img/logo.png') }}" alt="Hive Food">
                    </a>
                </div>
                <!-- End Login Form Logo -->

                <div class="login-content radius-3 margin-b-30">

                    <!-- Forgot Password Form -->
                    <form class="login-form" method="POST" action="{{ route('password.email') }}">

                        {{ csrf_field() }}

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="margin-b-30">
                            <h1 class="login-form-title">¿Olvidaste tu contraseña?</h1>
                            <p>Por favor, introduce tu email para restablecer tu contraseña.</p>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <button type="submit" class="btn-base-bg btn-base-sm btn-block radius-3 margin-b-30">Restablecer Contraseña</button>

                    </form>
                    <!-- End Forgot Password Form -->

                </div>

                <p class="color-white">&#169;
                    <script type="text/javascript">
                        document.write(new Date().getFullYear());
                    </script>
                    Hive Food.
                </p>
            </div>
            <!-- End Login -->
        </div>
        <!-- End Login -->
        <!--========== END PAGE CONTENT ==========-->
    </div>
    <!-- END WRAPPER -->
@endsection


@section('pages-plugins')
    <!-- PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/jquery.smooth-scroll.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/jquery.animsition.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/validation/additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/jquery.backstretch.min.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('pages-scripts')
    <!-- PAGE LEVEL SCRIPTS -->
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/components/animsition.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('theme/scripts/components/login-form.js') }}"></script>
    <script type="text/javascript">
        $.backstretch([
            "https://placehold.it/1920x1080",
            "https://placehold.it/1920x1080/fff"
        ], {duration: 3000, fade: 750});
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection

