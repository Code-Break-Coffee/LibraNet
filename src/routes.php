<?php
//------------------------------------------------------------------Get Requests

//----Member
$router->get("/","MemberController@index",["guest-member"]);
$router->get("/member-forgot-password","MemberController@memberForgotPassword",["guest-member"]);
$router->get("/member-signup","MemberController@memberSignup",["guest-member"]);
$router->get("/member-dashboard","MemberController@memberDashboard",["auth-member"]);

//----Incharge
$router->get("/incharge-dashboard","InchargeController@inchargeDashboard",["auth-incharge"]);
$router->get("/incharge-signin","InchargeController@index",["guest-incharge"]);

//------------------------------------------------------------------Post Requests

//----Member
$router->post("/member-signin","MemberController@memberSignin",["guest-member"]);

//----Incharge
$router->post("/incharge-signin","InchargeController@inchargeSignin",["guest-incharge"]);
$router->get("/incharge-signout","InchargeController@inchargeSignout",["auth-incharge"]);
