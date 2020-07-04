<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('includes.head_Login_v1')
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <!-- SIGNUP FORM -->
            @if(count($errors) > 0)
                <div class="wrap-input100 validate-input">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li style="color: red">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="login100-form validate-form" action="{{ route('signup') }}">
                <div class="wrap-input100 validate-input {{ $errors->has('names') ? 'has-error' : '' }}" data-validate = "Nombres requeridos">
                    <input class="input100" type="text" name="names" placeholder="Nombres" value="{{ Request::old('names') }}">
                </div>
                <div class="wrap-input100 validate-input {{ $errors->has('lastNames') ? 'has-error' : '' }}" data-validate = "Apellidos requeridos">
                    <input class="input100" type="text" name="lastNames" placeholder="Apellidos" value="{{ Request::old('lastNames') }}">
                </div>
                <div class="wrap-input100 validate-input {{ $errors->has('type') ? 'has-error' : '' }}" data-validate = "Tipo requerido">
                    <input class="input100" type="text" name="type" placeholder="Tipo" value="{{ Request::old('type') }}">
                </div>
                <div class="wrap-input100 validate-input {{ $errors->has('email') ? 'has-error' : '' }}" data-validate = "Correo electronico requerido">
                    <input class="input100" type="email" name="email" placeholder="Correo electronico" value="{{ Request::old('email') }}">
                </div>
                <div class="wrap-input100 validate-input {{ $errors->has('username') ? 'has-error' : '' }}" data-validate = "Nombre de usuario requerido">
                    <input class="input100" type="text" name="username" placeholder="Usuario" value="{{ Request::old('username') }}">
                </div>
                <div class="wrap-input100 validate-input {{ $errors->has('password') ? 'has-error' : '' }}" data-validate = "Contraseña requerida">
                    <input class="input100" type="password" name="password" placeholder="Contraseña">
                </div>
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Crear
                    </button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </div>
            </form>
            <!-- SIGNUP FORM -->
            <!-- CREATE TYPE FORM -->
            @if(count($errors) > 0)
                <div class="wrap-input100 validate-input">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li style="color: red">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="login100-form validate-form" action="{{ route('createUserType') }}">
                <div class="wrap-input100 validate-input {{ $errors->has('name') ? 'has-error' : '' }}" data-validate = "Nombre requeridos">
                    <input class="input100" type="text" name="name" placeholder="Nombre" value="{{ Request::old('name') }}">
                </div>
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Crear
                    </button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </div>
            </form>
            <!-- SIGNUP FORM -->
        </div>
    </div>
</div>
@include('scripts.script_Login_v1')
</body>
</html>
