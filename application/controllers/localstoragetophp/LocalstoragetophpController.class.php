<?php

class LocalstoragetophpController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        session_start();
        // RECUPERE L ID DEPUIS BreadView dans la table categorybread


        /*
         * Méthode appelée en cas de requête HTTP GET
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
         */
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        session_start();
        $id_client = $_SESSION["id_client"];

        $InsertOrderOnDatabase = new OrdersModel();

       $id_Order = $InsertOrderOnDatabase->AddOrderNumberOnDatabase($id_client);

        $_SESSION["order_id"] = $id_Order;
        // session_start();



        $Panier = json_decode($formFields["Panier"]);


        foreach($Panier as $Productdetail) {

            $InsertOrderOnDatabase->AddOrderDetailsOnDatabase($Productdetail->id_product, $Productdetail->quantity, $Productdetail->saleprice, $Productdetail->TVA,$Productdetail->TTC ,$id_Order);
        }
        $http->sendJsonResponse($id_Order);
            /*
             * Méthode appelée en cas de requête HTTP POST
             *
             * L'argument $http est un objet permettant de faire des redirections etc.
             * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
             */
    }
}