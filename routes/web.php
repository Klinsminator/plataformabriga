<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*---------- LOGIN ----------*/
Route::post('/signup', [
    'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);

/*---------- DASHBOARD ----------*/
Route::get('/dashboard', [
    'uses' => 'UserController@getDashboard',
    'as' => 'dashboard',
    'middleware' => 'auth'
]);

/*---------- USERS ----------*/
Route::post('/signin', [
    'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);

Route::post('/postUpdateUser', [
    'uses' => 'UserController@postUpdateUser',
    'as' => 'postUpdateUser',
    'middleware' => 'auth'
]);

Route::get('/getDeleteUser/{userId}', [
    'uses' => 'UserController@getDeleteUser',
    'as' => 'getDeleteUser',
    'middleware' => 'auth'
]);

Route::post('/postCreateUserType', [
    'uses' => 'UserTypeController@postCreateUserType',
    'as' => 'postCreateUserType',
    'middleware' => 'auth'
]);

Route::post('/postUpdateUserType', [
    'uses' => 'UserTypeController@postUpdateUserType',
    'as' => 'postUpdateUserType',
    'middleware' => 'auth'
]);

Route::get('/getDeleteUserType/{userTypeId}', [
    'uses' => 'UserTypeController@getDeleteUserType',
    'as' => 'getDeleteUserType',
    'middleware' => 'auth'
]);

Route::get('/users', [
    'uses' => 'UserController@getUsersView',
    'as' => 'users'
]);

/*---------- PROFESSIONALS ----------*/
Route::post('/postCreateRecommendationArea', [
    'uses' => 'RecommendationAreaController@postCreateRecommendationArea',
    'as' => 'postCreateRecommendationArea',
    'middleware' => 'auth'
]);

Route::post('/postUpdateRecommendationArea', [
    'uses' => 'RecommendationAreaController@postUpdateRecommendationArea',
    'as' => 'postUpdateRecommendationArea',
    'middleware' => 'auth'
]);

Route::get('/getDeleteRecommendationArea/{recommendationAreaId}', [
    'uses' => 'RecommendationAreaController@getDeleteRecommendationArea',
    'as' => 'getDeleteRecommendationArea',
    'middleware' => 'auth'
]);

Route::post('/postCreateProfessional', [
    'uses' => 'ProfessionalController@postCreateProfessional',
    'as' => 'postCreateProfessional',
    'middleware' => 'auth'
]);

Route::post('/postUpdateProfessional', [
    'uses' => 'ProfessionalController@postUpdateProfessional',
    'as' => 'postUpdateProfessional',
    'middleware' => 'auth'
]);

Route::get('/getDeleteProfessional/{professionalId}', [
    'uses' => 'ProfessionalController@getDeleteProfessional',
    'as' => 'getDeleteProfessional',
    'middleware' => 'auth'
]);

Route::post('/postCreateOffice', [
    'uses' => 'OfficeController@postCreateOffice',
    'as' => 'postCreateOffice',
    'middleware' => 'auth'
]);

Route::post('/postUpdateOffice', [
    'uses' => 'OfficeController@postUpdateOffice',
    'as' => 'postUpdateOffice',
    'middleware' => 'auth'
]);

Route::get('/getDeleteOffice/{officeId}', [
    'uses' => 'OfficeController@getDeleteOffice',
    'as' => 'getDeleteOffice',
    'middleware' => 'auth'
]);

Route::post('/postAssignAreaToProfessional', [
    'uses' => 'ProfessionalController@postAssignAreaToProfessional',
    'as' => 'postAssignAreaToProfessional',
    'middleware' => 'auth'
]);

Route::post('/postAssignOfficeToProfessional', [
    'uses' => 'ProfessionalController@postAssignOfficeToProfessional',
    'as' => 'postAssignOfficeToProfessional',
    'middleware' => 'auth'
]);

Route::get('/professionals', [
    'uses' => 'ProfessionalController@getProfessionalsView',
    'as' => 'professionals'
]);

/*---------- SYMPTOMS ----------*/
Route::post('/postCreateSymptom', [
    'uses' => 'SymptomController@postCreateSymptom',
    'as' => 'postCreateSymptom',
    'middleware' => 'auth'
]);

Route::post('/postUpdateSymptom', [
    'uses' => 'SymptomController@postUpdateSymptom',
    'as' => 'postUpdateSymptom',
    'middleware' => 'auth'
]);

Route::get('/getDeleteSymptom/{symptomId}', [
    'uses' => 'OfficeController@getDeleteSymptom',
    'as' => 'getDeleteSymptom',
    'middleware' => 'auth'
]);

Route::post('/postCreateRecommendation', [
    'uses' => 'RecommendationController@postCreateRecommendation',
    'as' => 'postCreateRecommendation',
    'middleware' => 'auth'
]);

Route::post('/postUpdateRecommendation', [
    'uses' => 'RecommendationController@postUpdateRecommendation',
    'as' => 'postUpdateRecommendation',
    'middleware' => 'auth'
]);

Route::get('/getDeleteRecommendation/{recommendationId}', [
    'uses' => 'RecommendationController@getDeleteRecommendation',
    'as' => 'getDeleteRecommendation',
    'middleware' => 'auth'
]);

Route::get('/symptoms', [
    'uses' => 'SymptomController@getSymptomsView',
    'as' => 'symptoms'
]);