<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>PA | Profesionales y Areas</title>
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
                            <h3 class="margin-bottom-20">Profesionales</h3>
                            <div>
                                <!-- PROFESSIONALS TABLE -->
                                <table id="professionals" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>T.</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Area</th>
                                            <th>Profesion</th>
                                            <th>Correo Electronico</th>
                                            <th>Telefono</th>
                                            <th>Consultorio</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($professionals as $professional)
                                            <tr id="prueba" class="professionalsTableProfessionals">
                                                <td>{{ $professional->id }}</td>
                                                <td>{{ $professional->title }}</td>
                                                <td>{{ $professional->names }}</td>
                                                <td>{{ $professional->last_names }}</td>
                                                @foreach($professional->recommendationArea as $area)
                                                    <td id="{{ $area->id }}">{{ $area->name }}</td>
                                                @endforeach
                                                <td>{{ $professional->profession }}</td>
                                                <td>{{ $professional->email }}</td>
                                                <td>{{ $professional->phone }}</td>
                                                @foreach($professional->office as $office)
                                                    <td id="{{ $office->id }}">{{ $office->name }}</td>
                                                @endforeach
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
                                <!-- PROFESSIONALS TABLE -->
                            </div>
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="margin-bottom-20">Areas de Recomendacion</h3>
                            <div>
                                <!-- AREAS TABLE -->
                                <table id="areas" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recommendationAreas as $area)
                                            <tr id="prueba" class="professionalsTableRecommendationArea">
                                                <td>{{ $area->id }}</td>
                                                <td>{{ $area->name }}</td>
                                                <td>{{ $area->description }}</td>
                                                <td class="professionalsTableRecommendationAreaTd">
                                                    <a class="edit" href="#">
                                                        <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px; color: #007bff"></i>
                                                    </a>
                                                    <a onclick="return confirm('Seguro que desea continuar?')" href="{{ route('getDeleteRecommendationArea', ['recommendationAreaId' => $area->id]) }}">
                                                        <i class="fa fa-minus-square" aria-hidden="true" style="font-size: 20px; color: red"></i>
                                                    </a>
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
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($offices as $office)
                                            <tr id="prueba" class="professionalsTableOffice">
                                                <td>{{ $office->id }}</td>
                                                <td>{{ $office->name }}</td>
                                                <td>{{ $office->address }}</td>
                                                <td>{{ $office->phone_primary }}</td>
                                                <td>{{ $office->phone_secondary }}</td>
                                                <td>{{ $office->email }}</td>
                                                <td class="professionalsTableOfficeTd">
                                                    <a class="edit" href="#">
                                                        <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px; color: #007bff"></i>
                                                    </a>
                                                    <a onclick="return confirm('Seguro que desea continuar?')" href="{{ route('getDeleteOffice', ['officeId' => $office->id]) }}">
                                                        <i class="fa fa-minus-square" aria-hidden="true" style="font-size: 20px; color: red"></i>
                                                    </a>
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
                    <div class="row">
                    <div class="col-4">
                            <h3 class="text-center margin-bottom-20">Crea un profesional</h3>
                            <div>
                                <!-- CREATEPROFESSIONAL FORM -->
                                <form id="postCreateProfessionalForm" class="confirm login100-form validate-form center_div" action="{{ route('postCreateProfessional') }}" method="post">
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
                            <h3 class="text-center margin-bottom-20">Crea un area</h3>
                            <div>
                                <!-- CREATRECOMMENDATIONEAREA FORM -->
                                <form id="postCreateRecommendationAreaForm" class="confirm login100-form validate-form center_div" action="{{ route('postCreateRecommendationArea') }}" method="post">
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
                            <h3 class="text-center margin-bottom-20">Crea un consultorio</h3>
                            <div>
                                <!-- CREATEOFFICE FORM -->
                                <form id="postCreateOfficeForm" class="confirm login100-form validate-form center_div" action="{{ route('postCreateOffice') }}" method="post">
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
                                <form id="postAssignAreaToProfessional" class="login100-form validate-form center_div" action="{{ route('postAssignAreaToProfessional') }}" method="post">
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
                                <form id="postAssignOfficeToProfessionalForm" class="login100-form validate-form center_div" action="{{ route('postAssignOfficeToProfessional') }}" method="post">
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
        <!-- MODAL AREA -->
        <div class="modal fade" id="professionalsModalEditRecommendationArea" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- MODAL HEADER WITH TITLE AND CLOSE BUTTON -->
                    <div class="modal-header">
                        <h3 class="modal-title">Editar area de recomendacion</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- MODAL BODY -->
                    <div class="modal-body">
                        <div>
                            <!-- MODAL AREA FORM -->
                            <form id="professionalsModalRecommendationAreaForm" class="login100-form validate-form center_div">
                                <div class="wrap-input100">
                                    <input id="professionalsModalRecommendationAreaFormName" class="input100" type="text" name="name">
                                </div>
                                <div class="wrap-input100">
                                    <textarea id="professionalsModalRecommendationAreaFormDescription" class="input100" type="text" name="description"></textarea>
                                </div>
                            </form>
                            <!-- MODAL AREA FORM -->
                        </div>
                    </div>
                    <!-- MODAL FOOTER -->
                    <div class="modal-footer">
                        <div class="login100-form validate-form center_div">
                            <div class="container-login100-form-btn">
                                <button id="professionalsModalRecommendationAreaFormIdSubmit" type="button" class="login100-form-btn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL AREA -->
        <!-- MODAL PROFESSIONAL -->
        <div class="modal fade" id="professionalsModalEditProfessional" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- MODAL HEADER WITH TITLE AND CLOSE BUTTON -->
                    <div class="modal-header">
                        <h3 class="modal-title">Editar profesional</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- MODAL BODY -->
                    <div class="modal-body">
                        <div>
                            <!-- MODAL PROFESSIONAL FORM -->
                            <form id="professionalsModalProfessionalForm" class="login100-form validate-form center_div">
                                <div class="wrap-input100">
                                    <input id="professionalsModalProfessionalFormNames" class="input100" type="text" name="name">
                                </div>
                                <div class="wrap-input100">
                                    <input id="professionalsModalProfessionalFormLastNames" class="input100" type="text" name="phonePrimary">
                                </div>
                                <div class="wrap-input100">
                                    <input id="professionalsModalProfessionalFormTitle" class="input100" type="text" name="phoneSecondary">
                                </div>
                                <div class="wrap-input100">
                                    <input id="professionalsModalProfessionalFormProfession" class="input100" type="text" name="phoneSecondary">
                                </div>
                                <div class="wrap-input100">
                                    <input id="professionalsModalProfessionalFormEmail" class="input100" type="email" name="email">
                                </div>
                                <div class="wrap-input100">
                                    <input id="professionalsModalProfessionalFormPhone" class="input100" type="number" name="phoneSecondary">
                                </div>
                                <div class="wrap-input100">
                                    <select id="professionalsModalProfessionalFormRecommendationArea" class="input100" name="type">
                                        <option disabled selected value>Seleccione area</option>
                                        @foreach($recommendationAreas as $area)
                                            <option value={{ $area->id }}>{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="wrap-input100">
                                    <select id="professionalsModalProfessionalFormOffice" class="input100" name="type">
                                        <option disabled selected value>Seleccione consultorio</option>
                                        @foreach($offices as $office)
                                            <option value={{ $office->id }}>{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            <!-- MODAL PROFESSIONAL FORM -->
                        </div>
                    </div>
                    <!-- MODAL FOOTER -->
                    <div class="modal-footer ">
                        <div class="login100-form validate-form center_div">
                            <div class="container-login100-form-btn">
                                <button id="professionalsModalProfessionalFormIdSubmit" type="button" class="login100-form-btn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL PROFESSIONAL -->
        <!-- MODAL OFFICE -->
        <div class="modal fade" id="professionalsModalEditOffice" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- MODAL HEADER WITH TITLE AND CLOSE BUTTON -->
                    <div class="modal-header">
                        <h3 class="modal-title">Editar consultorio</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- MODAL BODY -->
                    <div class="modal-body">
                        <div>
                            <!-- MODAL OFFICE FORM -->
                            <form id="professionalsModalOfficeForm" class="login100-form validate-form center_div">
                                <div class="wrap-input100">
                                    <input id="professionalsModalOfficeFormName" class="input100" type="text" name="name">
                                </div>
                                <div class="wrap-input100">
                                    <input id="professionalsModalOfficeFormPhonePrimary" class="input100" type="number" name="phonePrimary">
                                </div>
                                <div class="wrap-input100">
                                    <input id="professionalsModalOfficeFormPhoneSecondary" class="input100" type="number" name="phoneSecondary">
                                </div>
                                <div class="wrap-input100">
                                    <input id="professionalsModalOfficeFormEmail" class="input100" type="email" name="email">
                                </div>
                                <div class="wrap-input100">
                                    <textarea id="professionalsModalOfficeFormAddress" class="input100" type="text" name="address"></textarea>
                                </div>
                            </form>
                            <!-- MODAL OFFICE FORM -->
                        </div>
                    </div>
                    <!-- MODAL FOOTER -->
                    <div class="modal-footer ">
                        <div class="login100-form validate-form center_div">
                            <div class="container-login100-form-btn">
                                <button id="professionalsModalOfficeFormIdSubmit" type="button" class="login100-form-btn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL OFFICE -->
        @include('scripts.script_Login_v1')
        @include('scripts.datatables')
        <script src="{{asset ('js/appProfessionalsView.js')}}"></script>
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
        <!-- ROUTE -->
        <script>
            var token = '{{ Session::token() }}';
            var urlRecommendationArea = '{{ route('postUpdateRecommendationArea') }}';
            var urlProfessional = '{{ route('postUpdateProfessional') }}';
            var urlOffice = '{{ route('postUpdateOffice') }}';
        </script>
        <!-- ROUTE -->
        @include('scripts.confirm_message_block')
    </body>
</html>
