<?php

if(!function_exists("logged_in_user")){
    function logged_in_user() {
        return \Auth::user();
    }
}