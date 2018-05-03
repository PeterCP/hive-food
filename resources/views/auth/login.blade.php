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
                        <img class="" src="{{ URL::asset('images/logo_background_white.png') }}" alt="Hive Food" height="150px">
                    </a>
                </div>
                <!-- End Login Form Logo -->

                <div class="login-content radius-3 margin-b-30">
                    <!-- Login Form -->

                    <form class="login-form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="margin-b-30">
                            <h1 class="login-form-title">Login</h1>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   required autofocus placeholder="email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" autocomplete="on"
                                   placeholder="Password" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="login-form-actions">
                            <div class="checkbox pull-left">
                                <input id="checkbox" type="checkbox" name="remember"
                                       checked {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox">Recordarme</label>
                            </div>
                            {{--
                            <a href="{{ route('password.request') }}" class="login-form-forgot">¿Olvidaste
                                tu contraseña?</a>
                            --}}
                        </div>

                        <button type="submit" class="btn-base-bg btn-base-sm btn-block radius-3 margin-b-30">
                            Login
                        </button>
                    </form>
                    <!-- End Login Form -->

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
    <script type="text/javascript"
            src="{{ URL::asset('theme/plugins/validation/additional-methods.min.js') }}"></script>
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
            "{{ URL::asset('images/patron_rojo.png') }}",
            // "https://placehold.it/1920x1080/fff"
        ], {duration: 3000, fade: 750});
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection
