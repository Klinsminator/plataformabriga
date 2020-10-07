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
                                            <tr id="prueba" class="symptomsTableSymptoms">
                                                <td>{{ $symptom->id }}</td>
                                                <td>{{ $symptom->name }}</td>
                                                <td>{{ $symptom->description }}</td>
                                                <td class="symptomsTableSymptomsTd">
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
                            <h3 class="margin-bottom-20">Recomendaciones</h3>
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
                                            <tr id="prueba" class="symptomsTableRecommendations">
                                                <td>{{ $recommendation->id }}</td>
                                                <td>{{ $recommendation->name }}</td>
                                                <td>{{ $recommendation->description }}</td>
                                                <td class="symptomsTableRecommendationsTd">
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
        <!-- MODAL SYMPTOM -->
        <div class="modal fade" id="symptomsModalEditSymptom" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- MODAL HEADER WITH TITLE AND CLOSE BUTTON -->
                    <div class="modal-header">
                        <h3 class="modal-title">Editar sintoma</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- MODAL BODY -->
                    <div class="modal-body">
                        <div>
                            <!-- MODAL SYMPTOM FORM -->
                            <form id="symptomsModalSymptomForm" class="login100-form validate-form center_div">
                                <div class="wrap-input100">
                                    <input id="symptomsModalSymptomFormName" class="input100" type="text" name="name">
                                </div>
                                <div class="wrap-input100">
                                    <textarea id="symptomsModalSymptomFormDescription" class="input100" type="text" name="description"></textarea>
                                </div>
                            </form>
                            <!-- MODAL SYMPTOM FORM -->
                        </div>
                    </div>
                    <!-- MODAL FOOTER -->
                    <div class="modal-footer">
                        <div class="login100-form validate-form center_div">
                            <div class="container-login100-form-btn">
                                <button id="symptomsModalSymptomFormIdSubmit" type="button" class="login100-form-btn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL SYMPTOM -->
        <!-- MODAL RECOMMENDATION -->
        <div class="modal fade" id="symptomsModalEditRecommendation" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- MODAL HEADER WITH TITLE AND CLOSE BUTTON -->
                    <div class="modal-header">
                        <h3 class="modal-title">Editar recomendacion</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- MODAL BODY -->
                    <div class="modal-body">
                        <div>
                            <!-- MODAL RECOMMENDATION FORM -->
                            <form id="symptomsModalRecommendationForm" class="login100-form validate-form center_div">
                                <div class="wrap-input100">
                                    <input id="symptomsModalRecommendationFormName" class="input100" type="text" name="name">
                                </div>
                                <div class="wrap-input100">
                                    <textarea id="symptomsModalRecommendationFormDescription" class="input100" type="text" name="description"></textarea>
                                </div>
                            </form>
                            <!-- MODAL RECOMMENDATION FORM -->
                        </div>
                    </div>
                    <!-- MODAL FOOTER -->
                    <div class="modal-footer ">
                        <div class="login100-form validate-form center_div">
                            <div class="container-login100-form-btn">
                                <button id="symptomsModalRecommendationFormIdSubmit" type="button" class="login100-form-btn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL RECOMMENDATION -->
        @include('scripts.script_Login_v1')
        @include('scripts.datatables')
        <script src="{{asset ('js/appSymptomsView.js')}}"></script>
        <script>
            $(document).ready(function() {
                $('#symptoms').DataTable({
                    "scrollX": true
                });
            } );
        </script>
        <script>
            $(document).ready(function() {
                $('#recommendations').DataTable();
            } );
        </script>
        <!-- ROUTE -->
        <script>
            var token = '{{ Session::token() }}';
            var urlSymptom = '{{ route('postUpdateSymptom') }}';
            var urlRecommendation = '{{ route('postUpdateRecommendation') }}';
        </script>
        <!-- ROUTE -->
        @include('scripts.confirm_message_block')
    </body>
</html>
