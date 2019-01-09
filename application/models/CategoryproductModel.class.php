<?php


class CategoryproductModel
{

    // affiche tout les différents type de pains
    function AffichageCategoryBread(){

        $database = new Database();

       return $database->query("SELECT * FROM categorybread");
    }
    // affiche tout les différents type de pâtisseries
    function AffichageCategoryPastry(){

        $database = new Database();

        return $database->query("SELECT * FROM categorypastry");
    }
    // affiche tout les différents type de sandwich
    function AffichageCategorySandwich(){

        $database = new Database();

        return $database->query("SELECT * FROM categorysandwich");
    }
    // affiche tout les différents type de boissons
    function AffichageCategorySoda(){

        $database = new Database();

        return $database->query("SELECT * FROM categorysoda");
    }




    // affiche LA CATEGORIE de pain choisi grace a l'id
    function AfficheCategoryProductBread($id){
        $database = new Database();

        return $database->query("SELECT `id_product`, id, `name`, allproducts.photo, `description`, `categoryproduct`, `quantityinstock`, `buyprice`, `saleprice` FROM `allproducts` INNER JOIN categorybread ON categorybread.CategoryBread=allproducts.categoryproduct WHERE id = ?", [$id]); // l'id vient de l'url, qui lui vient de breadview, dans la table categorybread dans sql.
    }
    // affiche le titre de la catégory de produit de pain
    function AfficheTitleBreadCategoryProduct($id){
        $database = new Database();

        return $database->queryOne("SELECT `id_product`, id, `name`, allproducts.photo, `description`, `categoryproduct`, `quantityinstock`, `buyprice`, `saleprice` FROM `allproducts` INNER JOIN categorypastry ON categorypastry.categorypastry=allproducts.categoryproduct WHERE id = ?", [$id]); // l'id vient de l'url, qui lui vient de breadview, dans la table categorybread dans sql.
    }




    // affiche LA CATEGORIE de patisseries choisi grace a l'id
    function AfficheCategoryProductPastry($id){
        $database = new Database();

        return $database->query("SELECT `id_product`, id, `name`, allproducts.photo, `description`, `categoryproduct`, `quantityinstock`, `buyprice`, `saleprice` FROM `allproducts` INNER JOIN categorypastry ON categorypastry.categorypastry=allproducts.categoryproduct WHERE id = ?", [$id]); // l'id vient de l'url, qui lui vient de breadview, dans la table categorybread dans sql.
    }
    // affiche le titre de la catégory de produit de patisseries
    function AfficheTitlePastryCategoryProduct($id){
        $database = new Database();

        return $database->queryOne("SELECT `id_product`, id, `name`, allproducts.photo, `description`, `categoryproduct`, `quantityinstock`, `buyprice`, `saleprice` FROM `allproducts` INNER JOIN categorypastry ON categorypastry.categorypastry=allproducts.categoryproduct WHERE id = ?", [$id]); // l'id vient de l'url, qui lui vient de breadview, dans la table categorybread dans sql.
    }




    function AfficheCategoryProductSandwich($id){
        $database = new Database();

        return $database->query("SELECT `id_product`, id, `name`, allproducts.photo, `description`, `categoryproduct`, `quantityinstock`, `buyprice`, `saleprice` FROM `allproducts` INNER JOIN categorysandwich ON categorysandwich.categorysandwich=allproducts.categoryproduct WHERE id = ?", [$id]); // l'id vient de l'url, qui lui vient de breadview, dans la table categorybread dans sql.
    }
    // affiche le titre de la catégory de produit de pain
    function AfficheTitleSandwichCategoryProduct($id){
        $database = new Database();

        return $database->queryOne("SELECT `id_product`, id, `name`, allproducts.photo, `description`, `categoryproduct`, `quantityinstock`, `buyprice`, `saleprice` FROM `allproducts` INNER JOIN categorysandwich ON categorysandwich.categorysandwich=allproducts.categoryproduct WHERE id = ?", [$id]); // l'id vient de l'url, qui lui vient de breadview, dans la table categorybread dans sql.
    }




    function AfficheCategoryProductSoda($id){
        $database = new Database();

        return $database->query("SELECT `id_product`, id, `name`, allproducts.photo, `description`, `categoryproduct`, `quantityinstock`, `buyprice`, `saleprice` FROM `allproducts` INNER JOIN categorysoda ON categorysoda.categorysoda=allproducts.categoryproduct WHERE id = ?", [$id]); // l'id vient de l'url, qui lui vient de breadview, dans la table categorybread dans sql.
    }
    // affiche le titre de la catégory de produit de pain
    function AfficheTitleSodaCategoryProduct($id){
        $database = new Database();

        return $database->queryOne("SELECT `id_product`, id, `name`, allproducts.photo, `description`, `categoryproduct`, `quantityinstock`, `buyprice`, `saleprice` FROM `allproducts` INNER JOIN categorysoda ON categorysoda.categorysoda=allproducts.categoryproduct WHERE id = ?", [$id]); // l'id vient de l'url, qui lui vient de breadview, dans la table categorybread dans sql.
    }

    // on récupère qu'un seul produit pour le mettre dans le panier
    function OneProductRecuperedById($id){
        $database = new Database();

        return $database->queryOne("SELECT * FROM allproducts WHERE id_product = ?", [$id]);
    }

    // supprimer la categorie

    function DeleteCategoryBread($id){


        $database = new Database();

        return $database->executeSql("DELETE FROM `categorybread` WHERE id = ?", [$id]);


    }
    function DeleteCategoryPastry($id){


        $database = new Database();

        return $database->executeSql("DELETE FROM `categorybread` WHERE id = ?", [$id]);


    }

    function DeleteCategorySandwich($id){


        $database = new Database();

        return $database->executeSql("DELETE FROM `categorybread` WHERE id = ?", [$id]);


    }

    function DeleteCategorySoda($id){


        $database = new Database();

        return $database->executeSql("DELETE FROM `categorybread` WHERE id = ?", [$id]);


    }



}