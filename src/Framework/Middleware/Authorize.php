<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize
{
    /**
     * Check if user is authenticated
     * @return bool
     */
    function isAuthenticated($user)
    {
        return Session::check($user);
    }

    /**
     * Handle the user`s request
     * @param string $role
     * @return bool
     */
    function handle($role)
    {
        if($role === "guest-incharge" && $this->isAuthenticated("incharge"))
        {
            return redirect("/incharge-dashboard");
        }
        else if($role === "auth-incharge" && !$this->isAuthenticated("incharge"))
        {
            return redirect("/incharge-signin");
        }
        else if($role === "guest-member" && $this->isAuthenticated("member"))
        {
            return redirect("/member-dashboard");
        }
        else if($role === "auth-member" && !$this->isAuthenticated("member"))
        {
            return redirect("/");
        }
        else if($role === "guest-member" && $this->isAuthenticated("incharge"))
        {
            return redirect("/incharge-dashboard");
        }
        else if($role === "guest-incharge" && $this->isAuthenticated("member"))
        {
            return redirect("/member-dashboard");
        }
    }
}