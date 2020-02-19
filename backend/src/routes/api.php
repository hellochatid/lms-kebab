<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'v1'

], function () {
    Route::post('iam/login', 'IAM\LoginController@login');
    Route::post('iam/register', 'IAM\UserController@register');
    Route::get('iam/verify/{token}', 'IAM\UserController@verifyUser');
    Route::group([
        'middleware' => 'api',
        'prefix' => 'iam'
    ], function () {
        Route::get('me', 'IAM\UserController@me');
    });
    Route::group([
        'middleware' => 'api',
        'prefix' => 'admin'
    ], function () {
        // Pages
        Route::post('pages', 'Admin\PagesController@addPages');
        Route::get('pages', 'Admin\PagesController@getPages');
        Route::patch('pages/{id}', 'Admin\PagesController@editPages');
        Route::delete('pages/{id}', 'Admin\PagesController@deletePages');

        // Menus
        Route::post('menus', 'Admin\MenusController@addMenus');
        Route::get('menus', 'Admin\MenusController@getMenus');
        Route::patch('menus/{id}', 'Admin\MenusController@editMenus');
        Route::delete('menus/{id}', 'Admin\MenusController@deleteMenus');

        // Categories
        Route::post('categories', 'Admin\CategoriesController@addCategory');
        Route::get('categories', 'Admin\CategoriesController@getCategory');
        Route::patch('categories/{id}', 'Admin\CategoriesController@editCategory');
        Route::delete('categories/{id}', 'Admin\CategoriesController@deleteCategory');

        // Courses
        Route::post('courses', 'Admin\CoursesController@addCourses');
        Route::get('courses', 'Admin\CoursesController@getCourses');
        Route::patch('courses/{id}', 'Admin\CoursesController@editCourses');
        Route::delete('courses/{id}', 'Admin\CoursesController@deleteCourses');

        // Lessons
        Route::post('lessons', 'Admin\LessonsController@addLessons');
        Route::get('lessons', 'Admin\LessonsController@getLessons');
        Route::patch('lessons/{id}', 'Admin\LessonsController@editLessons');
        Route::delete('lessons/{id}', 'Admin\LessonsController@deleteLessons');
    });
    Route::post('upload', 'uploadController@upload');
});
