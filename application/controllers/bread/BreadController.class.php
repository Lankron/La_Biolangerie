<?php

class BreadController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        session_start();
        // j'appelle ma fonction ou j'ai mis toute mes catégories
        $CategoriesProduct = new CategoryproductModel();
        $Categoriesbread = $CategoriesProduct->AffichageCategoryBread();// je lui donne son propre id grâce a ça je peut avoir des détails sur le pain.

        return ["Categoriesbread" => $Categoriesbread];//je retourne mon tableau avec mes valeurs
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