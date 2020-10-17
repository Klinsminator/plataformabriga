<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>PA | Inicio</title>
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
                            <h3 class="margin-bottom-20">Perfiles Activos</h3>
                            <div>
                                <!-- ACTIVE PROFILES TABLE -->
                                <table id="activeProfiles" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Solicitante</th>
                                            <th>Edad</th>
                                            <th>Genero</th>
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($activeProfiles as $profile)
                                            <tr id="prueba" class="dashboardTableProfiles">
                                                <td>{{ $profiles->id }}</td>
                                                @foreach($profiles->applicant as $applicant)
                                                    <td id="{{ $applicant->id }}">{{ $applicant->names }}</td>
                                                @endforeach
                                                <td>{{ $profiles->age }}</td>
                                                <td>{{ $profiles->gender }}</td>
                                                <td>{{ $profiles->created_at }}</td>
                                                @foreach($profiles->user as $user)
                                                    <td id="{{ $user->id }}">{{ $user->names }}</td>
                                                @endforeach
                                                <td>{{ $profiles->state }}</td>
                                                <td class="professionalsTableProfessionalTd">
                                                    <a class="edit" href="#">
                                                        <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px; color: #007bff"></i>
                                                    </a>
                                                    <a onclick="return confirm('Seguro que desea continuar?')" href="{{ route('getDeleteProfessional', ['professionalId' => $professional->id]) }}">
                                                        <i class="fa fa-minus-square" aria-hidden="true" style="font-size: 20px; color: red"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- ACTIVE PROFILES TABLE -->
                            </div>
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="margin-bottom-20">Perfiles Inactivos</h3>
                            <div>
                                <!-- INACTIVE PROFILES TABLE -->
                                <table id="inactiveProfiles" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Solicitante</th>
                                            <th>Edad</th>
                                            <th>Genero</th>
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($inactiveProfiles as $profile)
                                            <tr id="prueba" class="dashboardTableProfiles">
                                                <td>{{ $profiles->id }}</td>
                                                @foreach($profiles->applicant as $applicant)
                                                    <td id="{{ $applicant->id }}">{{ $applicant->names }}</td>
                                                @endforeach
                                                <td>{{ $profiles->age }}</td>
                                                <td>{{ $profiles->gender }}</td>
                                                <td>{{ $profiles->created_at }}</td>
                                                @foreach($profiles->user as $user)
                                                    <td id="{{ $user->id }}">{{ $user->names }}</td>
                                                @endforeach
                                                <td>{{ $profiles->state }}</td>
                                                <td class="professionalsTableProfessionalTd">
                                                    <a class="edit" href="#">
                                                        <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px; color: #007bff"></i>
                                                    </a>
                                                    <a onclick="return confirm('Seguro que desea continuar?')" href="{{ route('getDeleteProfessional', ['professionalId' => $professional->id]) }}">
                                                        <i class="fa fa-minus-square" aria-hidden="true" style="font-size: 20px; color: red"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- INACTIVE PROFILES TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('scripts.script_Login_v1')
        @include('scripts.datatables')
        <script>
            $(document).ready(function() {
                $('#activeProfiles').DataTable();
            } );
        </script>
        <script>
            $(document).ready(function() {
                $('#inactiveProfiles').DataTable();
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
