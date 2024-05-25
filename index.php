<?php

// require_once("controller/BookController.php");
require_once("controller/UserController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [

    "user/register" => function () {
        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     UserController::register();
        // } else {
        //     UserController::showRegisterForm();
        // }
        UserController::showRegisterForm();
    },

    "" => function () {
        ViewHelper::redirect(BASE_URL . "user/register");
    },
];

try {
    if (isset($urls[$path])) {
       $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
    ViewHelper::error404();
} 
