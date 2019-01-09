<?php


class AstuceDayModel
{

    function DisplayAstuceDay(){

        $database = new Database();

       return  $database->queryOne("SELECT * FROM astuceday WHERE id = 1");


    }

}