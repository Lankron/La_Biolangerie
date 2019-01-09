<?php

class SignupController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        session_start();
        // j'appelle ma fonction ou j'ai mis toute mes catégories

        /*
         * Méthode appelée en cas de requête HTTP GET
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
         */
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

        $Signup = new LoginModel();
        $login = $formFields["user"];
        $password = $formFields["password"];
        $email = $formFields["email"];
        $lastname = $formFields["lastname"];
        $firstname = $formFields["firstname"];





            $userVerify = $Signup->VerifyUserOnRegister($login);
        if($userVerify) {
            $http->sendJsonResponse($userVerify);
        }
        else{
            $Signup->Register($firstname,$lastname,$login,$password,$email);
            $http->sendJsonResponse("Success");

        }



        /*
         * Méthode appelée en cas de requête HTTP POST
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
         */
    }
}