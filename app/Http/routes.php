<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//基础路由
Route::get('basic1', function () {
    return 'Hello world';
});

Route::Post('basic2', function () {
    return 'Basic2';
});

//多请求路由
Route::Match(['get','post'], 'multy1', function (){
    return 'multy1';
});

Route::any('multy2', function () {
    return 'multy2';
});


//路由参数
//Route::get('user/{id}', function ($id){
//    return 'user-id-' . $id;
//});

//Route::get('user/{name?}', function ($name = null){
//    return 'user-name-' . $name;
//});

//Route::get('user/{name?}', function ($name = 'sean'){
//    return 'user-name-' . $name;
//});

//Route::get('user/{name?}', function ($name = 'sean'){
//    return 'user-name-' . $name;
//}) -> where('name', '[a-zA-Z]+');

//Route::get('user/{id}/{name?}', function ($id, $name = 'sean'){
//    return 'user-id-' . $id .' ,user-name-' . $name;
//}) -> where(['id' => '[0-9]+', 'name' => '[a-zA-Z]+']);


//路由别名
//Route::get('user/member-center', ['as' => 'center', function(){
////    return 'member-center';
//    return Route('center');
//}]);

//路由群组
Route::group(['prefix' => 'member'], function () {

    Route::get('user/center', ['as' => 'center', function(){
//    return 'member-center';
        return Route('center');
    }]);

    Route::any('multy2', function () {
        return 'member-multy2';
    });
});

//路由视图
Route::get('view', function (){
    return view('welcome');
});



// 控制器
//Route::get('member/info', 'MemberController@info');

//Route::any('member/info', [
//    'uses' => 'MemberController@info',
//    'as' => 'memberinfo'
//]);

Route::get('member/{id}', 'MemberController@info')
->where(['id' => '[0-9]+']);


/**
 * 数据库操作路由
 */
Route::get('student/test1', 'StudentController1@test1');
Route::get('student/query1', 'StudentController1@query1');
Route::get('student/query2', 'StudentController1@query2');
Route::get('student/query3', 'StudentController1@query3');
Route::get('student/query4', 'StudentController1@query4');
Route::get('student/orm1', 'StudentController1@orm1');
Route::get('student/orm2', 'StudentController1@orm2');
Route::get('student/orm3', 'StudentController1@orm3');
Route::get('student/orm4', 'StudentController1@orm4');

//Route::any('request1', 'StudentController1@request1');
Route::any('student/request1', 'StudentController1@request1');



Route::any('session1', 'StudentController1@session1');
Route::any('session2', 'StudentController1@session2');



Route::any('response', 'StudentController1@response');


// 宣传页面
Route::any('activity0', 'StudentController1@activity0');

// 活动页面
Route::group(['middleware' => ['activity']], function () {
    Route::any('activity1', 'StudentController1@activity1');
    Route::any('activity2', 'StudentController1@activity2');
});

// 表单学习
Route::any('student/index', 'StudentController@index');
Route::any('student/create', 'StudentController@create');
Route::any('student/save', 'StudentController@save');


Route::group(['prefix' => 'collect'], function () {
    Route::any('testPath', 'StudentController1@testPath');
    Route::any('testPath2', 'StudentController1@testPath2');
});




