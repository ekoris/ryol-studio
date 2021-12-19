<?php

if(!function_exists("logged_in_user")){
    function logged_in_user() {
        return \Auth::user();
    }
}

if (!function_exists('notice')) {
    function notice($labelClass, $content)
    {
        // Session::forget('notice');
        $notices = Session::get('notice');
        if (!is_array($notices))
            $notices = [];

        array_push($notices, [
            'labelClass' => $labelClass,
            'content' => $content
        ]);

        Session::put('notice', $notices);
    }
}