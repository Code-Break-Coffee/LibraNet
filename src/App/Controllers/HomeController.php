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