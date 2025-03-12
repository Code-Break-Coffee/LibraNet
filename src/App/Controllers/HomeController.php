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
}