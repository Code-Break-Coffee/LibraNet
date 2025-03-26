<?php
//------------------------------------------------------------------Get Requests

//----Member
$router->get("/","MemberController@index",["guest-member"]);
$router->get("/member-forgot-password","MemberController@memberForgotPassword",["guest-member","guest-incharge"]);
$router->get("/member-update-password","MemberController@memberUpdatePassword",["guest-member","guest-incharge"]);
$router->get("/member-signup","MemberController@memberSignup",["guest-member"]);
$router->get("/member-dashboard","MemberController@memberDashboard",["auth-member"]);
$router->get("/member-signout","MemberController@memberSignout",["auth-member"]);

//----Incharge
$router->get("/incharge-dashboard","InchargeController@inchargeDashboard",["auth-incharge"]);
$router->get("/incharge-signin","InchargeController@index",["guest-incharge"]);

//----Incharge Dashboard
$router->get("/incharge-transactions","InchargeController@inchargeTransactions",["auth-incharge"]);
$router->get("/incharge-profile","InchargeController@inchargeProfile",["auth-incharge"]);
$router->get("/add-incharge","InchargeController@addIncharge",["auth-incharge"]);
$router->get("/remove-incharge","InchargeController@removeIncharge",["auth-incharge"]);
$router->get("/incharge-change-profile","InchargeController@changeProfile",["auth-incharge"]);
$router->get("/ban-member","InchargeController@banMember",["auth-incharge"]);
$router->get("/unban-member","InchargeController@unbanMember",["auth-incharge"]);
$router->get("/incharge-change-password","InchargeController@changePass",["auth-incharge"]);

//------------------------------------------------------------------Post Requests

//----Member
$router->post("/member-signin","MemberController@memberSignin",["guest-member"]);
$router->post("/member-forgot-password","MemberController@memberForgotPassword",["guest-member","guest-incharge"]);
$router->post("/member-update-password","MemberController@UpdateforgotPassword",["guest-member","guest-incarge"]);
$router->post("/member-signup","MemberController@memberSignup",["guest-member"]);
$router->post("/add-member","MemberController@addMember",["guest-member"]);

//----Incharge
$router->post("/incharge-signin","InchargeController@inchargeSignin",["guest-incharge"]);
$router->get("/incharge-signout","InchargeController@inchargeSignout",["auth-incharge"]);

//----Incharge Dashboard
$router->post("/add-incharge","InchargeController@addIncharge",["auth-incharge"]);

//----Books
$router->post("/incharge-transactions","BookController@issueBook",["auth-incharge"]);

//------------------------------------------------------------------Put Requests

//----Incharge Dashboard
$router->put("/incharge-ban","InchargeController@inchargeBan",["auth-incharge"]);
$router->put("/incharge-unban","InchargeController@inchargeUnban",["auth-incharge"]);
$router->put("/incharge-change-password","InchargeController@changePassword",["auth-incharge"]);


//----Books
$router->put("/incharge-transactions","BookController@returnBook",["auth-incharge"]);

//------------------------------------------------------------------Delete Requests

//----Incharge
$router->delete("/remove-incharge","InchargeController@deleteIncharge",["auth-incharge"]);
