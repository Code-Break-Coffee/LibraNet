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
        $incharge = $this->db->query("SELECT * from incharge_auth where Email=:email", $params)->fetch();
        if(!$incharge)
        {
            $errors["email"] = "Invalid Email or Password !!!";
            load("Incharge/Signin.incharge",["errors" => $errors]);
            exit;
        }
        if(!password_verify($password,$incharge->Password))
        {
            $errors["email"] = "Invalid Email or Password !!!";
            load("Incharge/Signin.incharge",["errors" => $errors]);
            exit;
        }
        Session::set("incharge",[
            "Id" => $incharge->InchargeId
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
        $inchargeTier = $this->getInchargeTier();
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $first_name = $_POST["incharge_firstName"];
            $middle_name = $_POST["incharge_middleName"] == "" ? null : $_POST["incharge_middleName"];
            $last_name = $_POST["incharge_LastName"];
            $email = $_POST["incharge_email"];
            $phone = $_POST["incharge_phoneNo"];
            $incharge_designation = $_POST["incharge_designation"];
            $tier = $_POST["incharge_tier"];
            $errors=[];
            if((int)$tier > $inchargeTier)
            {
                $errors["tier"] = "You can't add an Incharge of higher Tier !!!";
            }
            if(!Validation::string($first_name,3,50))
            {
                $errors["first_name"] = "First Name must be between 3 and 50 characters !!!";
            }
            if(!Validation::string($middle_name,0,50) && $middle_name != null)
            {
                $errors["middle_name"] = "Middle Name must be between 3 and 50 characters !!!";
            }
            if(!Validation::string($last_name,3,50))
            {
                $errors["last_name"] = "Last Name must be between 3 and 50 characters !!!";
            }
            if(!Validation::email($email))
            {
                $errors["email"] = "Invalid Email !!!";
            }
            if(!Validation::phone($phone))
            {
                $errors["phone"] = "Invalid Phone Number !!!";
            }
            if(!Validation::string($incharge_designation,3,50))
            {
                $errors["incharge_designation"] = "Designation must be between 3 and 50 characters !!!";
            }
            if(!empty($errors))
            {
                load("Incharge/Dashboard.incharge.addIncharge",[
                    "errors" => $errors,
                    "Tier" => $inchargeTier
                ]);
                exit;
            }
            $params=[
                "email" => $email
            ];
            $incharge_exists = $this->db->query("SELECT * from incharge_auth where Email=:email", $params)->fetch();
            $user_exists = $this->db->query("SELECT * from member_auth where Email=:email", $params)->fetch();
            if($incharge_exists || $user_exists)
            {
                $errors["email"] = "Email already exists !!!";
                load("Incharge/Dashboard.incharge.addIncharge",[
                    "errors" => $errors,
                    "Tier" => $inchargeTier
                ]);
                exit;
            }
            $params=[
                "FName" => $first_name,
                "MName" => $middle_name,
                "LName" => $last_name,
                "PhoneNo" => $phone,
                "Designation" => $incharge_designation,
                "Tier" => $tier,
                "Remark" => null,
            ];
            $this->db->query("INSERT into incharge(FName,MName,LName,PhoneNo,Designation,Tier,Remark) values(:FName,:MName,:LName,:PhoneNo,:Designation,:Tier,:Remark)",$params);
            $random_password = random_int(10000000,99999999);
            $current_incharge=$this->db->conn->lastInsertId();
            $new_params=[
                "InchargeId" => $current_incharge,
                "email" => $email,
                "password" => password_hash($random_password,PASSWORD_BCRYPT)
            ];
            $this->db->query("INSERT into incharge_auth(InchargeId,Email,Password) values(:InchargeId,:email,:password)",$new_params);
            EmailController::sendEmail($email,"Incharge Account Created Successfully","Your Incharge Account has been created.","<h1>Your Password is $random_password. Please change your password after logging in.</h1>");
            redirect("/add-incharge",["success" => "Incharge Added Successfully !!!"]);
            exit;
        }
        load("Incharge/Dashboard.incharge.addIncharge",["Tier" => $inchargeTier]);
    }

    /**
     * Get Session Incharge Tier
     * @return int
     */
    public function getInchargeTier()
    {
        return (int) $this->db->query("SELECT Tier from incharge where Id = :id",["id" => Session::get("incharge")["Id"]])->fetch()->Tier;
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
     * Incharge Profile Delete Incharge
     * @return void
     */
    public function deleteIncharge()
    {
        $deleterId = Session::get("incharge")["Id"];
        $deleterTier = $this->getInchargeTier();
        $incharge_id = $_POST["incharge_id"];
        $deleterPassword = $_POST["incharge_password"];
        $errors=[];

        if(!Validation::string($deleterPassword,8,50))
        {
            $errors["password"] = "Password must be between 8 and 50 characters !!!";
            load("Incharge/Dashboard.incharge.removeIncharge",["errors" => $errors]);
            exit;
        }

        if($incharge_id == $deleterId)
        {
            $errors["incharge_id"] = "You can't delete yourself !!!";
            load("Incharge/Dashboard.incharge.removeIncharge",["errors" => $errors]);
            exit;
        }

        $deleter = $this->db->query("SELECT * from incharge where
        Id = :id",["id" => $deleterId])->fetch();
        if(!$deleter)
        {
            redirect("/incharge-dashboard");
        }
        if(!password_verify($deleterPassword,$this->db->query("SELECT Password from incharge_auth 
        where InchargeId = :id",["id" => $deleterId])->fetch()->Password))
        {
            $errors["password"] = "Invalid Password !!!";
            load("Incharge/Dashboard.incharge.removeIncharge",["errors" => $errors]);
            exit;
        }
        $incharge = $this->db->query("SELECT * from incharge where Id = :id",["id" => $incharge_id])->fetch();
        if(!$incharge)
        {
            $errors["incharge_id"] = "Incharge doesn't exist !!!";
            load("Incharge/Dashboard.incharge.removeIncharge",["errors" => $errors]);
            exit;
        }
        if($deleterTier < $this->db->query("SELECT Tier from incharge where Id = :id",["id" => $incharge_id])->fetch()->Tier)
        {
            $errors["incharge_id"] = "You can't delete an Incharge of higher Tier !!!";
            load("Incharge/Dashboard.incharge.removeIncharge",["errors" => $errors]);
            exit;
        }

        $this->db->query("DELETE from incharge where Id = :id",["id" => $incharge_id]);

        redirect("/remove-incharge",["success" => "Incharge Deleted Successfully !!!"]);
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
    
    /**
     * Incharge Profile Unban Member
     * @return void
     */
    public function unbanMember()
    {
        load("Incharge/Dashboard.incharge.unbanMember");
    }
}