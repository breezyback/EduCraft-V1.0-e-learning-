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

//Route::get('/home', 'HomeController@index')->name('home');

// Welcome page


//Authentification routes
Auth::routes();

// About page

// ALL GUEST ROUTES
Route::group([
    'prefix' => '/',
    'middleware' => ['web']
    ], function () {
    
    //URL: /
    //ROUTE: welcome
    Route::GET('', 'MainController@show_index')->name('welcome');

    //URL: /about
    //ROUTE: about
    Route::GET('about', 'MainController@show_about')->name('about');

    //URL: /formation/{id}
    //ROUTE: formation_details
    Route::GET('formation/{id}', 'MainController@show_formation_details')->name('formation_details');
    
    //URL: /formation/{id}
    //ROUTE: teacher_delete_course
    Route::DELETE('formation/{id}', 'MainController@teacher_delete_course')->name('teacher_delete_course');

    //URL: /course/{id}
    //ROUTE: course_details
    Route::GET('course/{id}', 'MainController@show_course_details')->name('course_details');

    //URL: /course/{id}
    //ROUTE: course_details
    Route::POST('course/{id}', 'MainController@course_subscription')->name('course_subscription');
    
    //URL: /search/course
    //Route: search_data
    Route::GET('search/course', 'MainController@get_search_data')->name('search_data');

});

// ALL TEACHER ROUTES
Route::group([
    'as' => 'teacher.',
    'prefix' => 'teacher',
    'middleware' => 'auth:teacher'
    ], function () {

    //URL: /teacher/dashboard
    //ROUTE: teacher.dashboard
    Route::GET('dashboard', 'TeacherController@index')->name('dashboard');

    //URL: /teacher/create/courses
    //ROUTE: teacher.create_courses
    Route::GET('create/courses', 'TeacherController@create_cr')->name('create_courses');

    //URL: /teacher/create/tps
    //ROUTE: teacher.create_tps
    Route::GET('create/tps', 'TeacherController@create_tp')->name('create_tps');
    
    //URL: /teacher/create/exams
    //ROUTE: teacher.create_exams
    Route::GET('create/exams', 'TeacherController@create_ex')->name('create_exams');

    // SAVE COURSES
    Route::POST('create/courses', 'TeacherController@store_cr')->name('create_courses');

    // SAVE TPS
    Route::POST('create/tps', 'TeacherController@store_tp')->name('create_tps');

    // SAVE EXAMS
    Route::POST('create/exams', 'TeacherController@store_exam')->name('create_exams');

    //URL: /teacher/update/courses/{id}
    //ROUTE: teacher.get_courses_data
    Route::GET('update/courses/{id}', 'TeacherController@get_courses_data')->name('get_courses_data');

    //URL: /teacher/update/courses
    //ROUTE: teacher.update_courses
    Route::PATCH('update/courses', 'TeacherController@update_course')->name('update_courses');
    
    //URL: /teacher/solutions/tps
    //ROUTE: teacher.show_all_tps_solutions
    Route::GET('solutions/tps', 'TeacherController@show_all_tps_solutions')->name('show_all_tps_solutions');
    
    //URL: /teacher/solutions/tps/details/{id}
    //ROUTE: teacher.show_tp_solution_details
    Route::GET('solutions/tps/details/{id}', 'TeacherController@show_tp_solution_details')->name('show_tp_solution_details');
    
    //URL: /teacher/solutions/tps/details/{id}
    //ROUTE: teacher.update_tp_mark
    Route::PATCH('solutions/tps/details/{id}', 'TeacherController@update_tp_mark')->name('update_tp_mark');
    
    //URL: teacher/solutions/exams
    //ROUTE: teacher.show_all_exams_solutions
    Route::GET('solutions/exams', 'TeacherController@show_all_exams_solutions')->name('show_all_exams_solutions');
    
    //URL: /teacher/solutions/exams/details/{id}
    //ROUTE: teacher.show_all_exam_solutions
    Route::GET('solutions/exams/details/{id}', 'TeacherController@show_exam_solution_details')->name('show_exam_solution_details');

    //URL: /teacher/solutions/exams/details/{id}
    //ROUTE: teacher.update_exam_mark
    Route::PATCH('solutions/exams/details/{id}', 'TeacherController@update_exam_mark')->name('update_exam_mark');

    Route::GET('courses/created/list', 'TeacherController@show_my_courses')->name('show_my_courses');

    Route::DELETE('courses/list', 'MainController@teacher_delete_course')->name('delete_my_course');

    Route::GET('tps/created/list', 'TeacherController@show_my_tps')->name('show_my_tps');

    Route::DELETE('tps/list/{id}', 'TeacherController@delete_my_tps')->name('delete_my_tps');

    Route::PATCH('tps/list/{id}', 'TeacherController@update_my_tps')->name('update_my_tps');

    Route::GET('exams/created/list', 'TeacherController@show_my_exams')->name('show_my_exams');

    Route::DELETE('exams/list/{id}', 'TeacherController@delete_my_exams')->name('delete_my_exams');

});

// ALL ADMIN ROUTES
Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'middleware' => 'auth:admin'
    ], function () {

    //URL: /admin/dashboard
    //ROUTE: admin.dashboard
    Route::GET('dashboard', 'AdminController@index')->name('dashboard');

    //URL: /admin/list/categories
    //ROUTE: admin.show_categories_list
    Route::GET('list/categories', 'AdminController@show_categories_list')->name('show_categories_list');
    
    //URL: /admin/categories/update/{id}
    //ROUTE: admin.update_category
    Route::PATCH('categories/update/{id}', 'AdminController@update_category')->name('update_category');

    //URL: /admin/categories/delete/{id}
    //ROUTE: admin.delete_category
    Route::DELETE('categories/delete/{id}', 'AdminController@delete_category')->name('delete_category');

    //URL: /admin/create/category
    //ROUTE: admin.show_create_category
    Route::GET('create/category', 'AdminController@show_create_category')->name('show_create_category');

    //URL: /admin/create/category
    //ROUTE: admin.create_category
    Route::POST('create/category', 'AdminController@create_category')->name('create_category');

    //URL: /admin/list/formations
    //ROUTE: admin.show_formations_list
    Route::GET('list/formations', 'AdminController@show_formations_list')->name('show_formations_list');

    //URL: /admin/formations/update/{id}
    //ROUTE: admin.update_formation
    Route::PATCH('formations/update/{id}', 'AdminController@update_formation')->name('update_formation');

    //URL: /admin/formations/delete/{id}
    //ROUTE: admin.delete_formation
    Route::DELETE('formations/delete/{id}', 'AdminController@delete_formation')->name('delete_formation');

    //URL: /admin/create/formation
    //ROUTE: admin.show_create_formation
    Route::GET('create/formation', 'AdminController@show_create_formation')->name('show_create_formation');

    //URL: /admin/create/formation
    //ROUTE: admin.create_formation
    Route::POST('create/formation', 'AdminController@create_formation')->name('create_formation');
    
    //URL: /admin/list/courses
    //ROUTE: admin.show_courses_list
    Route::GET('list/courses', 'AdminController@show_courses_list')->name('show_courses_list');

    //URL: /admin/courses/delete/{id}
    //ROUTE: admin.delete_course
    Route::DELETE('courses/delete/{id}', 'AdminController@delete_course')->name('delete_course');

    //URL: /admin/list/exams
    //ROUTE: admin.show_exams_list
    Route::GET('list/exams', 'AdminController@show_exams_list')->name('show_exams_list');

    //URL: /admin/exams/delete/{id}
    //ROUTE: admin.delete_exam
    Route::DELETE('exams/delete/{id}', 'AdminController@delete_exam')->name('delete_exam');

    //URL: /admin/list/tps
    //ROUTE: /admin.show_tps_list
    Route::GET('list/tps', 'AdminController@show_tps_list')->name('show_tps_list');

    //URL: /admin/tps/delete/{id}
    //ROUTE: admin.delete_tp
    Route::DELETE('tps/delete/{id}', 'AdminController@delete_tp')->name('delete_tp');

    //URL: /admin/list/admins
    //ROUTE: admin.show_admins_list
    Route::GET('list/admins', 'AdminController@show_admins_list')->name('show_admins_list');

    //URL: /admin/admins/reset/password/{id}
    //ROUTE: admin.reset_password_admin
    Route::PATCH('admins/reset/password/{id}', 'AdminController@reset_password_admin')->name('reset_password_admin');

    //URL: /admin/admins/update/{id}
    //ROUTE: admin.update_admin
    Route::PATCH('admins/update/{id}', 'AdminController@update_admin')->name('update_admin');

    //URL: admin/admins/delete/{id}
    //ROUTE: admin.delete_admin
    Route::DELETE('admins/delete/{id}', 'AdminController@delete_admin')->name('delete_admin');
    
    //URL: admin/create/account/admin
    //ROUTE: admin.show_create_admin_account
    Route::GET('create/account/admin', 'AdminController@show_create_admin_account')->name('show_create_admin_account');
    
    //URL: admin/create/account/admin
    //ROUTE: admin.create_admin_account
    Route::POST('create/account/admin', 'AdminController@create_admin_account')->name('create_admin_account');

    //URL: /admin/list/teachers
    //ROUTE: admin.show_teachers_list
    Route::GET('list/teachers', 'AdminController@show_teachers_list')->name('show_teachers_list');

    //URL: /admin/teachers/reset/password/{id}
    //ROUTE: admin.reset_password_teacher
    Route::PATCH('teacher/reset/password/{id}', 'AdminController@reset_password_teacher')->name('reset_password_teacher');
    
    //URL: /admin/teachers/update/{id}
    //ROUTE: admin.update_teacher
    Route::PATCH('teachers/update/{id}', 'AdminController@update_teacher')->name('update_teacher');

    //URL: admin/teachers/delete/{id}
    //ROUTE: admin.delete_teacher
    Route::DELETE('teachers/delete/{id}', 'AdminController@delete_teacher')->name('delete_teacher');

    //URL: admin/create/account/teacher
    //ROUTE: admin.show_create_teacher_account
    Route::GET('create/account/teacher', 'AdminController@show_create_teacher_account')->name('show_create_teacher_account');
    
    //URL: admin/create/account/teacher
    //ROUTE: admin.create_teacher_account
    Route::POST('create/account/teacher', 'AdminController@create_teacher_account')->name('create_teacher_account');

    //URL: /admin/list/students
    //ROUTE: admin.show_students_list
    Route::GET('list/students', 'AdminController@show_students_list')->name('show_students_list');

    //URL: /admin/students/reset/password/{id}
    //ROUTE: admin.reset_password_student
    Route::PATCH('students/reset/password/{id}', 'AdminController@reset_password_student')->name('reset_password_student');

    //URL: /admin/students/update/{id}
    //ROUTE: admin.update_student
    Route::PATCH('students/update/{id}', 'AdminController@update_student')->name('update_student');

    //URL: admin/students/delete/{id}
    //ROUTE: admin.delete_teacher
    Route::DELETE('students/delete/{id}', 'AdminController@delete_student')->name('delete_student');


});

// ALL STUDENT ROUTE
Route::group([
    'as' => 'student.',
    'prefix' => 'student',
    'middleware' => 'auth:web'
    ], function () {

    //URL: /student/dashboard
    //ROUTE: student.dashboard
    Route::GET('dashboard', 'StudentController@index')->name('dashboard');

    //URL: /student/courses
    //ROUTE: student.courses
    Route::GET('courses', 'StudentController@show_courses')->name('courses');

    //URL: /student/courses/details/{id}
    //ROUTE: student.courses_details
    Route::GET('courses/details/{id}', 'StudentController@show_details')->name('courses_details');

    // DELETE COURSE
    Route::DELETE('courses/{id}', 'StudentController@delete_course')->name('delete_course');

    //URL: /student/pass/exams/{id}
    //ROUTE: student.pass_exam
    Route::GET('pass/exams/{id}', 'StudentController@pass_exam')->name('pass_exam');
    
    //URL: /student/pass/exams/start/{id}
    //ROUTE: student.start_exam
    Route::GET('pass/exams/start/{id}', 'StudentController@start_exam')->name('start_exam');
    
    //URL: /student/pass/exams/start/{id}
    //ROUTE: student.submit_exam
    Route::POST('pass/exams/start/{id}', 'StudentController@submit_exam')->name('submit_exam');

    Route::GET('exams/to-do/list', 'StudentController@show_exams_todo')->name('show_exams_todo');

    Route::GET('tps/to-do/list', 'StudentController@show_tps_todo')->name('show_tps_todo');
    
});

Route::group([
    'as' => 'profile.',
    'prefix' => 'profile',
    'middleware' => 'auth:admin,teacher,web'
    ], function () {

    Route::GET('student', 'StudentController@show_student_profile')->name('show_student_profile');

    Route::PATCH('student', 'StudentController@update_student_profile')->name('update_student_profile');

    Route::GET('settings/student', 'StudentController@show_student_profile_settings')->name('show_student_profile_settings');

    Route::PATCH('settings/student', 'StudentController@update_student_profile_settings')->name('update_student_profile_settings');

    Route::DELETE('settings/student', 'StudentController@delete_student_profile')->name('delete_student_profile');


    Route::GET('teacher', 'TeacherController@show_teacher_profile')->name('show_teacher_profile');

    Route::PATCH('teacher', 'TeacherController@update_teacher_profile')->name('update_teacher_profile');

    Route::GET('settings/teacher', 'TeacherController@show_teacher_profile_settings')->name('show_teacher_profile_settings');

    Route::PATCH('settings/teacher', 'TeacherController@update_teacher_profile_settings')->name('update_teacher_profile_settings');

    Route::DELETE('settings/teacher', 'TeacherController@delete_teacher_profile')->name('delete_teacher_profile');


    Route::GET('admin', 'AdminController@show_admin_profile')->name('show_admin_profile');

    Route::PATCH('admin', 'AdminController@update_admin_profile')->name('update_admin_profile');

    Route::GET('settings/admin', 'AdminController@show_admin_profile_settings')->name('show_admin_profile_settings');

    Route::PATCH('settings/admin', 'AdminController@update_admin_profile_settings')->name('update_admin_profile_settings');

    Route::DELETE('settings/admin', 'AdminController@delete_admin_profile')->name('delete_admin_profile');
});


/*Route::group(['middleware' => 'auth:admin,teacher,'], function () {
    //

    Route::get('/wow', function() {
        echo "wow";
    });
});*/