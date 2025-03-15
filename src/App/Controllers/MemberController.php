<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;

class MemberController
{
    protected $db;

    /**
     * Database Instance
     * @return void
     */
    public function __construct()
    {
        $config = require_once basePath("config/db.php");
        $this->db = new Database($config);
    }

    /**
     * Show the Sign In page
     * @return void
     */
    public function index()
    {
        load("Member/Signin.member");
    }

    /**
     * Sign In the Member
     * @return void
     */
    public function memberSignin()
    {
        $email = $_POST["member_signin_email"];
        $password = $_POST["member_signin_password"];
        $errors = [];

        if(!Validation::email($email))
        {
            $errors["email"] = "Invalid Email !!!";
        }
        if(!Validation::string($password,8,50))
        {
            $errors["password"] = "Password length should be between 8 to 50 characters !!!";
        }

        if(!empty($errors))
        {
            load("Member/Signin.member",["errors" => $errors]);
            exit;
        }

        $params=[
            "Email" => $email
        ];
        $member = $this->db->query("SELECT * from member where Email = :Email",$params)->fetch();
        if(!$member)
        {
            $errors["email"] = "Invalid Email or Password !!!";
            load("Member/Signin.member",["errors" => $errors]);
            exit;
        }
        if(!password_verify($password,$member->Password))
        {
            $errors["email"] = "Invalid Email or Password !!!";
            load("Member/Signin.member",["errors" => $errors]);
            exit;
        }
        Session::set("member",[
            "Id" => $member->Id,
        ]);
        redirect("/member-dashboard");
    }

    /**
     * Show the Forgot Password page
     * @return void
     */
    public function memberForgotPassword()
    {
        load("Member/ForgotPassword.member");
    }

    /**
     * Show the Sign Up page
     * @return void
     */
    public function memberSignup()
    {
        load("Member/Signup.member");
    }

    /**
     * Show the Member Dashboard
     * @return void
     */
    public function memberDashboard()
    {
        load("Member/Dashboard.member");
    }
}