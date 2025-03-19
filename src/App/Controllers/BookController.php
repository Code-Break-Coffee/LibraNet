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
        $incharge = $this->db->query("SELECT * from incharge where Id = :inchargeId",["inchargeId" => $inchargeId])->fetch();
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
        $member = $this->db->query("SELECT * from member where Id = :memberId",["memberId" => $memberId])->fetch();
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
        $book = $this->db->query("SELECT * from book_master where BookNo = :bookNo",["bookNo" => $bookNo])->fetch();
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

        if(strtoupper($book->Status) === "ISSUED")
        {
            $errors["bookNo"] = "Book is not Available right now !!!";
            load("Incharge/Dashboard.incharge.transactions",[
                "issue_errors" => $errors,
                "issue_data" => [
                    "memberId" => $memberId
                ]
            ]);
            exit;
        }
        $params=[
            "bookNo" => $bookNo,
            "memberId" => $memberId,
            "inchargeId" => $inchargeId,
        ];
        //-----Insert
        $sql = "INSERT into transactions(BookNo, BorrowerId, LibrarianId) values(:bookNo, :memberId, :inchargeId)";
        $issue = $this->db->query($sql,$params);
        if($issue)
        {
            $update=$this->db->query("UPDATE book_master set Status = 'Issued' where BookNo = :bookNo",["bookNo" => $bookNo]);
            if($update)
            {
                redirect("/incharge-transactions",[
                    "issueSuccess" => "Book $bookNo issued by member $memberId Successfully !!!"
                ]);
            }
        }
    }

    /**
     * Return a Book
     * @return void
     */
    public function returnBook()
    {
        $bookNo = $_POST["return_book_no"];
        $memberId = $_POST["return_member_id"];
        $inchargePassword = $_POST["return_incharge_password"];
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
                "return_errors" => $errors,
                "return_data" => [
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
                "return_errors" => $errors,
                "return_data" => [
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
                "return_errors" => $errors,
                "return_data" => [
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
                "return_errors" => $errors,
                "return_data" => [
                    "memberId" => $memberId
                ]
            ]);
            exit;
        }

        if(strtoupper($book->Status) === "AVAILABLE")
        {
            $errors["bookNo"] = "Book is not Issued by any Member !!!";
            load("Incharge/Dashboard.incharge.transactions",[
                "return_errors" => $errors,
                "return_data" => [
                    "memberId" => $memberId
                ]
            ]);
            exit;
        }
        $params=[
            "bookNo" => $bookNo,
            "memberId" => $memberId,
            "inchargeId" => $inchargeId
        ];
        $transaction = $this->db->query("SELECT * from transactions
        where ReturnDate is NULL and BookNo = :bookNo and 
        BorrowerId = :memberId and LibrarianId = :inchargeId",
        $params)->fetch();

        if($transaction)
        {
            $params = [
                "bookNo" => $bookNo,
                "memberId" => $memberId,
                "inchargeId" => $inchargeId,
            ];

            $update = $this->db->query("UPDATE transactions set ReturnDate = CURRENT_TIMESTAMP
            where BookNo = :bookNo and BorrowerId = :memberId
            and LibrarianId = :inchargeId and ReturnDate is NULL",$params);

            if($update)
            {
                $update = $this->db->query("UPDATE book_master set Status = 'Available' where BookNo = :bookNo",["bookNo" => $bookNo]);
                if($update)
                {
                    redirect("/incharge-transactions",[
                        "returnSuccess" => "Book $bookNo returned by member $memberId Successfully !!!"
                    ]);
                }
            }
        }
        else
        {
            $errors["bookNo"] = "This Book is not Issued by this Member !!!";
            load("Incharge/Dashboard.incharge.transactions",[
                "return_errors" => $errors,
                "return_data" => [
                    "memberId" => $memberId,
                    "bookNo" => $bookNo
                ]
            ]);
            exit;
        }
    }
}