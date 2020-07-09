<?php

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
    return \Illuminate\Support\Facades\Redirect::route('home');
});
Route::post('/review/pharmcy', 'ReviewController@store')->name('pharmc.review');
Auth::routes(['verify' => true]);

//Route::middleware(['verified'])->group(function () {
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  Route::resource('/states', 'StateController');
  Route::resource('/donations', 'DonationController');
  Route::resource('/users', 'UserController');
  Route::resource('/settings', 'SettingController');
  Route::put('tasks/{task_id}/run', 'TaskController@run')->name('tasks.run');
  Route::resource('/donations', 'DonationController');
  Route::get('/pharmacy/{id}', 'DashboardController@viewPharmacy')->name('pharmacy.view');
  Route::get('/addPharmacyTraining/{id}', 'TrainingPositionsContoller@addPosition')->name('addPharmacyTraining');
  Route::get('/viewTrainees/{id}', 'TrainingPositionsContoller@viewTrainees')->name('viewTrainees');
  Route::resource('/trainingPositions', 'TrainingPositionsContoller')->name('*', 'trainingPositions');
  Route::get('/updateTraineeStatus/{id}/{status}', 'TrainingPositionsContoller@updateTraineesStatus')->name('updateTraineesStatus');
  Route::get('/editPharmacyProfile/{id}', 'DashboardController@editPharmacyProfile')->name('editPharmacyProfile');
  Route::post('/updatePharmacyProfile/{id}', 'DashboardController@updatePharmacyProfile')->name('updatePharmacyProfile');
  Route::get('/viewTrainee/{id}', 'TrainingPositionsContoller@viewTrainee')->name('viewTrainee');
  Route::get('/downloadTraineeCv/{id}', 'TrainingPositionsContoller@downloadTraineeCv')->name('downloadTraineeCv');
  Route::get('/applyTraining/{userid}/{tid}', 'TrainingPositionsContoller@applyTraining')->name('applyTraining');

  Route::get('/trainee/{id}', 'DashboardController@viewTrainee')->name('trainee.view');
  Route::get('/editTraineeProfile/{id}', 'DashboardController@editTraineeProfile')->name('editTraineeProfile');
  Route::post('/traineeProfile/{id}', 'DashboardController@updateTraineeProfile')->name('traineeProfile.update');


  Route::get('/admin/{id}', 'DashboardController@adminView')->name('admin.view');
  Route::get('/home', 'DashboardController@home')->name('home');
  Route::get('/getPharmacyCount', 'DashboardController@getPharmacyCount')->name('getPharmacyCount');
  Route::get('/search', 'DashboardController@search')->name('search');

  Route::get('/adminpharmacylist', 'DashboardController@adminPharmacyList')->name('adminpharmacylist');
  Route::get('/deletePharmacy/{id}', 'DashboardController@deletePharmacy')->name('deletePharmacy');
  Route::get('/addNewPharmacy', 'DashboardController@addNewPharmacy')->name('addNewPharmacy');
Route::post('addAdminPharmacy', 'DashboardController@addAdminPharmacy')->name('addAdminPharmacy');


Route::get('/adminuserlist', 'DashboardController@adminUserList')->name('adminuserlist');
Route::get('/deleteUser/{id}', 'DashboardController@deleteUser')->name('deleteUser');
Route::get('/addNewUser', 'DashboardController@addNewUser')->name('addNewUser');

Route::post('addAdminUser', 'DashboardController@addAdminUser')->name('addAdminUser');
Route::get('/getPharmacaCount', 'DashboardController@getPharmacaCount')->name('getPharmacaCount');

Route::get('/getCountryPharma/{name}', 'DashboardController@getCountryPharma')->name('getCountryPharma');
Route::post('/updateFilterCity', 'DashboardController@updateFilterCity')->name('updateFilterCity');






//});
