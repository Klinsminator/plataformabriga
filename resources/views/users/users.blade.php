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
                    @include('includes.message_block')
                    <div class="row">
                        <div class="col-12">
                            <h3 class="margin-bottom-20">Usuarios</h3>
                            <table id="users" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Tipo</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>email</th>
                                        <th>Ultimo registro</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr id="prueba" class="usersTableUser">
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td id={{ $user->userType->id }}>{{ $user->userType->name }}</td>
                                            <td>{{ $user->names }}</td>
                                            <td>{{ $user->last_names }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->last_sign_in }}</td>
                                            <td class="usersTableUserTd">
                                                <a class="edit" href="#">
                                                    <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px; color: #007bff"></i>
                                                </a>
                                                <a onclick="return confirm('Seguro que desea continuar?')" href="{{ route('getDeleteUser', ['userId' => $user->id]) }}">
                                                    <i class="fa fa-minus-square" aria-hidden="true" style="font-size: 20px; color: red"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
                                    <th>Accion</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($userTypes as $userType)
                                        <tr class="usersTableUserType">
                                            <td>{{ $userType->id }}</td>
                                            <td>{{ $userType->name }}</td>
                                            <td class="usersTableUserTypeTd">
                                                <a class="edit" href="#">
                                                    <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px; color: #007bff"></i>
                                                </a>
                                                <a onclick="return confirm('Seguro que desea continuar?')" href="{{ route('getDeleteUserType', ['userTypeId' => $userType->id]) }}">
                                                    <i class="fa fa-minus-square" aria-hidden="true" style="font-size: 20px; color: red"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="dotted">
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
                                        <select class="input100" name="type">
                                            <option disabled selected value>Seleccione tipo</option>
                                            @foreach($userTypes as $userType)
                                                <option value={{ Request::old('type') ? Request::old('type') : $userType->id}}>{{ $userType->name }}</option>
                                            @endforeach
                                        </select>
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
                            <div>
                                <!-- CREATE TYPE FORM -->
                                <form id="usersTypeForm" class="login100-form validate-form center_div" action="{{ route('createUserType') }}" method="post">
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
        </div>
        <!-- MODAL USER -->
        <div class="modal fade" id="usersModalEditUser" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- MODAL HEADER WITH TITLE AND CLOSE BUTTON -->
                    <div class="modal-header">
                        <h3 class="modal-title">Editar tipo de usuario</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- MODAL BODY -->
                    <div class="modal-body">
                        <div>
                            <!-- MODAL USER FORM -->
                            <form id="usersModalUserForm" class="login100-form validate-form center_div">
                                <div class="wrap-input100">
                                    <input id="usersModalUserFormNames" class="input100" type="text" name="names">
                                </div>
                                <div class="wrap-input100">
                                    <input id="usersModalUserFormLastNames" class="input100" type="text" name="lastNames">
                                </div>
                                <div class="wrap-input100">
                                    <select id="usersModalUserFormType" class="input100" name="type">
                                        <option disabled selected value>Seleccione tipo</option>
                                        @foreach($userTypes as $userType)
                                            <option value={{$userType->id}}>{{ $userType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="wrap-input100">
                                    <input id="usersModalUserFormEmail" class="input100" type="email" name="email">
                                </div>
                                <div class="wrap-input100">
                                    <input id="usersModalUserFormPassword" class="input100" type="password" name="password" placeholder="Contraseña">
                                </div>
                            </form>
                            <!-- MODAL USER FORM -->
                        </div>
                    </div>
                    <!-- MODAL FOOTER -->
                    <div class="modal-footer">
                        <div class="login100-form validate-form center_div">
                            <div class="container-login100-form-btn">
                                <button id="usersModalUserFormIdSubmit" type="button" class="login100-form-btn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL USER -->
        <!-- MODAL USER TYPE -->
        <div class="modal fade" id="usersModalEditUserType" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- MODAL HEADER WITH TITLE AND CLOSE BUTTON -->
                    <div class="modal-header">
                        <h3 class="modal-title">Editar tipo de usuario</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- MODAL BODY -->
                    <div class="modal-body">
                        <div>
                            <!-- TYPE FORM -->
                            <form id="usersModalTypeForm" class="login100-form validate-form center_div">
                                <div class="wrap-input100">
                                    <input id="usersModalTypeFormIdInput" class="input100" type="text" name="name">
                                </div>
                            </form>
                            <!-- TYPE FORM -->
                        </div>
                    </div>
                    <!-- MODAL FOOTER -->
                    <div class="modal-footer ">
                        <div class="login100-form validate-form center_div">
                            <div class="container-login100-form-btn">
                                <button id="usersModalTypeFormIdSubmit" type="button" class="login100-form-btn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL USER TYPE -->
        @include('scripts.script_Login_v1')
        @include('scripts.datatables')
        <script>
            $(document).ready(function() {
                $('#users').DataTable();
            } );
        </script>
        <!-- ROUTE -->
        <script>
            var token = '{{ Session::token() }}';
            var urlUser = '{{ route('postUpdateUser') }}';
            var urlUserType = '{{ route('postUpdateUserType') }}';
        </script>
        <!-- ROUTE -->
        @include('scripts.confirm_message_block')
    </body>
</html>
