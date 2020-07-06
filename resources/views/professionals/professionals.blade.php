<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>PA | Profesionales</title>
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
                            <h3 class="margin-bottom-20">Areas</h3>
                            <div>
                                <!-- AREAS TABLE -->
                                <table id="areas" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recommendationAreas as $area)
                                            <tr>
                                                <td>{{ $area->id }}</td>
                                                <td>{{ $area->name }}</td>
                                                <td>{{ $area->description }}</td>
                                                <td>
                                                    <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px; color: #007bff"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- AREAS TABLE -->
                            </div>
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="margin-bottom-20">Profesionales</h3>
                            <div>
                                <!-- PROFESSIONALS TABLE -->
                                <table id="professionals" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>T.</th>
                                            <th>Nombre</th>
                                            <th>Area</th>
                                            <th>Profesion</th>
                                            <th>Correo Electronico</th>
                                            <th>Telefono</th>
                                            <th>Consultorio</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($professionals as $professional)
                                            <tr>
                                                <td>{{ $professional->id }}</td>
                                                <td>{{ $professional->title }}</td>
                                                <td>{{ $professional->names." ".$professional->last_names }}</td>
                                                <td>{{ $professional->recommendation_area_id }}</td>
                                                <td>{{ $professional->profession }}</td>
                                                <td>{{ $professional->email }}</td>
                                                <td>{{ $professional->phone }}</td>
                                                <td>{{ $professional->office_id }}</td>
                                                <td>
                                                    <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px; color: #007bff"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- PROFESSIONALS TABLE -->
                            </div>
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="margin-bottom-20">Consultorios</h3>
                            <div>
                                <!-- OFFICES TABLE -->
                                <table id="offices" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Direccion</th>
                                            <th>Telefono primario</th>
                                            <th>Telefono secundario</th>
                                            <th>Email</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($offices as $office)
                                            <tr>
                                                <td>{{ $office->id }}</td>
                                                <td>{{ $office->name }}</td>
                                                <td>{{ $office->address }}</td>
                                                <td>{{ $office->phone_primary }}</td>
                                                <td>{{ $office->phone_secondary }}</td>
                                                <td>{{ $office->email }}</td>
                                                <td>
                                                    <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px; color: #007bff"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- OFFICES TABLE -->
                            </div>
                        </div>
                    </div>
                    <hr class="dotted">
                    @include('includes.message_block')
                    <div class="row">
                        <div class="col-4">
                            <h3 class="text-center margin-bottom-20">Crea un area</h3>
                            <div>
                                <!-- CREATRECOMMENDATIONEAREA FORM -->
                                <form id="createRecommendationAreaForm" class="login100-form validate-form center_div" action="{{ route('createRecommendationArea') }}" method="post">
                                    <div class="wrap-input100 {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <input class="input100" type="text" name="name" placeholder="Nombre" value="{{ Request::old('name') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('description') ? 'has-error' : '' }}">
                                        <textarea class="input100" type="text" name="description" placeholder="Descripcion" value="{{ Request::old('description') }}"></textarea>
                                    </div>
                                    <div class="container-login100-form-btn">
                                        <button type="submit" class="login100-form-btn">
                                            Crear
                                        </button>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    </div>
                                </form>
                                <!-- CREATRECOMMENDATIONEAREA FORM -->
                            </div>
                        </div>
                        <div class="col-4">
                            <h3 class="text-center margin-bottom-20">Crea un profesional</h3>
                            <div>
                                <!-- CREATEPROFESSIONAL FORM -->
                                <form id="createProfessionalForm" class="login100-form validate-form center_div" action="{{ route('createProfessional') }}" method="post">
                                    <div class="wrap-input100 {{ $errors->has('names') ? 'has-error' : '' }}">
                                        <input class="input100" type="text" name="names" placeholder="Nombres" value="{{ Request::old('names') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('lastNames') ? 'has-error' : '' }}">
                                        <input class="input100" type="text" name="lastNames" placeholder="Apellidos" value="{{ Request::old('lastNames') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('title') ? 'has-error' : '' }}">
                                        <input class="input100" type="text" name="title" placeholder="Titulo" value="{{ Request::old('title') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('profession') ? 'has-error' : '' }}">
                                        <input class="input100" type="text" name="profession" placeholder="Profesion" value="{{ Request::old('profession') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <input class="input100" type="email" name="email" placeholder="Correo electronico" value="{{ Request::old('email') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('phone') ? 'has-error' : '' }}">
                                        <input class="input100" type="text" name="phone" placeholder="Telefono" value="{{ Request::old('phone') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('recommendationAreaId') ? 'has-error' : '' }}">
                                        <select class="input100" name="recommendationAreaId">
                                            <option disabled selected value>Seleccione area</option>
                                            @foreach($recommendationAreas as $area)
                                                <option value={{ Request::old('recommendationAreaId') ? Request::old('recommendationAreaId') : $area->id}}>{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('officeId') ? 'has-error' : '' }}">
                                        <select class="input100" name="officeId">
                                            <option disabled selected value>Seleccione consultorio</option>
                                            @foreach($offices as $office)
                                                <option value={{ Request::old('officeId') ? Request::old('officeId') : $office->id}}>{{ $office->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="container-login100-form-btn">
                                        <button type="submit" class="login100-form-btn">
                                            Crear
                                        </button>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    </div>
                                </form>
                                <!-- CREATEPROFESSIONAL FORM -->
                            </div>
                        </div>
                        <div class="col-4">
                            <h3 class="text-center margin-bottom-20">Crea un consultorio</h3>
                            <div>
                                <!-- CREATEOFFICE FORM -->
                                <form id="createOfficeForm" class="login100-form validate-form center_div" action="{{ route('createOffice') }}" method="post">
                                    <div class="wrap-input100 {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <input class="input100" type="text" name="name" placeholder="Nombre" value="{{ Request::old('name') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('phonePrimary') ? 'has-error' : '' }}">
                                        <input class="input100" type="number" name="phonePrimary" placeholder="Telefono primario" value="{{ Request::old('phonePrimary') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('phoneSecondary') ? 'has-error' : '' }}">
                                        <input class="input100" type="number" name="phoneSecondary" placeholder="Telefono secundario" value="{{ Request::old('phoneSecondary') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <input class="input100" type="email" name="email" placeholder="Correo electronico" value="{{ Request::old('email') }}">
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('address') ? 'has-error' : '' }}">
                                        <textarea class="input100" type="text" name="address" placeholder="Direccion" value="{{ Request::old('address') }}"></textarea>
                                    </div>
                                    <div class="container-login100-form-btn">
                                        <button type="submit" class="login100-form-btn">
                                            Crear
                                        </button>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    </div>
                                </form>
                                <!-- CREATEOFFICE FORM -->
                            </div>
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="text-center margin-bottom-20">Asignar area a profesional</h3>
                            <div>
                                <!-- ASSIGNAREATOPROFESSIONAL FORM -->
                                <form id="assignAreaToProfessionalForm" class="login100-form validate-form center_div" action="{{ route('assignAreaToProfessional') }}" method="post">
                                    <div class="wrap-input100 {{ $errors->has('professionalID') ? 'has-error' : '' }}">
                                        <select class="input100" name="professionalID">
                                            <option disabled selected value>Seleccione Profesional</option>
                                            @foreach($professionals as $professional)
                                                <option value={{ Request::old('professionalID') ? Request::old('professionalID') : $professional->id}}>{{ $professional->names." ".$professional->last_names  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('areaId') ? 'has-error' : '' }}">
                                        <select class="input100" name="areaId">
                                            <option disabled selected value>Seleccione area</option>
                                            @foreach($recommendationAreas as $area)
                                                <option value={{ Request::old('areaId') ? Request::old('areaId') : $area->id}}>{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="container-login100-form-btn">
                                        <button type="submit" class="login100-form-btn">
                                            Asignar
                                        </button>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    </div>
                                </form>
                                <!-- ASSIGNAREATOPROFESSIONAL FORM -->
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="text-center margin-bottom-20">Asignar consultorio a profesional</h3>
                            <div>
                                <!-- ASSIGNOFFICETOPROFESSIONAL FORM -->
                                <form id="assignOfficeToProfessionalForm" class="login100-form validate-form center_div" action="{{ route('assignOfficeToProfessional') }}" method="post">
                                    <div class="wrap-input100 {{ $errors->has('professionalID') ? 'has-error' : '' }}">
                                        <select class="input100" name="professionalID">
                                            <option disabled selected value>Seleccione Profesional</option>
                                            @foreach($professionals as $professional)
                                                <option value={{ Request::old('professionalID') ? Request::old('professionalID') : $professional->id}}>{{ $professional->names." ".$professional->last_names  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="wrap-input100 {{ $errors->has('officeId') ? 'has-error' : '' }}">
                                        <select class="input100" name="officeId">
                                            <option disabled selected value>Seleccione consultorio</option>
                                            @foreach($offices as $office)
                                                <option value={{ Request::old('officeId') ? Request::old('officeId') : $office->id}}>{{ $office->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="container-login100-form-btn">
                                        <button type="submit" class="login100-form-btn">
                                            Asignar
                                        </button>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    </div>
                                </form>
                                <!-- ASSIGNOFFICETOPROFESSIONAL FORM -->
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
                $('#areas').DataTable();
            } );
        </script>
        <script>
            $(document).ready(function() {
                $('#professionals').DataTable({
                    "scrollX": true
                });
            } );
        </script>
        <script>
            $(document).ready(function() {
                $('#offices').DataTable();
            } );
        </script>

    </body>
</html>
