<?php

include_once 'date.php';

if (! function_exists('en2bn')) {
    function en2bn($num)
    {
        $en = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        $bn = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
        $output = str_replace($en, $bn, $num);

        return $output;
    }
}

// authUser custom method
if (! function_exists('authUser')) {
    function authUser()
    {
        return auth()->user();
    }
}

// getRole from laratrust

if (! function_exists('getRole')) {
    function getRole()
    {
        return auth()->user()->roles->first()->name;
    }
}
