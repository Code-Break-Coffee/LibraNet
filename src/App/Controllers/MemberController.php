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
     * Sign Out the Member
     * @return void
     */
    public function memberSignout()
    {
        Session::destroy();
        $params = session_get_cookie_params();
        setcookie("PHPSESSID", "", time() - 86400, $params["path"], $params["domain"]);
        redirect("/");
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
        $show_otp_input=false;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email= $_POST["email"];
            $first_name= $_POST["first_name"];
            $middle_name= $_POST["middle_name"];
            $last_name= $_POST["last_name"];
            $phone= $_POST["phone"];
            $address= $_POST["address"];
            $password= $_POST["password"];
            $confirm_password= $_POST["confirm_password"];
            $errors = [];
            $warning = [];
            if(!Validation::email($email))
            {
                $errors["email"] = "Invalid Email !!!";
            }
            if(!Validation::match($password,$confirm_password))
            {
                $errors["password"] = "Password and Confirm Password should be same !!!";
            }
            if(!Validation::string($password,8,50)){
                $errors["password"] = "Password length should be between 8 to 50 characters !!!";
            }
            if(!Validation::string($address,0,60))
            {
                $errors["address"] = "Invalid Address !!!";
            }
            if(!Validation::phone($phone))
            {
                $errors["phone"] = "Invalid Phone Number !!!";
            }
            if(!Validation::string($first_name,1,15))
            {
                $errors["first_name"] = "First Name should be at atmost 15 length!!!";
            }
            if(!Validation::string($last_name,1,15))
            {
                $errors["last_name"] = "Last Name should be at atmost 15 length!!!";
            }
            if(!Validation::string($middle_name,0,15))
            {
                $errors["middle_name"] = "Middle Name should be atmost 15 length!!!";
            }
            $memeber_exists = $this->db->query("select * from member where Email=:email",["email"=>$email])->fetch();
            if($memeber_exists)
            {
                $errors["email"]="Email already exists !!!";
            }

            if(empty($errors)){
                $show_otp_input=true;
                $otp=rand(100000,999999);
                $otp_message="Your OTP is $otp";
                $user_exists = $this->db->query("select * from unverified where email=:email",["email"=>$email])->fetch();
                if($user_exists)
                {
                    $this->db->query("update unverified set code=:code where email=:email",["code"=>password_hash($otp,PASSWORD_BCRYPT),"email"=>$email]);
                }
                else
                {
                    $this->db->query("insert into unverified(email,user_type,code) values(:email,:user_type,:code)",["email"=>$email,"user_type"=>"member","code"=>password_hash($otp,PASSWORD_BCRYPT)]);
                }
                $warning["otp_message"]="Enter the OTP";
                EmailController::sendEmail($email,"Verification Email","OTP Verification","<h1>$otp_message</h1>");
            }
            load("Member/Signup.member",["data"=>$_POST,"show_otp_input"=>$show_otp_input,"errors"=>$errors,"warning"=>$warning]);
            exit;
        }
        load("Member/Signup.member",["show_otp_input"=>$show_otp_input]);
    }

    /**
     * Adds a new member to the database after verifying the OTP.
     * 
     * This function retrieves member details from POST data, checks the OTP
     * against the unverified users table, and if valid, inserts the member
     * into the members table. If the OTP is invalid, it returns an error.
     * 
     * @return void
     */

    public function addMember(){
        $email= $_POST["email"];
        $first_name= $_POST["first_name"];
        $middle_name= $_POST["middle_name"];
        $last_name= $_POST["last_name"];
        $phone= $_POST["phone"];
        $address= $_POST["address"];
        $password= $_POST["password"];
        $confirm_password= $_POST["confirm_password"];
        $otp= $_POST["otp"];
        $errors = [];
        if(empty($errors)){
            $user_exists = $this->db->query("select * from unverified where email=:email",["email"=>$email])->fetch();
            inspect(($user_exists->code));
            inspect($otp);
            inspect(password_verify($user_exists->code,$otp));
            if($user_exists && password_verify($otp,$user_exists->code))
            {
                $this->db->query("insert into member(FName,MName,LName,PhoneNo,Email,Password,Address,Affiliation,Remark,Status) values(:first_name,:middle_name,:last_name,:phone,:email,:password,:address,:affilate,:remark,:status)",["email"=>$email,"password"=>password_hash($password,PASSWORD_BCRYPT),"first_name"=>$first_name,"middle_name"=>$middle_name,"last_name"=>$last_name,"phone"=>$phone,"address"=>$address,"affilate"=>"","remark"=>"","status"=>"Active"]);
                $this->db->query("delete from unverified where email=:email",["email"=>$email]);
                redirect("/");
            }
            else
            {
                $errors["otp"]="Invalid OTP !!!";
                $show_otp_input=true;
            }
        }
        load("Member/Signup.member",["data"=>$_POST,"show_otp_input"=>$show_otp_input,"errors"=>$errors]);
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