<?php

namespace App\Controllers;

use Framework\Validation;
use Framework\Database;
use Framework\Session;

class InchargeController
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
     * Show the home page
     * @return void
     */
    public function index()
    {
        // EmailController::sendEmail("zk.khan2003@gmail.com","Test Email","This is a test email","<h1>This is a test email</h1>");
        load("Incharge/Signin.incharge");
    }

    /**
     * Show the Incharge dashboard
     * @return void
     */
    public function inchargeDashboard()
    {
        load("Incharge/Dashboard.incharge.home");
    }

    /**
     * Store the Incharge Signin Data
     * @return void
     */
    public function inchargeSignin()
    {
        $email = $_POST["incharge_signin_email"];
        $password = $_POST["incharge_signin_password"];

        $errors=[];
        if(!Validation::email($email))
        {
            $errors["email"] = "Invalid Email !!!";
        }
        if(!Validation::string($password,8,50))
        {
            $errors["password"] = "Password must be between 8 and 50 characters !!!";
        }
        if(!empty($errors))
        {
            load("Incharge/Signin.incharge",["errors" => $errors]);
            exit;
        }
        $params=[
            "email" => $email
        ];
        $incharge = $this->db->query("SELECT * from incharge where email=:email", $params)->fetch();
        if(!$incharge)
        {
            $errors["email"] = "Invalid Email or Password !!!";
            load("Incharge/Signin.incharge",["errors" => $errors]);
            exit;
        }
        if(!password_verify($password,$incharge->password))
        {
            $errors["email"] = "Invalid Email or Password !!!";
            load("Incharge/Signin.incharge",["errors" => $errors]);
            exit;
        }
        Session::set("incharge",[
            "Id" => $incharge->Id
        ]);
        redirect("/incharge-dashboard");
    }

    /**
     * Signout the Incharge
     * @return void
     */
    public function inchargeSignout()
    {
        Session::destroy();
        $params = session_get_cookie_params();
        setcookie("PHPSESSID", "", time() - 86400, $params["path"], $params["domain"]);
        redirect("/incharge-signin");
    }

    /**
     * Incharge Dashboard Transactions
     * @return void
     */
    public function inchargeTransactions()
    {
        $transactions=[];
        $transactions = $this->db->query("SELECT * from transactions order by BorrowDate desc limit 5")->fetchAll();
        load("Incharge/Dashboard.incharge.transactions",["transactions" => $transactions]);
    }

    /**
     * Incharge Dashboard Profile
     * @return void
     */
    public function inchargeProfile()
    {
        load("Incharge/Dashboard.incharge.profile");
    }

    /**
     * Incharge Profile Add Incharge
     * @return void
     */
    public function addIncharge()
    {
        load("Incharge/Dashboard.incharge.addIncharge");
    }

    /**
     * Incharge Profile Remove Incharge
     * @return void
     */
    public function removeIncharge()
    {
        load("Incharge/Dashboard.incharge.removeIncharge");
    }

    /**
     * Incharge Profile Change Profile
     * @return void
     */
    public function changeProfile()
    {
        load("Incharge/Dashboard.incharge.changeProfile");
    }

    /**
     * Incharge Profile Ban Member
     * @return void
     */
    public function banMember()
    {
        load("Incharge/Dashboard.incharge.banMember");
    }


}