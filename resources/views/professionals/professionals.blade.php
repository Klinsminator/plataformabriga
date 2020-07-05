<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>PA | Usuarios</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('includes.head_Login_v1')
        @include('includes.datatables')
    </head>
    <body>
        <div class="limiter">
            <div class="container-login100-greyish">
                <div class="wrap-home100">
                    @include('includes.admin_navbar')
                    <div class="row">
                        <div class="col-12">
                            <h3 class="margin-bottom-20">Usuarios</h3>
                            <table id="users" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Tipo</th>
                                    <th>Nombre</th>
                                    <th>email</th>
                                    <th>Ultimo registro</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                                <tr>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                    <td>2011/07/25</td>
                                    <td>$170,750</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="margin-bottom-20">Tipos de usuarios</h3>
                            <table id="types" class="table table-striped table-bordered" style="width:50%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Intermediario</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Consultor</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="dotted">
                    @include('includes.message_block')
                    <div class="row">
                        <div class="col-6">
                            <h3 class="text-center margin-bottom-20">Crea un nuevo usuario</h3>
                            <div>
                                <!-- SIGNUP FORM -->
                                <form id="signupForm" class="login100-form validate-form center_div" action="{{ route('signup') }}" method="post">
                                    <div class="wrap-input100 {{ $errors->has('names') ? 'has-error' : '' }}">
                                        <input class="input100" type="text" name="names" placeholder="Nombres" value="{{ Request::old('names') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('lastNames') ? 'has-error' : '' }}">
                                        <input class="input100" type="text" name="lastNames" placeholder="Apellidos" value="{{ Request::old('lastNames') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('type') ? 'has-error' : '' }}">
                                        <input class="input100" type="text" name="type" placeholder="Tipo" value="{{ Request::old('type') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <input class="input100" type="email" name="email" placeholder="Correo electronico" value="{{ Request::old('email') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('username') ? 'has-error' : '' }}">
                                        <input class="input100" type="text" name="username" placeholder="Usuario" value="{{ Request::old('username') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('password') ? 'has-error' : '' }}">
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
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="text-center margin-bottom-20">Crea un nuevo tipo de usuario</h3>
                            <!-- CREATE TYPE FORM -->
                            <form id="typeForm" class="login100-form validate-form center_div" action="{{ route('createUserType') }}" method="post">
                                <div class="wrap-input100 {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <input class="input100" type="text" name="name" placeholder="Tipo" value="{{ Request::old('name') }}">
                                </div>
                                <div class="container-login100-form-btn">
                                    <button type="submit" class="login100-form-btn">
                                        Crear
                                    </button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                </div>
                            </form>
                            <!-- CREATE TYPE FORM -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('scripts.script_Login_v1')
        @include('scripts.datatables')
        <script>
            $(document).ready(function() {
                $('#users').DataTable();
            } );
        </script>

    </body>
</html>
