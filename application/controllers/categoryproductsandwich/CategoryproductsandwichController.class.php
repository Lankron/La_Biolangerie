<?php

class CategoryproductsandwichController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        session_start();
        // RECUPERE L ID DEPUIS SandwichView dans la table categorysandwich

        $id = $queryFields["id"];

        $Categoryproduct = new CategoryproductModel();// appelle la function principale
        $CategorySandwich = $Categoryproduct->AfficheCategoryProductSandwich($id);// appelle la fonction et lui retourne l'id
        $TitleCategorySandwich = $Categoryproduct->AfficheTitleSandwichCategoryProduct($id);// appelle la fonction et lui retourne l'id

        //retourne le tableau pour afficher tous les catégories

        return ["Allproductsandwich"=>$CategorySandwich,
                "TitlesSandwich"=>$TitleCategorySandwich];
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