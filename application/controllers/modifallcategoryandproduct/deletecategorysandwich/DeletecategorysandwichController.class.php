<?php

class DeletecategorysandwichController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        $id = $queryFields["id"];

        $Category = new CategoryproductModel();

        $Category->DeleteCategorySandwich($id);

        $http->redirectTo("/sandwich");
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





        /*
         * Méthode appelée en cas de requête HTTP POST
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
         */
    }
}