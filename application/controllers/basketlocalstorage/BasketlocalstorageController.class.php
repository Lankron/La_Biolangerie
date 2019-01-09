<?php

class BasketlocalstorageController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

        // RECUPERE L ID DEPUIS BreadView dans la table categorybread

            $id = $queryFields["id"];

            $Panier = new CategoryproductModel();

           $test = $Panier->OneProductRecuperedById($id);

           $http->sendJsonResponse($test);
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