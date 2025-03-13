<?php

namespace App\Controllers;

use Framework\Database;
class UserController
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
        load("User/Signin.user");
    }

    /**
     * Show the Forgot Password page
     * @return void
     */
    public function forgotPassword()
    {
        load("User/ForgotPassword.user");
    }

    /**
     * Show the Sign Up page
     * @return void
     */
    public function signup()
    {
        load("User/Signup.user");
    }
}