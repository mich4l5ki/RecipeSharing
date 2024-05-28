<?php
session_start();

require_once("controller/UserController.php");
require_once("controller/RecipeController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "recipe" => function () {
        RecipeController::index();
     },

    "recipe/edit" => function () {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        RecipeController::editRecipe();
    } else {
        RecipeController::recipeEditForm();
    }
    },

    "user/login" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::login();
        } else {
            UserController::showLoginForm();
        }
    },

    "user/logout" => function () {
        UserController::logout();
    },

    "user/register" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::register();
        } else {
            UserController::showRegisterForm();
        }
    },

    "recipe/delete" => function () {
        RecipeController::delete();
    },

    "recipe/add" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            RecipeController::addRecipe();
        } else {
            RecipeController::addRecipeForm();
        }
    },

    "" => function () {
        ViewHelper::redirect(BASE_URL . "recipe");
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