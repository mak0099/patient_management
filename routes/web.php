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

//Route::get('/', function () {
//    return view('dashboard');
//});

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@getIndex']);
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@getDashboard']);


//Doctor
Route::prefix('doctor')->group(function() {
    Route::get('/patient', ['as' => 'patient', 'uses' => 'PatientController@patientEntry']);
    Route::post('/find-patient', ['as' => 'find_patient', 'uses' => 'PatientController@findPatient']);
    Route::post('/save-patient', ['as' => 'save_patient', 'uses' => 'PatientController@savePatient']);
    Route::get('/patient-info/{patient_id}', ['as' => 'patient_info', 'uses' => 'PatientController@patientInfo']);

    //Prescription
    Route::get('/view-prescription/{id}', ['as' => 'view_prescription', 'uses' => 'PatientController@viewPrescription']);
    Route::get('/add-prescription/{patient_id}', ['as' => 'add_prescription', 'uses' => 'PatientController@addPrescription']);
    Route::post('/add-medicine-to-prescription', ['as' => 'add_medicine_to_prescription', 'uses' => 'PatientController@addMedicineToPrescription']);
    Route::get('/save-prescription/{patient_id}', ['as' => 'save_prescription', 'uses' => 'PatientController@savePrescription']);
    Route::post('/add-test-to-prescription', ['as' => 'add_test_to_prescription', 'uses' => 'PatientController@addTestToPrescription']);
    Route::get('/delete-test-from-prescription/{id}', ['as' => 'delete_test_from_prescription', 'uses' => 'PatientController@deleteTestFromPrescription']);
    Route::post('/add-symptom-to-prescription', ['as' => 'add_symptom_to_prescription', 'uses' => 'PatientController@addSymptomToPrescription']);
    Route::get('/delete-symptom-from-prescription/{id}', ['as' => 'delete_symptom_from_prescription', 'uses' => 'PatientController@deleteSymptomFromPrescription']);
    Route::get('/delete-medicine-from-prescription/{id}', ['as' => 'delete_medicine_from_prescription', 'uses' => 'PatientController@deleteMedicineFromPrescription']);
    Route::get('/delete-all-from-prescription', ['as' => 'delete_all_from_prescription', 'uses' => 'PatientController@deleteAllFromPrescription']);
});
//Pathology
Route::prefix('pathology')->group(function() {
    Route::get('/patient', 'PathologyController@patientEntry')->name('patient_by_pathology');
    Route::post('/search-patient', 'PathologyController@searchPatient')->name('search_patient_by_pathology');
    Route::get('/find-patient/{id}', 'PathologyController@findPatient')->name('find_patient_by_pathology');
    Route::post('/search-prescription', 'PathologyController@searchPrescription')->name('search_prescription_by_pathology');
    Route::get('/find-prescription/{id}', 'PathologyController@findPrescription')->name('find_prescription_by_pathology');
});
//Pharmacy
Route::prefix('pharmacy')->group(function() {
    Route::get('/patient', 'PharmacyController@patientEntry')->name('patient_by_pharmacy');
    Route::post('/search-patient', 'PharmacyController@searchPatient')->name('search_patient_by_pharmacy');
    Route::get('/find-patient/{id}', 'PharmacyController@findPatient')->name('find_patient_by_pharmacy');
    Route::post('/search-prescription', 'PharmacyController@searchPrescription')->name('search_prescription_by_pharmacy');
    Route::get('/find-prescription/{id}', 'PharmacyController@findPrescription')->name('find_prescription_by_pharmacy');
});


//Medicine
Route::get('/list-medicine', ['as' => 'list_medicine', 'uses' => 'MedicineController@listMedicine']);
Route::get('/add-medicine', ['as' => 'add_medicine', 'uses' => 'MedicineController@addMedicine']);
Route::post('/save-medicine', ['as' => 'save_medicine', 'uses' => 'MedicineController@saveMedicine']);
Route::get('/edit-medicine/{id}', ['as' => 'edit_medicine', 'uses' => 'MedicineController@editMedicine']);
Route::post('/update-medicine/{id}', ['as' => 'update_medicine', 'uses' => 'MedicineController@updateMedicine']);
Route::get('/unpublish-medicine/{id}', ['as' => 'unpublish_medicine', 'uses' => 'MedicineController@unpublishMedicine']);
Route::get('/publish-medicine/{id}', ['as' => 'publish_medicine', 'uses' => 'MedicineController@publishMedicine']);
Route::get('/delete-medicine/{id}', ['as' => 'delete_medicine', 'uses' => 'MedicineController@deleteMedicine']);
Route::get('/search-medicine', ['as' => 'search_medicine', 'uses' => 'MedicineController@searchMedicine']);
Route::post('/find-medicine', ['as' => 'find_medicine', 'uses' => 'MedicineController@findMedicine']);

//Medical Test
Route::get('/list-test', ['as' => 'list_test', 'uses' => 'MedicalTestController@listTest']);
Route::get('/add-test', ['as' => 'add_test', 'uses' => 'MedicalTestController@addTest']);
Route::post('/save-test', ['as' => 'save_test', 'uses' => 'MedicalTestController@saveTest']);
Route::get('/edit-test/{id}', ['as' => 'edit_test', 'uses' => 'MedicalTestController@editTest']);
Route::post('/update-test/{id}', ['as' => 'update_test', 'uses' => 'MedicalTestController@updateTest']);
Route::get('/unpublish-test/{id}', ['as' => 'unpublish_test', 'uses' => 'MedicalTestController@unpublishTest']);
Route::get('/publish-test/{id}', ['as' => 'publish_test', 'uses' => 'MedicalTestController@publishTest']);
Route::get('/delete-test/{id}', ['as' => 'delete_test', 'uses' => 'MedicalTestController@deleteTest']);


