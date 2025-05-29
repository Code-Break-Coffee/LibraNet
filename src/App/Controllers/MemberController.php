<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;
use Symfony\Component\Mime\Email;

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
        Session::destroy();
        $params = session_get_cookie_params();
        setcookie("PHPSESSID", "", time() - 86400, $params["path"], $params["domain"]);
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
        $member = $this->db->query("SELECT * from member_auth where Email = :Email",$params)->fetch();
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
            "Id" => $member->MemberId,
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
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $email = $_POST["email"];
            $errors = [];
            if(!Validation::email($email))
            {
                $errors["email"] = "Invalid Email !!!";
            }
            $user_exists= $this->db->query('select * from member_auth where Email=:email',["email"=>$email])->fetch();
            $admin_exists = $this->db->query("select * from incharge_auth where Email=:email",["email"=>$email])->fetch();
            if(!$user_exists && !$admin_exists)
            {
                $errors["email"]="Email does not exists !!!";
            }
            if(!empty($errors))
            {
                load("Member/ForgotPassword.member",["errors" => $errors]);
                exit;
            }
            if(!isset($_SESSION["issession"]))
            {
                $otp=rand(100000,999999);
                $otp_message="Your OTP is $otp";
                EmailController::sendEmail($email,"Verification Email for Forgot Password","OTP Verification","<h1>$otp_message</h1>");
                $user_exists = $this->db->query("select * from unverified where email=:email",["email"=>$email])->fetch();
                if($user_exists)
                {
                    $this->db->query("update unverified set code=:code where email=:email",["code"=>password_hash($otp,PASSWORD_BCRYPT),"email"=>$email]);
                }
                else
                {
                    $this->db->query("insert into unverified(email,user_type,code) values(:email,:user_type,:code)",["email"=>$email,"user_type"=>"member","code"=>password_hash($otp,PASSWORD_BCRYPT)]);
                }
                $_SESSION["issession"]=true;
            }
            load("Member/UpdatePassword.member",["email"=>$email]);
            exit;
        }
        Session::destroy();
        $params = session_get_cookie_params();
        setcookie("PHPSESSID", "", time() - 86400, $params["path"], $params["domain"]);
        load("Member/ForgotPassword.member");
    }

    /**
     * Show the Sign Up page
     * @return void
     */
    public function memberSignup()
    {
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
            $memeber_exists = $this->db->query("select * from member_auth where Email=:email",["email"=>$email])->fetch();
            $admin_exists = $this->db->query("select * from incharge_auth where Email=:email",["email"=>$email])->fetch();
            if($memeber_exists || $admin_exists)
            {
                $errors["email"]="Email already exists !!!";
            }
            if(empty($errors) && !isset($_SESSION["issession"])){
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
                EmailController::sendEmail($email,"Verification Email for New Account","OTP Verification","<h1>$otp_message</h1>");
                $_SESSION["issession"]=true;
            }
            if(!empty($errors)){
                load("Member/Signup.member",["data"=>$_POST,"show_otp_input"=>false,"errors"=>$errors,"warning"=>$warning]);
            }
            else{
                load("Member/Signup.member",["data"=>$_POST,"show_otp_input"=>true,"errors"=>$errors,"warning"=>$warning]);
            }
            exit;
        }
        Session::destroy();
        $params = session_get_cookie_params();
        setcookie("PHPSESSID", "", time() - 86400, $params["path"], $params["domain"]);
        $show_otp_input=false;
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
        $show_otp_input=false;
        if(empty($errors)){
            $user_exists = $this->db->query("select * from member_auth where Email=:email",["email"=>$email])->fetch();
            $admin_exists = $this->db->query("select * from incharge_auth where Email=:email",["email"=>$email])->fetch();
            $unverfied_exists= $this->db->query("select * from unverified where email=:email",["email"=>$email])->fetch();
            if($user_exists || $admin_exists){
                $errors["email"]="Email already exists !!!";
            }
            else if(password_verify($otp,$unverfied_exists->code))
            {
                $this->db->query("insert into member(FName,MName,LName,PhoneNo,Address,Affiliation,Remark,CreatedAt) values(:first_name,:middle_name,:last_name,:phone,:address,:affilate,:remark,:CreatedAt)",["first_name"=>$first_name,"middle_name"=>$middle_name,"last_name"=>$last_name,"phone"=>$phone,"address"=>$address,"affilate"=>"","remark"=>"","CreatedAt"=>date("Y-m-d H:i:s")]);
                $curr_member_id=$this->db->conn->lastInsertId();
                $this->db->query("insert into member_auth(MemberId,Email,Password,Status) values(:member_id,:email,:password,:status)",["member_id"=>$curr_member_id,"email"=>$email,"password"=>password_hash($password,PASSWORD_BCRYPT),"status"=>null]);
                $this->db->query("delete from unverified where email=:email",["email"=>$email]);
                EmailController::sendEmail($email,"Welcome to LibraNet !!!","Welcome to LibraNet","<h1>SignIn Completed Succesfully !!!</h1>");
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


    /**
     * Show the Member Search page
     * @return void
     */
    public function memberSearch()
    {
        load("Member/Search.member");
    }

    /**
     * Search for books based on the search query
     * @return void
     */
    public function search()
    {
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $search_query = $_POST["search_query"];
            $errors = [];
            if(!Validation::string($search_query,3,50)){
                $errors["search_query"] = "Search query should be between 3 to 50 characters !!!";
            }
            if(!empty($errors)){
                load("Member/Search.member",["errors"=>$errors]);
                exit;
            }
            $searchResults = $this->db->query("SELECT BookNo,Title, Author1, Author2, Author3, Edition, Publisher, Remark 
            FROM book_master WHERE (Title LIKE :query OR Author1 LIKE :query
            OR Author2 like :query or Author3 like :query or
            Edition like :query or Publisher like :query or Remark like :query) and Status = 'Available' limit 10", ["query" => "%$search_query%"])->fetchAll();
            load("Member/Search.member",["searchResults"=>$searchResults]);
        }
    }

    /**
     * Issue a book to the member
     * @return void
     */
    public function issueBook()
    {
        $bookNo = $_POST["bookNo"];
        $memberId = Session::get("member")["Id"];
        $errors = [];
        
        $bookExists = $this->db->query("SELECT * FROM book_master WHERE BookNo = :bookNo and Status = 'Available'", ["bookNo" => $bookNo])->fetch();
        if(!$bookExists)
        {
            $errors["bookNo"] = "Book does not exist or is issued!!!";
            load("Member/Search.member", ["errors" => $errors]);
            exit;
        }

        $memberExists = $this->db->query("SELECT * FROM member WHERE id = :memberId", ["memberId" => $memberId])->fetch();
        if(!$memberExists)
        {
            $errors["member"] = "Member does not exist !!!";
            load("Member/Search.member", ["errors" => $errors]);
            exit;
        }
        $memberEmail = $this->db->query("SELECT Email FROM member_auth WHERE MemberId = :memberId", ["memberId" => $memberId])->fetch()->Email;

        $requestExists = $this->db->query("SELECT * FROM requests WHERE BookNo = :bookNo AND member_email = :member_email AND Status = 'Pending'", [
            "bookNo" => $bookNo,
            "member_email" => $memberEmail
        ])->fetch();
        if($requestExists)
        {
            $errors["request"] = "You have already requested this book and it is pending approval.";
            load("Member/Search.member", ["errors" => $errors]);
            exit;
        }

        $this->db->query("insert into requests(member_email, BookNo, Status) values(:member_email, :bookNo, :status)", [
            "member_email" => $memberEmail,
            "bookNo" => $bookNo,
            "status" => "Pending"
        ]);

        EmailController::sendEmail($memberEmail, "Book Request Received", "Your book request has been received", "<h1>Your book request for Book: $bookExists->Title has been received and is pending approval.</h1>");
        Session::setFlash("success", "Book request has been sent successfully. Please wait for approval.");
        redirect("/member-search");
    }

    /**
     * Updating Forgot Password for the 
     * @return void
     */
    public function UpdateforgotPassword(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $email = $_POST["email"];
            $otp= $_POST["otp"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];
            $errors = [];
            if(!Validation::email($email))
            {
                $errors["email"] = "Invalid Email !!!";
            }
            if(!Validation::string($password,8,50))
            {
                $errors["password"] = "Password length should be between 8 to 50 characters !!!";
            }
            if(!Validation::string($confirm_password,8,50))
            {
                $errors["confirm_password"] = "Password length should be between 8 to 50 characters !!!";
            }
            if(!Validation::match($password,$confirm_password))
            {
                $errors["password"] = "Password and Confirm Password should be same !!!";
            }
            $unverified_exists= $this->db->query('select * from unverified where email=:email',["email"=>$email])->fetch();
            $user_exists = $this->db->query("select * from member_auth where Email=:email",["email"=>$email])->fetch();
            $admin_exists = $this->db->query("select * from incharge_auth where Email=:email",["email"=>$email])->fetch();
            if($user_exists && $unverified_exists)
            {
                $sql_query = "update member_auth set Password=:password where Email=:email";
            }
            else if($admin_exists && $unverified_exists)
            {
                $sql_query = "update incharge_auth set Password=:password where Email=:email";
            }
            else
            {
                $errors["email"]="Email does not exists !!!";
            }
            if(!empty($errors)){
                load("Member/UpdatePassword.member",["errors"=>$errors,"email"=>$email]);
                exit;
            }

            if(isset($user_exists) && password_verify($otp,$unverified_exists->code) && $user_exists!=false) {
                $this->db->query("update member_auth set Password=:password where email=:email",["password"=>password_hash($password,PASSWORD_BCRYPT),"email"=>$email]);
                $this->db->query("delete from unverified where email=:email",["email"=>$email]);
                EmailController::sendEmail($email,"Password Changed !!!","Password has been changed !!!","<h1>Your Password has been changed for LibraNet !!!</h1>");
                redirect("/");
            }
            if(isset($admin_exists) && password_verify($otp,$unverified_exists->code) && $admin_exists!=false) {
                
                $this->db->query("update incharge_auth set Password=:password where Email=:email",["password"=>password_hash($password,PASSWORD_BCRYPT),"email"=>$email]);
                $this->db->query("delete from unverified where email=:email",["email"=>$email]);
                EmailController::sendEmail($email,"Password Changed !!!","Password has been changed !!!","<h1>Your Password has been changed for LibraNet !!!</h1>");
                redirect("/");
            }
            else
            {
                $errors["otp"]="Invalid Credentials !!!";
                load("Member/UpdatePassword.member",["errors"=>$errors,"email"=>$email]);
                exit;
            }
        }

    }

}