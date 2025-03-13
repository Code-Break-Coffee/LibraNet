<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize
{
    /**
     * Check if user is authenticated
     * @return bool
     */
    function isAuthenticated()
    {
        return Session::check("incharge");
    }

    /**
     * Handle the user`s request
     * @param string $role
     * @return bool
     */
    function handle($role)
    {
        if($role === "guest-incharge" && $this->isAuthenticated())
        {
            return redirect("/incharge-dashboard");
        }
        else if($role === "auth-incharge" && !$this->isAuthenticated())
        {
            return redirect("/incharge-signin");
        }
    }
}