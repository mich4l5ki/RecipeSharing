<?php

require_once "DBInit.php";

class UserDB {

    // Returns true if a valid combination of a username and a password are provided.
    public static function validLoginAttempt($username, $password) {
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare("SELECT userID, username, password FROM user WHERE username = :username LIMIT 1");
        $statement->bindParam(":username", $username);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return True;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function getUserID($username) {
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare("SELECT userID FROM user WHERE username = :username LIMIT 1");
        $statement->bindParam(":username", $username);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user['userID'];
    }

    // return true if username exists
    public static function validUsername($username) {
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare("SELECT COUNT(userID) FROM user WHERE username = :username");
        $statement->bindParam(":username", $username);
        $statement->execute();

        return $statement->fetchColumn(0) == 1;
    }

    public static function addNewUser($username, $password) {
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare("INSERT INTO user (username, password) VALUES(:username, :password)");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", password_hash($password, PASSWORD_DEFAULT));

        if($statement->execute()){
            return True;
        } else{
            return False;
        }
    }

}
