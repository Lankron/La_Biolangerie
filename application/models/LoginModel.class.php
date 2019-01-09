<?php


class LoginModel
{



    function Register($firstname,$lastname,$user,$password,$email){

        $database = new Database();

        $database->executeSql("INSERT INTO `login`(`user`, `password`, `email`, `lastname`, `firstname` ) VALUES (?,?,?,?,?)", [$user,password_hash($password,PASSWORD_DEFAULT),$email,$lastname,$firstname]);

    }
    function VerifyUserOnRegister($user){

        $database = new Database();

        $VerifyUserOnRegister = $database->query("SELECT * FROM login WHERE user = ?", [$user]);


        return $VerifyUserOnRegister;



    }

    function Verifyuser($user,$password){

        $database = new Database();

      $login =  $database->queryOne("SELECT id,`user`,password,firstname,lastname,email FROM login WHERE `user` = ?", [$user]);


        if($login){

            if(password_verify($password, $login["password"])){

                session_start();

                $_SESSION["id_client"] = $login["id"];
                $_SESSION["prenom"] = $login["firstname"];
                $_SESSION["nom"] = $login["lastname"];


            }
        }
        return $login;
    }


}