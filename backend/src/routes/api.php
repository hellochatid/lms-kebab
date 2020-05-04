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
    Route::group([
        'prefix' => 'iam'
    ], function () {
        Route::post('login/{role}', 'IAM\LoginController@login');
        Route::post('register_existing_user', 'IAM\UserController@registerExistingUser');
        Route::post('register', 'IAM\UserController@register');
        Route::post('verify_user', 'IAM\UserController@verifyUser');
        Route::get('is_user_exists', 'IAM\UserController@isUserExists');
    });

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
        Route::post('lessons/orders', 'Admin\LessonsController@setLessonOrders');
        Route::delete('lessons/{id}', 'Admin\LessonsController@deleteLessons');

        // Materials
        Route::post('materials', 'Admin\MaterialsController@addMaterials');
        Route::get('materials', 'Admin\MaterialsController@getMaterials');
        Route::patch('materials/{id}', 'Admin\MaterialsController@editMaterials');
        Route::delete('materials/{id}', 'Admin\MaterialsController@deleteMaterials');

        // Quiz
        Route::post('quiz', 'Admin\QuizController@addQuiz');
        Route::get('quiz', 'Admin\QuizController@getQuiz');
        Route::patch('quiz/{id}', 'Admin\QuizController@editQuiz');
        Route::delete('quiz/{id}', 'Admin\QuizController@deleteQuiz');

        // Questions
        Route::post('questions', 'Admin\QuestionsController@addQuestion');
        Route::get('questions', 'Admin\QuestionsController@getQuestion');
        Route::patch('questions/{id}', 'Admin\QuestionsController@editQuestion');
        Route::delete('questions/{id}', 'Admin\QuestionsController@deleteQuestion');

        // Answers
        Route::post('answers', 'Admin\AnswersController@addAnswer');
        Route::get('answers', 'Admin\AnswersController@getAnswer');
        Route::patch('answers/{id}', 'Admin\AnswersController@editAnswer');
        Route::delete('answers/{id}', 'Admin\AnswersController@deleteAnswer');
    });
    Route::post('upload', 'uploadController@upload');
});
