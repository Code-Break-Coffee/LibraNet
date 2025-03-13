<?php
//------------------------------------------------------------------Get Requests
// $router->get("/","HomeController@index",["auth"]);
$router->get("/","UserController@index",["guest"]);
$router->get("/forgot-password","UserController@forgotPassword",["guest"]);
$router->get("/signup","UserController@signup",["guest"]);
// $router->get("/","HomeController@index");
$router->get("/admin-dashboard","HomeController@AdminDashboard");