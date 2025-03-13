<?php
//------------------------------------------------------------------Get Requests
// $router->get("/","HomeController@index",["auth"]);
$router->get("/signin","UserController@index",["guest"]);
$router->get("/forgot-password","UserController@forgotPassword",["guest"]);
$router->get("/signup","UserController@signup",["guest"]);

$router->get("/","HomeController@index");
$router->get("/admin_dashboard","HomeController@AdminDashboard");