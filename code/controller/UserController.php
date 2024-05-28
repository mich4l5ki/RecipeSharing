<?php

require_once("model/UserDB.php");
require_once("ViewHelper.php");

class UserController {

    static function renderRegisterWithError($error){
        ViewHelper::render("view/user-register-form.php", [
            "errorMessage" => $error
        ]);
    }

    static function renderLoginWithError($error){
        ViewHelper::render("view/user-login-form.php", [
            "errorMessage" => $error
        ]);
    }

    public static function showLoginForm() {
       ViewHelper::render("view/user-login-form.php");
    }

    public static function showRegisterForm() {
        ViewHelper::render("view/user-register-form.php");
     }

    public static function login() {
        $username = "";
        $password = "";
        $username_err = "";
        $password_err = "";

        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
            UserController::renderLoginWithError($username_err);
            return;
        } else{
            $username = trim($_POST["username"]);
        }

        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
            UserController::renderLoginWithError($password_err);
            return;
        } else{
            $password = trim($_POST["password"]);
        }

        if (UserDB::validLoginAttempt($username, $password)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["userID"] = UserDB::getUserID($username);
            ViewHelper::redirect(BASE_URL . "recipe");
        } else {
            ViewHelper::render("view/user-login-form.php", [
                "errorMessage" => "Invalid username or password."
            ]);
        }
    }
    public static function logout() {
        $_SESSION = array();
        session_destroy();
        ViewHelper::redirect(BASE_URL . "recipe");
    }

    public static function register() {
        $username = "";
        $password = "";
        $confirm_password = "";
        $username_err = "";
        $password_err = "";
        $confirm_password_err = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            // VALIDATE USERNAME
            if(empty(trim($_POST["username"]))){
                $username_err = "Please enter a username.";
                UserController::renderRegisterWithError($username_err);
                return;
            } elseif(!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["username"]))) {
                $username_err = "Username can only contain letters, numbers.";
                UserController::renderRegisterWithError($username_err);
                return;
            } elseif (UserDB::validUsername(trim($_POST["username"]))) {
                $username_err = "This username is already taken.";
                UserController::renderRegisterWithError($username_err);
                return;
            } else {
                $username = trim($_POST["username"]);
            }


            // VALIDATE PASSWORD
            if(empty(trim($_POST["password"]))){
                $password_err = "Please enter a password.";
                UserController::renderRegisterWithError($password_err);
                return;
            } elseif(strlen(trim($_POST["password"])) < 12){
                $password_err = "Password must have atleast 12 characters.";
                UserController::renderRegisterWithError($password_err);
                return;
            } else{
                $password = trim($_POST["password"]);
            }

            // VALIDATE PASSWORD CONFIRM
            if(empty(trim($_POST["confirm_password"]))){
                $confirm_password_err = "Please confirm password.";  
                UserController::renderRegisterWithError($confirm_password_err);
                return;
            } else{
                $confirm_password = trim($_POST["confirm_password"]);
                if(empty($password_err) && ($password != $confirm_password)){
                    $confirm_password_err = "Passwords did not match.";
                    UserController::renderRegisterWithError($confirm_password_err);
                    return;
                }
            }

            if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
                if (UserDB::addNewUser(trim($_POST["username"]), trim($_POST["password"]))){
                    ViewHelper::redirect(BASE_URL . "user/login");
                } else {
                    UserController::renderRegisterWithError("Something went wrong, try again!");
                }
            }
        }
     }
}