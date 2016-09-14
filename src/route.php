<?php

use Alicecore\Route;

Route::get('/', 'IndexController::index'); // 名称：GET_
Route::get('/cms', 'IndexController::cms'); // 名称：GET_

//测试用
Route::get('/haha/{name}', ['_controller'=>'DefaultController::news', '_after_middlewares'=>'sb...']); // 中间件:MiddlewareListener.php 名称：GET_haha_name
Route::get('/test', 'DefaultController::index');
Route::get('/mem', 'DefaultController::memcache');

