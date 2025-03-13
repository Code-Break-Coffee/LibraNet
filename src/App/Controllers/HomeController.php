<?php

namespace App\Controllers;

class HomeController
{
    /**
     * Show the home page
     * @return void
     */
    public function index()
    {
        // EmailController::sendEmail("zk.khan2003@gmail.com","Test Email","This is a test email","<h1>This is a test email</h1>");
        load("Home");
    }

    /**
     * Show the admin dashboard
     * @return void
     */
    public function adminDashboard()
    {
        load("AdminDashBoard");
    }

}