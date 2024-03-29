<?php

class DeconnexionController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

        // RECUPERE L ID DEPUIS SodaView dans la table categorysoda
        session_start();
        session_destroy();

        $http->redirectTo("/");
        /*
         * Méthode appelée en cas de requête HTTP GET
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
         */
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        /*
         * Méthode appelée en cas de requête HTTP POST
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
         */
    }
}