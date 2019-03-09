<?php

function debug($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function redirect($http = false) {
    if($http) {
        $redirect = $http;
    }else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }

    header("Location: $redirect");
    die();
}