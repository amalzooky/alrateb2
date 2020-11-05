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


define('PAGINATION_COUNT', 10);
Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/not-allowed', function (){  echo 'غير مسموح لك بالوصول لهذه الصفحه'; })->name('admin.notallowed');
    Route::get('/slidebar', 'DashboardController@sidebar')->name('admin.sidebar');

    ######################### Begin Languages Route ########################
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/', 'LanguagesController@index')->name('admin.languages');
        Route::get('create', 'LanguagesController@create')->name('admin.languages.create');
        Route::post('store', 'LanguagesController@store')->name('admin.languages.store');

        Route::get('edit/{id}', 'LanguagesController@edit')->name('admin.languages.edit');
        Route::post('update/{id}', 'LanguagesController@update')->name('admin.languages.update');

        Route::get('delete/{id}', 'LanguagesController@destroy')->name('admin.languages.delete');


    });
    ######################### End Languages Route ########################
    ######################### Begin zoommetting Routes ########################
    Route::group(['prefix' => 'virtualclass'], function () {
        // zoom
        Route::get('create', 'VirtualClassController@createZoom')->name('admin.virtualclass.create');
        Route::post('store', 'VirtualClassController@storeZOOM')->name('admin.virtualclass.store');
        // index ???
        Route::get('/', 'VirtualClassController@index')->name('admin.virtualclass');
        // wiziq
        Route::get('wiziq/create', 'VirtualClassController@createWiziq')->name('admin.virtualclass.wiziq.create');
        Route::post('wiziq/store', 'VirtualClassController@storeWiziq')->name('admin.virtualclass.wiziq.store');
        // webinar
        Route::get('webinar/create', 'VirtualClassController@createWebinarPage')->name('admin.virtualclass.webinar.create');
        Route::post('webinar/store', 'VirtualClassController@storeWebinar')->name('admin.virtualclass.webinar.store');
        // zoom and wiziq
        Route::get('zoom-wiziq/create', 'VirtualClassController@createZoomWiziq')->name('admin.virtualclass.zoomwiziq.create');
        Route::post('zoom-wiziq/store', 'VirtualClassController@storeZoomWiziq')->name('admin.virtualclass.zoomwiziq.store');
    });

       ######################### Begin Main Categoris Routes ########################
       Route::group(['prefix' => 'main_categories'], function () {
        Route::get('/','MainCategoriesController@index') -> name('admin.maincategories');
        Route::get('create','MainCategoriesController@create') -> name('admin.maincategories.create');
        Route::post('store','MainCategoriesController@store') -> name('admin.maincategories.store');
        Route::get('edit/{id}','MainCategoriesController@edit') -> name('admin.maincategories.edit');
        Route::post('update/{id}','MainCategoriesController@update') -> name('admin.maincategories.update');
        Route::get('delete/{id}','MainCategoriesController@destroy') -> name('admin.maincategories.delete');
        Route::get('changeStatus/{id}','MainCategoriesController@changeStatus') -> name('admin.maincategories.status');
    });
    ######################### End  Main Categoris Routes  ########################
    ######################### Begin Type Users Routes ########################
    Route::group(['prefix' => 'type_users'], function () {
        Route::get('/','TypeUsersController@index') -> name('admin.typeusers');
        Route::get('create','TypeUsersController@create') -> name('admin.typeusers.create');
        Route::post('store','TypeUsersController@store') -> name('admin.typeusers.store');
        Route::get('edit/{id}','TypeUsersController@edit') -> name('admin.typeusers.edit');
        Route::post('update/{id}','TypeUsersController@update') -> name('admin.typeusers.update');
        Route::get('delete/{id}','TypeUsersController@destroy') -> name('admin.typeusers.delete');
        Route::get('changeStatus/{id}','TypeUsersController@changeStatus') -> name('admin.typeusers.status');

    });
    ######################### End  Main Type Users  Routes  ########################

    ######################### Begin school years Routes ########################
    Route::group(['prefix' => 'school_years'], function () {
        Route::get('/','SchoolyearsController@index') -> name('admin.schoolyears');
        Route::get('create','SchoolyearsController@create') -> name('admin.schoolyears.create');
        Route::post('store','SchoolyearsController@store') -> name('admin.schoolyears.store');
        Route::get('edit/{id}','SchoolyearsController@edit') -> name('admin.schoolyears.edit');
        Route::post('update/{id}','SchoolyearsController@update') -> name('admin.schoolyears.update');
        Route::get('delete/{id}','SchoolyearsController@destroy') -> name('admin.schoolyears.delete');
    });
    ######################### End   school years Routes  ########################

    ######################### Begin Majors Routes ########################
    Route::group(['prefix' => 'majors'], function () {
        Route::get('/','MajorsController@index') -> name('admin.majors');
        Route::get('create','MajorsController@create') -> name('admin.majors.create');
        Route::post('store','MajorsController@store') -> name('admin.majors.store');
        Route::get('edit/{id}','MajorsController@edit') -> name('admin.majors.edit');
        Route::post('update/{id}','MajorsController@update') -> name('admin.majors.update');
        Route::get('delete/{id}','MajorsController@destroy') -> name('admin.majors.delete');
    });
    ######################### End Majors Routes  ########################
  ######################### Begin Groups  Routes ########################
  Route::group(['prefix' => 'groupes'], function () {
    Route::get('/','GroupsController@index') -> name('admin.groupes');
    Route::get('create','GroupsController@create') -> name('admin.groupes.create');
    Route::post('store','GroupsController@store') -> name('admin.groupes.store');
    Route::get('edit/{id}','GroupsController@edit') -> name('admin.groupes.edit');
    Route::post('update/{id}','GroupsController@update') -> name('admin.groupes.update');
    Route::get('delete/{id}','GroupsController@destroy') -> name('admin.groupes.delete');
});
######################### End Majors Routes  ########################

    ######################### Begin Subjects Routes ########################
    Route::group(['prefix' => 'subjects'], function () {
        Route::get('/','SubjectsController@index') -> name('admin.subjects');
        Route::get('create','SubjectsController@create') -> name('admin.subjects.create');
        Route::post('store','SubjectsController@store') -> name('admin.subjects.store');
        Route::get('edit/{id}','SubjectsController@edit') -> name('admin.subjects.edit');
        Route::post('update/{id}','SubjectsController@update') -> name('admin.subjects.update');
        Route::get('delete/{id}','SubjectsController@destroy') -> name('admin.subjects.delete');
    });
    ######################### End Subjects Routes  ########################

    ######################### Start lectures Routes  ########################
    Route::group(['prefix' => 'lectures'], function () {
        Route::get('/','LecturesController@index')->name('admin.lectures');
        Route::get('create','LecturesController@create')->name('admin.lectures.create');
        Route::post('store','LecturesController@store')->name('admin.lectures.store');
        Route::get('edit/{id}','LecturesController@edit')->name('admin.lectures.edit');
        Route::post('update/{id}','LecturesController@update')->name('admin.lectures.update');
        Route::get('delete/{id}','LecturesController@destroy')->name('admin.lectures.delete');
    });
    ######################### End lectures Routes  ########################

    ######################### Start schools Routes  ########################
    Route::group(['prefix' => 'schools'], function () {
        Route::get('/','SchoolsItemsController@index') -> name('admin.schoolsitems');
        Route::get('create','SchoolsItemsController@create') -> name('admin.schoolsitems.create');
        Route::post('store','SchoolsItemsController@store') -> name('admin.schoolsitems.store');
        Route::get('edit/{id}','SchoolsItemsController@edit') -> name('admin.schoolsitems.edit');
        Route::post('update/{id}','SchoolsItemsController@update') -> name('admin.schoolsitems.update');
        Route::get('delete/{id}','SchoolsItemsController@destroy') -> name('admin.schoolsitems.delete');
    });
    ######################### End schools Routes  ########################

    ######################### Begin vendors student Routes ########################
    Route::group(['prefix' => 'students'], function () {
        Route::get('/','VendorsController@index') -> name('admin.students');
        Route::get('create','VendorsController@create') -> name('admin.students.create');
        Route::post('store','VendorsController@store') -> name('admin.students.store');
        Route::get('edit/{id}','VendorsController@edit') -> name('admin.students.edit');
        Route::post('update/{id}','VendorsController@update') -> name('admin.students.update');
        Route::get('delete/{id}','VendorsController@destroy') -> name('admin.students.delete');
        Route::get('view/{id}','VendorsController@view') -> name('admin.students.view');
    });
    ######################### End  vendors student Routes  ########################
    ######################### Begin  teachers Routes ########################
    Route::group(['prefix' => 'teachers'], function () {
        Route::get('/','TeachersController@index') -> name('admin.teachers');
        Route::get('create','TeachersController@create') -> name('admin.teachers.create');
        Route::post('store','TeachersController@store') -> name('admin.teachers.store');
        Route::get('edit/{id}','TeachersController@edit') -> name('admin.teachers.edit');
        Route::post('update/{id}','TeachersController@update') -> name('admin.teachers.update');
        Route::get('delete/{id}','TeachersController@destroy') -> name('admin.teachers.delete');
    });
    ######################### End   teachers Routes  ########################

    ######################### Begin  employees Routes ########################
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/','EmployeesController@index') -> name('admin.employees');
        Route::get('create','EmployeesController@create') -> name('admin.employees.create');
        Route::post('store','EmployeesController@store') -> name('admin.employees.store');
        Route::get('edit/{id}','EmployeesController@edit') -> name('admin.employees.edit');
        Route::post('update/{id}','EmployeesController@update') -> name('admin.employees.update');
        Route::get('delete/{id}','EmployeesController@destroy') -> name('admin.employees.delete');
    });
    ######################### End   student Routes  ########################

    
  ######################### Begin  study materials Routes ########################
    Route::group(['prefix' => 'materials'], function () {
        Route::get('/','MaterialsController@index') -> name('admin.materials');
        Route::get('create','MaterialsController@create') -> name('admin.materials.create');
        Route::post('store','MaterialsController@store') -> name('admin.materials.store');
        Route::get('edit/{id}','MaterialsController@edit') -> name('admin.materials.edit');
        Route::post('update/{id}','MaterialsController@update') -> name('admin.materials.update');
        Route::get('delete/{id}','MaterialsController@destroy') -> name('admin.materials.delete');
        Route::get('changeStatus/{id}','MaterialsController@changeStatus') -> name('admin.materials.status');

    });
    ######################### End   student Routes  ########################

  ######################### Begin  mainhome slider Routes ########################
  Route::group(['prefix' => 'slider'], function () {
    Route::get('/','SliderController@index') -> name('admin.slider');
    Route::get('create','SliderController@create') -> name('admin.slider.create');
    Route::post('store','SliderController@store') -> name('admin.slider.store');
    Route::get('edit/{id}','SliderController@edit') -> name('admin.slider.edit');
    Route::post('update/{id}','SliderController@update') -> name('admin.slider.update');
    Route::get('delete/{id}','SliderController@destroy') -> name('admin.slider.delete');
    Route::get('changeStatus/{id}','SliderController@changeStatus') -> name('admin.slider.status');

});

 ######################### Begin  mainhome service Routes ########################
    Route::group(['prefix' => 'services'], function () {
    Route::get('/','ServicesController@index') -> name('admin.services');
    Route::get('create','ServicesController@create') -> name('admin.services.create');
    Route::post('store','ServicesController@store') -> name('admin.services.store');
    Route::get('edit/{id}','ServicesController@edit') -> name('admin.services.edit');
    Route::post('update/{id}','ServicesController@update') -> name('admin.services.update');
    Route::get('delete/{id}','ServicesController@destroy') -> name('admin.services.delete');
    Route::get('changeStatus/{id}','ServicesController@changeStatus') -> name('admin.services.status');

});
######################### End   student Routes  ########################
######################### Begin  mainhome aboutus Routes ########################
Route::group(['prefix' => 'aboutus'], function () {
    Route::get('/','AboutsController@index') -> name('admin.aboutus');
    Route::get('create','AboutsController@create') -> name('admin.aboutus.create');
    Route::post('store','AboutsController@store') -> name('admin.aboutus.store');
    Route::get('edit/{id}','AboutsController@edit') -> name('admin.aboutus.edit');
    Route::post('update/{id}','AboutsController@update') -> name('admin.aboutus.update');
    Route::get('delete/{id}','AboutsController@destroy') -> name('admin.aboutus.delete');
    Route::get('changeStatus/{id}','AboutsController@changeStatus') -> name('admin.aboutus.status');

});
######################### End   student Routes  ########################
######################### Begin  mainhome vision Routes ########################
    Route::group(['prefix' => 'vision'], function () {
    Route::get('/','VisionController@index') -> name('admin.vision');
    Route::get('create','VisionController@create') -> name('admin.vision.create');
    Route::post('store','VisionController@store') -> name('admin.vision.store');
    Route::get('edit/{id}','VisionController@edit') -> name('admin.vision.edit');
    Route::post('update/{id}','VisionController@update') -> name('admin.vision.update');
    Route::get('delete/{id}','VisionController@destroy') -> name('admin.vision.delete');
    Route::get('changeStatus/{id}','VisionController@changeStatus') -> name('admin.vision.status');

});
######################### End   student Routes  ########################
######################### Begin  mainhome Goals Routes ########################
Route::group(['prefix' => 'goald'], function () {
    Route::get('/','GoalsController@index') -> name('admin.goald');
    Route::get('create','GoalsController@create') -> name('admin.goald.create');
    Route::post('store','GoalsController@store') -> name('admin.goald.store');
    Route::get('edit/{id}','GoalsController@edit') -> name('admin.goald.edit');
    Route::post('update/{id}','GoalsController@update') -> name('admin.goald.update');
    Route::get('delete/{id}','GoalsController@destroy') -> name('admin.goald.delete');
    Route::get('changeStatus/{id}','GoalsController@changeStatus') -> name('admin.goald.status');

});
######################### End   slogan Routes  ########################
Route::group(['prefix' => 'slogan'], function () {
    Route::get('/','SloganController@index') -> name('admin.slogan');
    Route::get('create','SloganController@create') -> name('admin.slogan.create');
    Route::post('store','SloganController@store') -> name('admin.slogan.store');
    Route::get('edit/{id}','SloganController@edit') -> name('admin.slogan.edit');
    Route::post('update/{id}','SloganController@update') -> name('admin.slogan.update');
    Route::get('delete/{id}','SloganController@destroy') -> name('admin.slogan.delete');
    Route::get('changeStatus/{id}','SloganController@changeStatus') -> name('admin.slogan.status');

});
######################### End   student Routes  ########################

######################### End   best teacher Routes  ########################
Route::group(['prefix' => 'best-teacher'], function () {
    Route::get('/','BestTeachersController@index') -> name('admin.best-teacher');
    Route::get('create','BestTeachersController@create') -> name('admin.best-teacher.create');
    Route::post('store','BestTeachersController@store') -> name('admin.best-teacher.store');
    Route::get('edit/{id}','BestTeachersController@edit') -> name('admin.best-teacher.edit');
    Route::post('update/{id}','BestTeachersController@update') -> name('admin.best-teacher.update');
    Route::get('delete/{id}','BestTeachersController@destroy') -> name('admin.best-teacher.delete');
    Route::get('changeStatus/{id}','BestTeachersController@changeStatus') -> name('admin.best-teacher.status');

});
######################### End   student Routes  ########################


});


Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'LoginController@getLogin')->name('get.admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login');
});


