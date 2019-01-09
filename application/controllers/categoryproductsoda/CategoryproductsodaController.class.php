<?php

class CategoryproductsodaController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        session_start();

        // RECUPERE L ID DEPUIS SodaView dans la table categorysoda

        $id = $queryFields["id"];

        $Categoryproduct = new CategoryproductModel();// appelle la function principale
        $CategorySoda = $Categoryproduct->AfficheCategoryProductSoda($id);// appelle la fonction et lui retourne l'id
        $TitleCategorySoda = $Categoryproduct->AfficheTitleSodaCategoryProduct($id);// appelle la fonction et lui retourne l'id

        //retourne le tableau pour afficher tous les catégories

        return ["Allproductsoda"=>$CategorySoda,
                "TitlesSoda"=>$TitleCategorySoda];
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