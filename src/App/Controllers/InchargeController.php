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

        $errors = [];
        if (!Validation::email($email)) {
            $errors["email"] = "Invalid Email !!!";
        }
        if (!Validation::string($password, 8, 50)) {
            $errors["password"] = "Password must be between 8 and 50 characters !!!";
        }
        if (!empty($errors)) {
            load("Incharge/Signin.incharge", ["errors" => $errors]);
            exit;
        }
        $params = [
            "email" => $email
        ];
        $incharge = $this->db->query("SELECT * from incharge_auth where Email=:email", $params)->fetch();
        if (!$incharge) {
            $errors["email"] = "Invalid Email or Password !!!";
            load("Incharge/Signin.incharge", ["errors" => $errors]);
            exit;
        }
        if (!password_verify($password, $incharge->Password)) {
            $errors["email"] = "Invalid Email or Password !!!";
            load("Incharge/Signin.incharge", ["errors" => $errors]);
            exit;
        }
        Session::set("incharge", $this->db->query("SELECT * from incharge where Id = :id", ["id" => $incharge->InchargeId])->fetch());
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
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $transactions = $this->db->query("SELECT * FROM transactions ORDER BY BorrowDate DESC LIMIT $limit OFFSET $offset")->fetchAll();

        $totalQuery = $this->db->query("SELECT COUNT(*) as count FROM transactions")->fetch();
        $totalPages = ceil($totalQuery->count / $limit);

        load("Incharge/Dashboard.incharge.transactions", [
            "transactions" => $transactions,
            "currentPage" => $page,
            "totalPages" => $totalPages
        ]);
    }

    /**
     * Incharge Dashboard Profile
     * @return void
     */
    public function inchargeProfile()
    {
        $incharge_id = Session::get("incharge")->Id;
        $incharge = $this->db->query("SELECT * from incharge where Id = :id", ["id" => $incharge_id])->fetch();
        load("Incharge/Dashboard.incharge.profile", ["incharge" => $incharge]);
    }

    /**
     * Incharge Profile Add Incharge
     * @return void
     */
    public function addIncharge()
    {
        $inchargeTier = $this->getInchargeTier();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $first_name = $_POST["incharge_firstName"];
            $middle_name = $_POST["incharge_middleName"] == "" ? null : $_POST["incharge_middleName"];
            $last_name = $_POST["incharge_LastName"];
            $email = $_POST["incharge_email"];
            $phone = $_POST["incharge_phoneNo"];
            $incharge_designation = $_POST["incharge_designation"];
            $tier = $_POST["incharge_tier"];
            $errors = [];
            if ((int)$tier > $inchargeTier) {
                $errors["tier"] = "You can't add an Incharge of higher Tier !!!";
            }
            if (!Validation::string($first_name, 3, 50)) {
                $errors["first_name"] = "First Name must be between 3 and 50 characters !!!";
            }
            if (!Validation::string($middle_name, 0, 50) && $middle_name != null) {
                $errors["middle_name"] = "Middle Name must be between 3 and 50 characters !!!";
            }
            if (!Validation::string($last_name, 3, 50)) {
                $errors["last_name"] = "Last Name must be between 3 and 50 characters !!!";
            }
            if (!Validation::email($email)) {
                $errors["email"] = "Invalid Email !!!";
            }
            if (!Validation::phone($phone)) {
                $errors["phone"] = "Invalid Phone Number !!!";
            }
            if (!Validation::string($incharge_designation, 3, 50)) {
                $errors["incharge_designation"] = "Designation must be between 3 and 50 characters !!!";
            }
            if (!empty($errors)) {
                load("Incharge/Dashboard.incharge.addIncharge", [
                    "errors" => $errors,
                    "Tier" => $inchargeTier
                ]);
                exit;
            }
            $params = [
                "email" => $email
            ];
            $incharge_exists = $this->db->query("SELECT * from incharge_auth where Email=:email", $params)->fetch();
            $user_exists = $this->db->query("SELECT * from member_auth where Email=:email", $params)->fetch();
            if ($incharge_exists || $user_exists) {
                $errors["email"] = "Email already exists !!!";
                load("Incharge/Dashboard.incharge.addIncharge", [
                    "errors" => $errors,
                    "Tier" => $inchargeTier
                ]);
                exit;
            }
            $params = [
                "FName" => $first_name,
                "MName" => $middle_name,
                "LName" => $last_name,
                "PhoneNo" => $phone,
                "Designation" => $incharge_designation,
                "Tier" => $tier,
                "Remark" => null,
            ];
            $this->db->query("INSERT into incharge(FName,MName,LName,PhoneNo,Designation,Tier,Remark) values(:FName,:MName,:LName,:PhoneNo,:Designation,:Tier,:Remark)", $params);
            $random_password = random_int(10000000, 99999999);
            $current_incharge = $this->db->conn->lastInsertId();
            $new_params = [
                "InchargeId" => $current_incharge,
                "email" => $email,
                "password" => password_hash($random_password, PASSWORD_BCRYPT)
            ];
            $this->db->query("INSERT into incharge_auth(InchargeId,Email,Password) values(:InchargeId,:email,:password)", $new_params);
            EmailController::sendEmail($email, "Incharge Account Created Successfully", "Your Incharge Account has been created.", "<h1>Your Password is $random_password. Please change your password after logging in.</h1>");
            Session::setFlash("success", "Incharge Added Successfully !!!");
            redirect("/add-incharge");
            exit;
        }
        load("Incharge/Dashboard.incharge.addIncharge", ["Tier" => $inchargeTier]);
    }

    /**
     * Get Session Incharge Tier
     * @return int
     */
    public function getInchargeTier()
    {
        return (int) $this->db->query("SELECT Tier from incharge where Id = :id", ["id" => Session::get("incharge")->Id])->fetch()->Tier;
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
        $deleterId = Session::get("incharge")->Id;
        $deleterTier = $this->getInchargeTier();
        $incharge_id = $_POST["incharge_id"];
        $deleterPassword = $_POST["incharge_password"];
        $errors = [];

        if (!Validation::string($deleterPassword, 8, 50)) {
            $errors["password"] = "Password must be between 8 and 50 characters !!!";
            load("Incharge/Dashboard.incharge.removeIncharge", ["errors" => $errors]);
            exit;
        }

        if ($incharge_id == $deleterId) {
            $errors["incharge_id"] = "You can't delete yourself !!!";
            load("Incharge/Dashboard.incharge.removeIncharge", ["errors" => $errors]);
            exit;
        }

        $deleter = $this->db->query("SELECT * from incharge where
        Id = :id", ["id" => $deleterId])->fetch();
        if (!$deleter) {
            redirect("/incharge-dashboard");
        }
        if (!password_verify($deleterPassword, $this->db->query("SELECT Password from incharge_auth 
        where InchargeId = :id", ["id" => $deleterId])->fetch()->Password)) {
            $errors["password"] = "Invalid Password !!!";
            load("Incharge/Dashboard.incharge.removeIncharge", ["errors" => $errors]);
            exit;
        }
        $incharge = $this->db->query("SELECT * from incharge where Id = :id", ["id" => $incharge_id])->fetch();
        if (!$incharge) {
            $errors["incharge_id"] = "Incharge doesn't exist !!!";
            load("Incharge/Dashboard.incharge.removeIncharge", ["errors" => $errors]);
            exit;
        }
        if ($deleterTier < $this->db->query("SELECT Tier from incharge where Id = :id", ["id" => $incharge_id])->fetch()->Tier) {
            $errors["incharge_id"] = "You can't delete an Incharge of higher Tier !!!";
            load("Incharge/Dashboard.incharge.removeIncharge", ["errors" => $errors]);
            exit;
        }

        $this->db->query("DELETE from incharge where Id = :id", ["id" => $incharge_id]);

        Session::setFlash("success", "Incharge Deleted Successfully !!!");
        redirect("/remove-incharge");
    }

    /**
     * Incharge Profile Change Profile
     * @return void
     */
    public function changeProfile()
    {
        $incharge_id = Session::get("incharge")->Id;
        $incharge = $this->db->query("SELECT * from incharge where Id = :id", ["id" => $incharge_id])->fetch();
        Session::set("incharge", $incharge);
        load("Incharge/Dashboard.incharge.changeProfile");
    }

    /**
     * Incharge Profile Update Profile
     * @return void
     */
    public function updateProfile()
    {
        $incharge_id = Session::get("incharge")->Id;
        $first_name = $_POST["first_name"];
        $middle_name = $_POST["middle_name"] == "" ? null : $_POST["middle_name"];
        $last_name = $_POST["last_name"];
        $phone_no = $_POST["phone_no"];
        $errors = [];
        if (!Validation::string($first_name, 3, 50)) {
            $errors["first_name"] = "First Name must be between 3 and 50 characters !!!";
        }
        if (!Validation::string($middle_name, 0, 50) && $middle_name != null) {
            $errors["middle_name"] = "Middle Name must be between 0 and 50 characters !!!";
        }
        if (!Validation::string($last_name, 3, 50)) {
            $errors["last_name"] = "Last Name must be between 3 and 50 characters !!!";
        }
        if (!Validation::phone($phone_no)) {
            $errors["phone_no"] = "Invalid Phone Number !!!";
        }
        if (!empty($errors)) {
            load("Incharge/Dashboard.incharge.changeProfile", [
                "errors" => $errors,
                "incharge" => (object) [
                    "FName" => $first_name,
                    "MName" => $middle_name,
                    "LName" => $last_name,
                    "PhoneNo" => $phone_no
                ]
            ]);
            exit;
        }
        $incharge = $this->db->query("SELECT * from incharge where Id = :id", ["id" => $incharge_id])->fetch();
        if (!$incharge) {
            redirect("/incharge-dashboard");
        }
        $params = [
            "FName" => $first_name,
            "MName" => $middle_name,
            "LName" => $last_name,
            "PhoneNo" => $phone_no,
            "Id" => $incharge_id
        ];
        $this->db->query("UPDATE incharge set FName = :FName, MName = :MName, LName = :LName, PhoneNo = :PhoneNo where Id = :Id", $params);
        EmailController::sendEmail($this->db->query("SELECT Email from incharge_auth where InchargeId = :id", ["id" => $incharge_id])->fetch()->Email, "Profile Updated", "Your Profile has been updated successfully !!!", "<h1>Your Profile has been updated successfully !!!</h1>");
        Session::setFlash("success", "Profile Updated Successfully !!!");
        redirect("/incharge-profile");
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
     * Incharge Profile Ban Member
     * @return void
     */
    public function inchargeBan()
    {
        $member_id = $_POST["member_id"];
        $incharge_id = Session::get("incharge")->Id;
        $incharge_password = $_POST["incharge_password"];
        $ban_reason = $_POST["ban_reason"];

        $errors = [];
        if (!Validation::string($incharge_password, 8, 50)) {
            $errors["password"] = "Password must be between 8 and 50 characters !!!";
        }
        if (!Validation::string($ban_reason, 3, 100)) {
            $errors["ban_reason"] = "Ban Reason must be between 3 and 100 characters !!!";
        }
        if (!empty($errors)) {
            load("Incharge/Dashboard.incharge.banMember", [
                "errors" => $errors,
                "ban_reason" => $ban_reason
            ]);
            exit;
        }
        //Incharge Check
        $incharge = $this->db->query("SELECT * from incharge where Id = :id", ["id" => $incharge_id])->fetch();
        if (!$incharge) {
            redirect("/incharge-dashboard");
        }
        //Member Check
        $member = $this->db->query("SELECT * from member where Id = :id", ["id" => $member_id])->fetch();
        if (!$member) {
            $errors["member_id"] = "Member doesn't exist !!!";
            load("Incharge/Dashboard.incharge.banMember", [
                "errors" => $errors,
                "ban_reason" => $ban_reason
            ]);
            exit;
        }
        //Password Check
        if (!password_verify($incharge_password, $this->db->query("SELECT Password from incharge_auth where InchargeId = :id", ["id" => $incharge_id])->fetch()->Password)) {
            $errors["password"] = "Invalid Password !!!";
            load("Incharge/Dashboard.incharge.banMember", [
                "errors" => $errors,
                "ban_reason" => $ban_reason
            ]);
            exit;
        }
        //Ban Check
        $banned = $this->db->query("SELECT * from member_auth where MemberId = :id", ["id" => $member_id])->fetch();
        if ($banned->Status === "Banned") {
            $errors["member_id"] = "Member is already banned !!!";
            load("Incharge/Dashboard.incharge.banMember", [
                "errors" => $errors,
                "ban_reason" => $ban_reason
            ]);
            exit;
        }
        $this->db->query("UPDATE member_auth set Status = 'Banned', BanReason = :ban_reason
        where MemberId = :id", ["id" => $member_id, "ban_reason" => $ban_reason]);
        EmailController::sendEmail($banned->Email, "You have been banned", "You have been banned for $ban_reason", "<h1>You have been banned for $ban_reason</h1>");
        Session::setFlash("success", "Member Banned Successfully !!!");
        redirect("/ban-member");
    }

    /**
     * Incharge Profile Unban Member
     * @return void
     */
    public function unbanMember()
    {
        load("Incharge/Dashboard.incharge.unbanMember");
    }

    /**
     * Incharge Profile Unban Member
     * @return void
     */
    public function inchargeUnban()
    {
        $member_id = $_POST["member_id"];
        $incharge_id = Session::get("incharge")->Id;

        $errors = [];

        //Incharge Check
        $incharge = $this->db->query("SELECT * from incharge where Id = :id", ["id" => $incharge_id])->fetch();
        if (!$incharge) {
            redirect("/incharge-dashboard");
        }
        //Member Check
        $member = $this->db->query("SELECT * from member where Id = :id", ["id" => $member_id])->fetch();
        if (!$member) {
            $errors["member_id"] = "Member doesn't exist !!!";
            load("Incharge/Dashboard.incharge.unbanMember", [
                "errors" => $errors
            ]);
            exit;
        }
        //Unban Check
        $banned = $this->db->query("SELECT * from member_auth where MemberId = :id", ["id" => $member_id])->fetch();
        if ($banned->Status != "Banned") {
            $errors["member_id"] = "Member is already unbanned !!!";
            load("Incharge/Dashboard.incharge.unbanMember", [
                "errors" => $errors
            ]);
            exit;
        }
        $this->db->query("UPDATE member_auth set Status = 'Active', BanReason = null
        where MemberId = :id", ["id" => $member_id]);
        EmailController::sendEmail($banned->Email, "You have been unbanned", "You have been unbanned", "<h1>You have been unbanned</h1>");
        Session::setFlash("success", "Member Unbanned Successfully !!!");
        redirect("/unban-member");
    }

    /**
     * Incharge Change Password Page
     * @return void
     */
    public function changePass()
    {
        load("Incharge/Dashboard.incharge.changePassword");
    }

    /**
     * Incharge Change Password
     * @return void
     */
    public function changePassword()
    {
        $curr_pass = $_POST["curr_pass"];
        $new_pass = $_POST["new_pass"];
        $conf_pass = $_POST["conf_pass"];

        $errors = [];
        if (!Validation::string($curr_pass, 8, 50)) {
            $errors["curr_pass"] = "Current Password must be between 8 and 50 characters !!!";
        }
        if (!Validation::string($new_pass, 8, 50)) {
            $errors["new_pass"] = "New Password must be between 8 and 50 characters !!!";
        }
        if (!Validation::string($conf_pass, 8, 50)) {
            $errors["conf_pass"] = "Confirm Password must be between 8 and 50 characters !!!";
        }
        if (!Validation::match($new_pass, $conf_pass)) {
            $errors["conf_pass"] = "New Password and Confirm Password must be same !!!";
        }
        if (Validation::match($curr_pass, $new_pass)) {
            $errors["new_pass"] = "New Password must be different from Current Password !!!";
        }
        if (!empty($errors)) {
            load("Incharge/Dashboard.incharge.changePassword", [
                "errors" => $errors
            ]);
            exit;
        }
        $incharge_id = Session::get("incharge")->Id;
        $incharge = $this->db->query("SELECT * from incharge_auth where InchargeId = :id", ["id" => $incharge_id])->fetch();
        if (!$incharge) {
            redirect("/incharge-dashboard");
        }
        if (!password_verify($curr_pass, $incharge->Password)) {
            $errors["curr_pass"] = "Invalid Current Password !!!";
            load("Incharge/Dashboard.incharge.changePassword", [
                "errors" => $errors
            ]);
            exit;
        }
        $this->db->query("UPDATE incharge_auth set Password = :password where InchargeId = :id", ["id" => $incharge_id, "password" => password_hash($new_pass, PASSWORD_BCRYPT)]);
        EmailController::sendEmail($incharge->Email, "Password Changed Successfully", "Your Password has been changed successfully", "<h1>Your Password has been changed successfully</h1>");
        Session::setFlash("success", "Password Changed Successfully !!!");
        redirect("/incharge-change-password");
    }

    public function search()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = $_POST["search"];
            $search_type = $_POST["search_type"];
            $errors = [];
            $members = [];
            $incharges = [];
            $books = [];

            if (!Validation::string($search, 1, 50)) {
                $errors["search"] = "Search must be between 1 and 50 characters !!!";
            }
            if ($search_type == "") {
                $errors["search_type"] = "Select a Search Type !!!";
            }
            if (!empty($errors)) {
                load("Incharge/Dashboard.incharge.search", ["search_errors" => $errors]);
                exit;
            }
            if($search_type == "member")
            {
                $members = $this->db->query("SELECT * from member where FName like :search or MName like :search or LName like :search",["search" => "%$search%"])->fetchAll();
                if(empty($members)){
                    $errors["search"] = "No Members Found !!!";
                    load("Incharge/Dashboard.incharge.search",["search_errors" => $errors]);
                    exit;
                }
                load("Incharge/Dashboard.incharge.search",["search_type"=>$search_type,"members" => $members,"incharges" => $incharges,"books" => $books]);
                exit;
            }
            if($search_type == "book")
            {
                $books = $this->db->query("SELECT * from book_master where Title like :search or Author1 like :search or Author2 like :search or Author3 like :search",["search" => "%$search%"])->fetchAll();
                if(empty($books)){
                    $errors["search"] = "No Book Found !!!";
                    load("Incharge/Dashboard.incharge.search",["search_errors" => $errors]);
                    exit;
                }
                load("Incharge/Dashboard.incharge.search",["search_type"=>$search_type,"books" => $books,"members" => $members,"incharges" => $incharges]);
                exit;
            }
            if($search_type == "incharge")
            {
                $incharges = $this->db->query("SELECT * from incharge where FName like :search or MName like :search or LName like :search",["search" => "%$search%"])->fetchAll();
                if(empty($books)){
                    $errors["incharges"] = "No Incharges Found !!!";
                    load("Incharge/Dashboard.incharge.search",["search_errors" => $errors]);
                    exit;
                }
                load("Incharge/Dashboard.incharge.search",["search_type"=>$search_type,"incharges" => $incharges,"members" => $members,"books" => $books]);
                exit;
            }
        }
        load("Incharge/Dashboard.incharge.search", ["search_type" => "", "members" => [], "incharges" => [], "books" => []]);
    }
}
