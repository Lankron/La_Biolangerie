<?php

class LoginController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        session_start();
        // RECUPERE L ID DEPUIS SodaView dans la table categorysoda

        /*
         * Méthode appelée en cas de requête HTTP GET
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
         */
    }

    public function httpPostMethod(Http $http, array $formFields)
    {




        $VerifyUser = new LoginModel();

        $login = $formFields["login"];
        $password = $formFields["password"];


        if(isset($formFields["login"]) && isset($formFields["password"])){

            $user = $VerifyUser->Verifyuser($login,$password);
        }



        $http->sendJsonResponse($user);

        exit();
        /*
         * Méthode appelée en cas de requête HTTP POST
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
         */
    }
}