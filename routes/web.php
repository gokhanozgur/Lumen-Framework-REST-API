<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get("/", "UseServiceController@testGuzzle");


$router->group(["prefix" => "api/course"],function () use ($router){

    $router->post("/add", "CourseServiceController@addNewCourse");

    $router->get("/list", "CourseServiceController@getAllCourseList");

    $router->put("/update", "CourseServiceController@updateCourse");

    $router->delete("/delete", "CourseServiceController@deleteCourse");

});


$router->get("/getcoursesfromapi","UseServiceController@getAllCourses");

$router->get("/addcoursewithapi","UseServiceController@addNewCourse");

$router->get("updatecoursewithapi","UseServiceController@updateCourse");

$router->get("deletecoursewithapi","UseServiceController@deleteCourse");
