<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;

class BookController
{
    protected $db;

    /**
     * Database Initialization
     * @return void
     */
    public function __construct()
    {
        $config = require_once basePath("config/db.php");
        $this->db = new Database($config);
    }

    /**
     * Issue a Book
     * @return void
     */
    public function issueBook()
    {
        $bookNo = $_POST["issue_book_no"];
        $memberId = $_POST["issue_member_id"];
        $inchargePassword = $_POST["issue_incharge_password"];
        $inchargeId = Session::get("incharge")["Id"];

        $errors=[];

        if(!Validation::string($bookNo))
        {
            $errors["bookNo"] = "Invalid Book No. !!!";
        }
        if(!Validation::string($memberId))
        {
            $errors["memberId"] = "Invalid Member ID !!!";
        }
        if(!Validation::string($inchargePassword,8,50))
        {
            $errors["inchargePassword"] = "Password should be between 8 and 50 characters !!!";
        }

        if(!empty($errors))
        {
            load("Incharge/Dashboard.incharge.transactions",[
                "issue_errors" => $errors,
                "issue_data" => [
                    "bookNo" => $bookNo,
                    "memberId" => $memberId
                ]
            ]);
            exit;
        }

        //-----Incharge Check
        $incharge = $this->db->query("SELECT * from incharge where Id=:inchargeId",["inchargeId" => $inchargeId])->fetch();
        if(!$incharge)
        {
            redirect("/incharge-dashboard");
        }
        if(!password_verify($inchargePassword,$incharge->password))
        {
            $errors["inchargePassword"] = "Incorrect Password !!!";
            load("Incharge/Dashboard.incharge.transactions",[
                "issue_errors" => $errors,
                "issue_data" => [
                    "bookNo" => $bookNo,
                    "memberId" => $memberId
                ]
            ]);
            exit;
        }

        //-----Member Check
        $member = $this->db->query("SELECT * from member where Id=:memberId",["memberId" => $memberId])->fetch();
        if(!$member)
        {
            $errors["memberId"] = "Invalid Member ID !!!";
            load("Incharge/Dashboard.incharge.transactions",[
                "issue_errors" => $errors,
                "issue_data" => [
                    "bookNo" => $bookNo,
                ]
            ]);
            exit;
        }

        //-----Book Check
        $book = $this->db->query("SELECT * from book_master where BookNo=:bookNo",["bookNo" => $bookNo])->fetch();
        if(!$book)
        {
            $errors["inchargePassword"] = "Invalid Book No. !!!";
            load("Incharge/Dashboard.incharge.transactions",[
                "issue_errors" => $errors,
                "issue_data" => [
                    "memberId" => $memberId
                ]
            ]);
            exit;
        }

        /////////////////////////////////////////////////////Issue Left //////////////////////////////////////
    }

    /**
     * Return a Book
     * @return void
     */
    public function returnBook()
    {

    }
}