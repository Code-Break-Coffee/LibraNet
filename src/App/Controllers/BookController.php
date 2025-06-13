<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;
use App\Controllers\EmailController;

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
        $memberEmail = $_POST["issue_member_email"];
        $inchargeId = Session::get("incharge")->Id;

        $transactions = [];
        $errors = [];

        if (!Validation::string($bookNo)) {
            $errors["bookNo"] = "Invalid Book No. !!!";
        }
        if (!Validation::email($memberEmail)) {
            $errors["memberEmail"] = "Invalid Email !!!";
        }

        if (!empty($errors)) {
            $transactions = $this->db->query("SELECT * from transactions order by BorrowDate desc limit 5")->fetchAll();
            if (isset($_POST["_route"]) && $_POST["_route"] === "incharge-accept") {
                load("Incharge/Dashboard.incharge.requests", [
                    "issue_errors" => $errors
                ]);
                exit;
            }
            load("Incharge/Dashboard.incharge.transactions", [
                "issue_errors" => $errors,
                "issue_data" => [
                    "bookNo" => $bookNo,
                    "memberEmail" => $memberEmail
                ],
                "transactions" => $transactions
            ]);
            exit;
        }

        //-----Incharge Check
        $incharge = $this->db->query("SELECT * from incharge where Id = :inchargeId", ["inchargeId" => $inchargeId])->fetch();
        if (!$incharge) {
            redirect("/incharge-dashboard");
        }

        //-----Member Check
        $member = $this->db->query("SELECT * from member where
        id = (SELECT MemberId from member_auth where Email = :memberEmail)
        ", ["memberEmail" => $memberEmail])->fetch();
        if (!$member) {
            $errors["memberEmail"] = "This Email is not Registered !!!";
            if (isset($_POST["_route"]) && $_POST["_route"] === "incharge-accept") {
                load("Incharge/Dashboard.incharge.requests", [
                    "issue_errors" => $errors
                ]);
                exit;
            }
            $transactions = $this->db->query("SELECT * from transactions order by BorrowDate desc limit 5")->fetchAll();
            load("Incharge/Dashboard.incharge.transactions", [
                "issue_errors" => $errors,
                "issue_data" => [
                    "bookNo" => $bookNo,
                ],
                "transactions" => $transactions
            ]);
            exit;
        }

        //-----Book Check
        $book = $this->db->query("SELECT * from book_master where BookNo = :bookNo", ["bookNo" => $bookNo])->fetch();
        if (!$book) {
            $errors["bookNo"] = "Invalid Book No. !!!";
            if (isset($_POST["_route"]) && $_POST["_route"] === "incharge-accept") {
                load("Incharge/Dashboard.incharge.requests", [
                    "issue_errors" => $errors
                ]);
                exit;
            }
            $transactions = $this->db->query("SELECT * from transactions order by BorrowDate desc limit 5")->fetchAll();
            load("Incharge/Dashboard.incharge.transactions", [
                "issue_errors" => $errors,
                "issue_data" => [
                    "memberEmail" => $memberEmail
                ],
                "transactions" => $transactions
            ]);
            exit;
        }

        if (strtoupper($book->Status) === "ISSUED") {
            $transactions = $this->db->query("SELECT * from transactions order by BorrowDate desc limit 5")->fetchAll();
            $errors["bookNo"] = "Book is not Available right now !!!";
            if (isset($_POST["_route"]) && $_POST["_route"] === "incharge-accept") {
                load("Incharge/Dashboard.incharge.requests", [
                    "issue_errors" => $errors
                ]);
                exit;
            }
            load("Incharge/Dashboard.incharge.transactions", [
                "issue_errors" => $errors,
                "issue_data" => [
                    "memberEmail" => $memberEmail
                ],
                "transactions" => $transactions
            ]);
            exit;
        }
        $params = [
            "bookNo" => $bookNo,
            "memberId" => $member->id,
            "inchargeId" => $inchargeId,
        ];
        //-----Insert
        $sql = "INSERT into transactions(BookNo, BorrowerId, LibrarianId) values(:bookNo, :memberId, :inchargeId)";
        $issue = $this->db->query($sql, $params);
        if ($issue) {
            $update = $this->db->query("UPDATE book_master set Status = 'Issued' where BookNo = :bookNo", ["bookNo" => $bookNo]);
            if ($update) {
                if (isset($_POST["_route"]) && $_POST["_route"] === "incharge-accept") {
                    $update = $this->db->query("UPDATE requests set Status = 'Accepted' where BookNo = :bookNo and member_email = :memberEmail", [
                        "bookNo" => $bookNo,
                        "memberEmail" => $memberEmail
                    ]);
                    if ($update) {
                        Session::setFlash("issueSuccess", "Book $bookNo issued by member $member->id Successfully !!!");
                        EmailController::sendEmail(
                            $memberEmail,
                            "Book Issued",
                            "Your request for book $book->Title has been accepted and issued to you.",
                            "<p>
                            Your request for book <b>$book->Title</b> has been accepted and issued to you.
                            <br>
                            Kindly take the book from the library.
                            </p>"
                        );
                        redirect("/incharge-requests");
                    }
                }
                Session::setFlash("issueSuccess", "Book $bookNo issued by member $member->id Successfully !!!");
                redirect("/incharge-transactions");
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
        $memberEmail = $_POST["return_member_email"];
        $inchargeId = Session::get("incharge")->Id;

        $errors = [];
        $transactions = [];

        if (!Validation::string($bookNo)) {
            $errors["bookNo"] = "Invalid Book No. !!!";
        }
        if (!Validation::email($memberEmail)) {
            $errors["memberEmail"] = "Invalid Email !!!";
        }

        if (!empty($errors)) {
            $transactions = $this->db->query("SELECT * from transactions order by BorrowDate desc limit 5")->fetchAll();
            load("Incharge/Dashboard.incharge.transactions", [
                "return_errors" => $errors,
                "return_data" => [
                    "bookNo" => $bookNo,
                    "memberEmail" => $memberEmail
                ],
                "transactions" => $transactions
            ]);
            exit;
        }

        //-----Incharge Check
        $incharge = $this->db->query("SELECT * from incharge where Id=:inchargeId", ["inchargeId" => $inchargeId])->fetch();
        if (!$incharge) {
            redirect("/incharge-dashboard");
        }

        //-----Member Check
        $member = $this->db->query("SELECT * from member where
        id = (SELECT MemberId from member_auth where Email = :memberEmail)", ["memberEmail" => $memberEmail])->fetch();
        if (!$member) {
            $errors["memberId"] = "This Email is not Registered !!!";
            $transactions = $this->db->query("SELECT * from transactions order by BorrowDate desc limit 5")->fetchAll();
            load("Incharge/Dashboard.incharge.transactions", [
                "return_errors" => $errors,
                "return_data" => [
                    "bookNo" => $bookNo,
                ],
                "transactions" => $transactions
            ]);
            exit;
        }

        //-----Book Check
        $book = $this->db->query("SELECT * from book_master where BookNo = :bookNo", ["bookNo" => $bookNo])->fetch();
        if (!$book) {
            $errors["bookNo"] = "Invalid Book No. !!!";
            $transactions = $this->db->query("SELECT * from transactions order by BorrowDate desc limit 5")->fetchAll();
            load("Incharge/Dashboard.incharge.transactions", [
                "return_errors" => $errors,
                "return_data" => [
                    "memberEmail" => $memberEmail
                ],
                "transactions" => $transactions
            ]);
            exit;
        }

        if (strtoupper($book->Status) === "AVAILABLE") {
            $errors["bookNo"] = "Book is not Issued by any Member !!!";
            $transactions = $this->db->query("SELECT * from transactions order by BorrowDate desc limit 5")->fetchAll();
            load("Incharge/Dashboard.incharge.transactions", [
                "return_errors" => $errors,
                "return_data" => [
                    "memberEmail" => $memberEmail
                ],
                "transactions" => $transactions
            ]);
            exit;
        }
        $params = [
            "bookNo" => $bookNo,
            "memberId" => $member->id,
            "inchargeId" => $inchargeId
        ];
        $transaction = $this->db->query(
            "SELECT * from transactions
        where ReturnDate is NULL and BookNo = :bookNo and 
        BorrowerId = :memberId and LibrarianId = :inchargeId",
            $params
        )->fetch();

        if ($transaction) {
            $update = $this->db->query("UPDATE transactions set ReturnDate = CURRENT_TIMESTAMP
            where BookNo = :bookNo and BorrowerId = :memberId
            and LibrarianId = :inchargeId and ReturnDate is NULL", $params);

            if ($update) {
                $update = $this->db->query("UPDATE book_master set Status = 'Available' where BookNo = :bookNo", ["bookNo" => $bookNo]);
                if ($update) {
                    Session::setFlash("returnSuccess", "Book $bookNo returned by member $member->id Successfully !!!");
                    redirect("/incharge-transactions");
                }
            }
        } else {
            $transactions = $this->db->query("SELECT * from transactions order by BorrowDate desc limit 5")->fetchAll();
            $errors["bookNo"] = "This Book is not Issued by this Member !!!";
            load("Incharge/Dashboard.incharge.transactions", [
                "return_errors" => $errors,
                "return_data" => [
                    "memberEmail" => $memberEmail,
                    "bookNo" => $bookNo
                ],
                "transactions" => $transactions
            ]);
            exit;
        }
    }


    /**
     * Delete a Book
     * @return void
     */
    public function deleteBook()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $bookNo = $_POST["book_no"];
            $errors = [];
            $transactions = [];

            if (!Validation::string($bookNo)) {
                $errors["bookNo"] = "Invalid Book No. !!!";
            }

            if (!empty($errors)) {
                load("Incharge/Dashboard.incharge.DeleteBook", [
                    "delete_errors" => $errors,
                ]);
                exit;
            }


            //-----Book Check
            $book = $this->db->query("SELECT * from book_master where BookNo = :bookNo", ["bookNo" => $bookNo])->fetch();
            if (!$book) {
                $errors["bookNo"] = "Invalid Book No. !!!";
                load("Incharge/Dashboard.incharge.DeleteBook", [
                    "delete_errors" => $errors,
                ]);
                exit;
            }

            if (strtoupper($book->Status) === "ISSUED") {
                $errors["bookNo"] = "Book is not Available right now !!!";
                load("Incharge/Dashboard.incharge.DeleteBook", [
                    "delete_errors" => $errors,
                ]);
                exit;
            }

            $delete = $this->db->query("DELETE from book_master where BookNo = :bookNo", ["bookNo" => $bookNo]);
            if ($delete) {
                load("Incharge/Dashboard.incharge.DeleteBook", [
                    "success" => "Book $bookNo Deleted Successfully !!!"
                ]);
                exit;
            }
        }
        load("Incharge/Dashboard.incharge.DeleteBook");
    }

    /**
     * Edit a Book
     * @return void
     */
    public function editBook()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $bookNo = $_POST["book_no"];
            $bookName = $_POST["book_name"];
            $bookAuthor1 = $_POST["book_author1"];
            $bookAuthor2 = $_POST["book_author2"];
            $bookAuthor3 = $_POST["book_author3"];
            $edition = $_POST["edition"];
            $publisher = $_POST["publisher"];
            $pages = $_POST["pages"];
            $remark = $_POST["remark"];
            $errors = [];
            $transactions = [];

            if (!Validation::string($bookNo)) {
                $errors["bookNo"] = "Invalid Book No. !!!";
            }

            if (!empty($errors)) {
                load("Incharge/Dashboard.incharge.EditBook", [
                    "delete_errors" => $errors,
                ]);
                exit;
            }


            //-----Book Check
            $book = $this->db->query("SELECT * from book_master where BookNo = :bookNo", ["bookNo" => $bookNo])->fetch();
            if (!$book) {
                $errors["bookNo"] = "Invalid Book No. !!!";
                load("Incharge/Dashboard.incharge.EditBook", [
                    "delete_errors" => $errors,
                ]);
                exit;
            }

            if (strtoupper($book->Status) === "ISSUED") {
                $errors["bookNo"] = "Book is not Available right now !!!";
                load("Incharge/Dashboard.incharge.EditBook", [
                    "delete_errors" => $errors,
                ]);
                exit;
            }

            $update = $this->db->query(
                "UPDATE book_master 
                SET 
                    Title = :Title, 
                    Author1 = :Author1, 
                    Author2 = :Author2, 
                    Author3 = :Author3, 
                    Edition = :Edition, 
                    Publisher = :Publisher, 
                    Pages = :Pages, 
                    Remark = :Remark 
                WHERE 
                    BookNo = :bookNo",
                [
                    "bookNo"   => $bookNo,
                    "Title"    => $bookName,
                    "Author1"  => $bookAuthor1,
                    "Author2"  => $bookAuthor2,
                    "Author3"  => $bookAuthor3,
                    "Edition"  => $edition,
                    "Publisher" => $publisher,
                    "Pages"    => $pages,
                    "Remark"   => $remark
                ]
            );
            if ($update) {
                load("Incharge/Dashboard.incharge.search", [
                    "success" => "Book $bookNo Edited Successfully !!!"
                ]);
                exit;
            }
        }

        $book_no = $_GET["book_no"] ?? "";
        if ($book_no == "") {
            redirect("/incharge-dashboard");
        }
        $book_detail = $this->db->query("SELECT * from book_master where BookNo = :bookNo", ["bookNo" => $book_no])->fetch();
        if (!$book_detail) {
            redirect("/incharge-dashboard");
        }
        load("Incharge/Dashboard.incharge.EditBook", [
            "book_detail" => $book_detail
        ]);
        exit;
    }

    /**
     * Insert a Book
     * @return void
     */
    public function insertBook()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $bookName = $_POST["book_name"];
            $bookAuthor1 = $_POST["book_author1"];
            $bookAuthor2 = $_POST["book_author2"];
            $bookAuthor3 = $_POST["book_author3"];
            $edition = $_POST["edition"];
            $publisher = $_POST["publisher"];
            $pages = $_POST["pages"];
            $remark = $_POST["remark"];
            $errors = [];

            if (!Validation::string($bookName, 3, 50)) {
                $errors["bookName"] = "Book Name should be of length between 3 to 50!!!";
            }

            if (!Validation::string($bookAuthor1, 3, 50)) {
                $errors["bookAuthor"] = "Book Author 1 should be of length between 3 to 50!!!";
            }

            if (!Validation::string($bookAuthor2, 0, 50)) {
                $errors["bookAuthor"] = "Book Author 2 should be of max length 50!!!";
            }

            if (!Validation::string($bookAuthor3, 0, 50)) {
                $errors["bookAuthor"] = "Book Author 3 should be of max length 50!!!";
            }

            if (!Validation::string($edition, 1, 50)) {
                $errors["edition"] = "Book Edition should be of length between 1 to 50!!!";
            }

            if (!Validation::string($publisher, 1, 100)) {
                $errors["publisher"] = "Book Publisher should be of length between 1 to 100!!!";
            }

            if (!Validation::string($remark, 1, 200)) {
                $errors["remark"] = "Book Remark should be of length between 1 to 100!!!";
            }

            if ($pages <= 0) {
                $errors["pages"] = "Book Pages should be greater than 0!!!";
            }


            if (!empty($errors)) {
                load("Incharge/Dashboard.incharge.bookManipulation", [
                    "insert_errors" => $errors,
                ]);
                exit;
            }




            //-----Insert
            $insert = $this->db->query(
                "INSERT into book_master(Title, Author1, Author2, Author3, Edition, Publisher, Pages, Remark, Status, Rating,InsertDate) 
                values(:Title, :Author1, :Author2, :Author3, :Edition, :Publisher, :Pages, :Remark,:Status,:Rating,:InsertDate)",
                [
                    "Title"    => $bookName,
                    "Author1"  => $bookAuthor1,
                    "Author2"  => $bookAuthor2,
                    "Author3"  => $bookAuthor3,
                    "Edition"  => $edition,
                    "Publisher" => $publisher,
                    "Pages"    => $pages,
                    "Remark"   => $remark,
                    "Status"  => "Available",
                    "Rating"  => 0,
                    "InsertDate" => date("Y-m-d H:i:s")
                ]
            );



            if ($insert) {
                load("Incharge/Dashboard.incharge.bookManipulation", [
                    "success" => "Book Inserted Successfully !!!"
                ]);
                exit;
            }
        }
        load("Incharge/Dashboard.incharge.bookManipulation");
        exit;
    }
}
