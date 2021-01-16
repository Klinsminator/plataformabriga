<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>PA | Perfil de Aplicante</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('includes.head_Login_v1')
    </head>
    <body>
        <div class="limiter">
            <div class="container-login100-greyish">
                <div class="wrap-home100">
                    @include('includes.admin_navbar')
                    @include('includes.message_block')
                    <div class="row">
                        <div class="col-12">
                            <h3 class="margin-bottom-20">Perfil de Ana</h3>
                            <div class="information-block margin-bottom-50">
                                <p>Correo electronico: <strong><a href="mailto:elcorreoquequieres@correo.com">ana@gmail.com</a></strong></p>
                                <p>Pais: <strong>Costa Rica</strong></p>
                                <br>
                                <p>Relacion con el individuo: <strong>Hijo o hija</strong></p>
                                <p>Sexo del individuo: <strong>Masculino</strong></p>
                                <p>Edad del individuo: <strong>15</strong></p>
                            </div>
                            <div class="margin-bottom-50">
                                <h4 class="margin-bottom-20">Datos del formulario</h4>
                                <table id="professionals" class="table table-striped table-bordered" style="width:100%">
                                    <tbody>
                                        <tr id="prueba" class="professionalsTableProfessionals">
                                            <td>¿Llora sin cesar por largos períodos sin razón aparente?</td>
                                            <td><strong>Si</strong></td>
                                        </tr>
                                        <tr id="prueba" class="professionalsTableProfessionals">
                                            <td>¿Se tapa los oídos ante ciertos ruidos?</td>
                                            <td><strong>Si</strong></td>
                                        </tr>
                                        <tr id="prueba" class="professionalsTableProfessionals">
                                            <td>¿Camina de puntillas?</td>
                                            <td><strong>Si</strong></td>
                                        </tr>
                                        <tr id="prueba" class="professionalsTableProfessionals">
                                            <td>¿Presenta carencia de contacto visual con otras personas?</td>
                                            <td><strong>Si</strong></td>
                                        </tr>
                                        <tr id="prueba" class="professionalsTableProfessionals">
                                            <td>¿Atiende cuando se le habla?</td>
                                            <td><strong>Si</strong></td>
                                        </tr>
                                        <tr id="prueba" class="professionalsTableProfessionals">
                                            <td>¿Manifiesta agitaciones o movimientos repetitivos de alguna parte de su cuerpo?</td>
                                            <td><strong>Si</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="margin-bottom-20">Comentario adicional</h4>
                            <div class="information-block margin-bottom-50">
                                <p>
                                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                    voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
                                    cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- COMPLETE RESOLUTION FOR ThE FIRST AND ONLY TIME -->
                    <hr class="dotted">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <label>Intermediario:</label>
                                <select class="input20" name="professionalID">
                                    <option disabled selected value>Seleccione Profesional</option>
                                        <option value="01">Luis Vargas</option>
                                        <option value="02">Jurgen Azofeifa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- COMPLETE RESOLUTION FOR ThE FIRST AND ONLY TIME -->
                </div>
            </div>
        </div>
        @include('scripts.confirm_message_block')
    </body>
</html>
