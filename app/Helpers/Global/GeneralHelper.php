<?php

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('checkRoleName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function checkRoleName($role)
    {
        $role = lcfirst($role);
        if ($role == 'cs_maker')  return 'Customer Service';
        if ($role == 'manager')  return 'Manager';
        if ($role == 'super_administrator')  return 'Super Administrator';
        if ($role == 'administrator')  return 'Administrator';
        if ($role == 'agent')  return 'Agent';
        if ($role == 'sub_agent')  return 'Sub Agent';
        if ($role == 'employee')  return 'Employee';
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('home_route')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        // Redirected to dashboard
        return 'admin.dashboard';


        if (auth()->check()) {
            if (auth()->user()->can('view backend')) {
                return 'admin.dashboard';
            }

            return 'frontend.user.dashboard';
        }

        return 'frontend.index';
    }
}
