<?php


class OrdersModel
{

    function AddOrderNumberOnDatabase($id_client){

        $database = new Database();

        return $database->executeSql("INSERT INTO `orders`(`orderdate`, `id_client`) VALUES (NOW(),?)",[$id_client]);

    }

    function AddOrderDetailsOnDatabase($id_products,$quantityordered,$priceHT,$priceTVA,$priceTTC,$ordernumber){

        $database = new Database();

      $sql =  "INSERT INTO `orderdetails`( `id_products`, `quantityordered`, `priceHT`, `priceTVA`, `priceTTC`, `ordernumber`) VALUES (?,?,?,?,?,?)";

        $database->executeSql($sql,[$id_products,$quantityordered,$priceHT,$priceTVA,$priceTTC,$ordernumber]);

    }



}