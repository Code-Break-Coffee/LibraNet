<?php

namespace App\Controllers;

class ErrorController
{
    /**
     * Error 404
     * @param string $msg
     * @return void
     */
    public static function notFound($msg="Resource Not Found!!!")
    {
        http_response_code(404);
        load("Error/404",[
            "status"=>"404",
            "message"=>$msg,
        ]);
    }

    public static function notAuthorized($msg="Not Authorized to view this Page")
    {
        http_response_code(403);
        load("Error",[
            "status"=>"403",
            "message"=>$msg,
        ]);
    }
}