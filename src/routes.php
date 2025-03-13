<?php
//------------------------------------------------------------------Get Requests

//----Member
$router->get("/","MemberController@index",["guest-member"]);
$router->get("/forgot-password","MemberController@forgotPassword",["guest-member"]);
$router->get("/signup","MemberController@signup",["guest-member"]);

//----Incharge
$router->get("/incharge-dashboard","InchargeController@inchargeDashboard",["auth-incharge"]);
$router->get("/incharge-signin","InchargeController@index",["guest-incharge"]);

//------------------------------------------------------------------Post Requests
//----Incharge
$router->post("/incharge-signin","InchargeController@inchargeSignin",["guest-incharge"]);
$router->get("/incharge-signout","InchargeController@inchargeSignout",["auth-incharge"]);
