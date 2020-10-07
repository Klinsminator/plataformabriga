<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>PA | Sintomas y Recomendaciones</title>
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
                            <h3 class="margin-bottom-20">Sintomas</h3>
                            <div>
                                <!-- SYMPTOMS TABLE -->
                                <table id="symptoms" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($symptoms as $symptom)
                                            <tr id="prueba" class="professionalsTableRecommendationArea">
                                                <td>{{ $symptom->id }}</td>
                                                <td>{{ $symptom->name }}</td>
                                                <td>{{ $symptom->description }}</td>
                                                <td class="professionalsTableRecommendationAreaTd">
                                                    <a class="edit" href="#">
                                                        <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px; color: #007bff"></i>
                                                    </a>
                                                    <a onclick="return confirm('Seguro que desea continuar?')" href="{{ route('getDeleteSymptom', ['symptomId' => $symptom->id]) }}">
                                                        <i class="fa fa-minus-square" aria-hidden="true" style="font-size: 20px; color: red"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- SYMPTOMS TABLE -->
                            </div>
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="margin-bottom-20">Profesionales</h3>
                            <div>
                                <!-- RECOMMENDATIONS TABLE -->
                                <table id="recommendations" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($recommendations as $recommendation)
                                            <tr id="prueba" class="professionalsTableRecommendationArea">
                                                <td>{{ $recommendation->id }}</td>
                                                <td>{{ $recommendation->name }}</td>
                                                <td>{{ $recommendation->description }}</td>
                                                <td class="professionalsTableRecommendationAreaTd">
                                                    <a class="edit" href="#">
                                                        <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px; color: #007bff"></i>
                                                    </a>
                                                    <a onclick="return confirm('Seguro que desea continuar?')" href="{{ route('getDeleteRecommendation', ['recommendationId' => $recommendation->id]) }}">
                                                        <i class="fa fa-minus-square" aria-hidden="true" style="font-size: 20px; color: red"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- RECOMMENDATIONS TABLE -->
                            </div>
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="text-center margin-bottom-20">Crea un sintoma</h3>
                            <div>
                                <!-- CREATESYMPTOM FORM -->
                                <form id="createSymptomForm" class="confirm login100-form validate-form center_div" action="{{ route('postCreateSymptom') }}" method="post">
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
                                <!-- CREATESYMPTOM FORM -->
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="text-center margin-bottom-20">Crea una recomendacion</h3>
                            <div>
                                <!-- CREATERECOMMENDATION FORM -->
                                <form id="createRecommendationForm" class="confirm login100-form validate-form center_div" action="{{ route('postCreateRecommendation') }}" method="post">
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
                                <!-- CREATERECOMMENDATION FORM -->
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
                            <!-- TYPE FORM -->
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
                            <!-- TYPE FORM -->
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
                            <!-- TYPE FORM -->
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
                            <!-- TYPE FORM -->
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
