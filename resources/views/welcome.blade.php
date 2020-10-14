<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>PA | Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('includes.head_Login_v1')
    </head>
    <body>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="{{asset ("images/img-01.png")}}" alt="IMG">
                    </div>
                    <!-- SIGNIN FORM -->
                    @include('includes.message_block')
                    <form class="login100-form validate-form" action="{{ route('signin') }}" method="post">
                        <span class="login100-form-title">
                            Plataforma Abriga
                        </span>
                        <div class="wrap-input100 validate-input {{ $errors->has('username') ? 'has-error' : '' }}" data-validate = "Nombre de usuario requerido">
                            <input class="input100" type="text" name="username" placeholder="Usuario" value="{{ Request::old('username') }}">
                            <span class="focus-input100"></span>
                        </div>
                        <div class="wrap-input100 validate-input {{ $errors->has('password') ? 'has-error' : '' }}" data-validate = "Contraseña requerida">
                            <input class="input100" type="password" name="password" placeholder="Contraseña" value="{{ Request::old('password') }}">
                            <span class="focus-input100"></span>
                        </div>
                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                Entrar
                            </button>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </div>
                        <div class="text-center p-t-136">
                            <span class="txt1">
                                En caso de problemas, contactar a soporte@abrigacr.com
                            </span>
                        </div>
                    </form>
                    <!-- SIGNIN FORM -->
                </div>
            </div>
        </div>
        @include('scripts.script_Login_v1')
    </body>
</html>
