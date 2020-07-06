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

Route::post('/postCreateUserType', [
    'uses' => 'UserTypeController@createUserType',
    'as' => 'createUserType'
]);

Route::get('/users', [
    'uses' => 'UserController@getUsersView',
    'as' => 'users'
]);

/*---------- PROFESSIONALS ----------*/
Route::post('/postCreateRecommendationArea', [
    'uses' => 'RecommendationAreaController@postCreateRecommendationArea',
    'as' => 'createRecommendationArea'
]);

Route::post('/postCreateProfessional', [
    'uses' => 'ProfessionalController@postCreateProfessional',
    'as' => 'createProfessional'
]);

Route::post('/postCreateOffice', [
    'uses' => 'OfficeController@postCreateOffice',
    'as' => 'createOffice'
]);

Route::post('/postAssignAreaToProfessional', [
    'uses' => 'ProfessionalController@postAssignAreaToProfessional',
    'as' => 'assignAreaToProfessional'
]);

Route::post('/postAssignOfficeToProfessional', [
    'uses' => 'ProfessionalController@postAssignOfficeToProfessional',
    'as' => 'assignOfficeToProfessional'
]);

Route::get('/professionals', [
    'uses' => 'ProfessionalController@getProfessionalsView',
    'as' => 'professionals'
]);
