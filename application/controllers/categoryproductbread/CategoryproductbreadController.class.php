<?php

class CategoryproductbreadController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        session_start();
        // RECUPERE L ID DEPUIS BreadView dans la table categorybread

        $id = $queryFields["id"];


        $Categoryproduct = new CategoryproductModel();// appelle la function principale
        $CategoryBread = $Categoryproduct->AfficheCategoryProductBread($id);// appelle la fonction et lui retourne l'id
        $TitleCategoryBread = $Categoryproduct->AfficheTitleBreadCategoryProduct($id);// appelle la fonction et lui retourne l'id


        //retourne le tableau pour afficher tous les catégories

        return ["Allproductbread"=>$CategoryBread,
                "TitlesBread"=>$TitleCategoryBread];
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