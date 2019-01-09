'use strict';


/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////



var TableauCountProduct = [];// Tableau ou il y'a le nombre de produit( un compteur);

var TableauPanier = [];// Tableau ou il y'a mes produits(description)


var divPanier = $("<div class='countArticle'>");


/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

$(".AjoutBasket").on("click", RecupId);// j'appelle mon bouton ajouter un produit, et j'écoute son click.
$(".login").on("click", Connexion);
$(".overlay").on("click", HideOverLay);
$("#Connexion").on("click", RequetePostConnexion);
$(".SendSignup").on("click", RequetePostSignup);




function RequetePostConnexion(){
// ici je fait une requête ajax pour vérifier si l'utilisteur ne se trompe pas de mot de passe;

var data = {// je crée une variable avec en objet les valeurs des inputs, du login et du mot de passe

    "login": $("#login").val(),
    "password" : $("#password").val()


};



        $.post(getRequestUrl()+"/login",data,ReturnStatutConnexion)// ici je fais ma requête ajax et je lui envoye mon tableau

}

function ReturnStatutConnexion(Connexion){// ici j'ai reçu les informations du tableau LOGIN sql;

    Connexion = JSON.parse(Connexion);// ici je parse ce que j'ai reçu
    console.log(Connexion);

    var login =  $("#login").val();// dans ma variable je reçois la valeur de mon login
    if(Connexion.user == login){// ici je compare ma valeur de mon login, a mes valeurs dans mon tableau sql

        window.location.assign(getRequestUrl());// si c'est bon je redirige vers la homepage
    }
    else{

        $(".ErrorIDorPassword").text("Mauvais Identifiant ou Mot de passe.");//sinon je lui indique que le mot de passe est faux

    }


}

function RequetePostSignup(){

    var data = {// je crée une variable avec en objet les valeurs des inputs, du login et du mot de passe
        "lastname":$(".lastname").val(),
        "firstname":$(".firstname").val(),
        "email":$(".email").val(),
        "user": $(".user").val(),
        "password": $(".passwordSignup").val()


    };

    $.post(getRequestUrl()+"/signup",data,VerifyUserOnDatabaseSignup)



}
function VerifyUserOnDatabaseSignup(UserSignup){

    UserSignup = JSON.parse(UserSignup);

    if (UserSignup == "Success"){
        window.location.assign(getRequestUrl()+"/");
        return;
    }

    var user = $(".user").val();
    for(var UserOnTable of UserSignup){


        if(UserOnTable.user == user){

            $(".ErrorUser").text("Identifiant déjà existant");

        }


    }



}




function Connexion(){

    $(".Connect").show();
    $(".overlay").show();



}


function HideOverLay(){

    $(".overlay").hide();
    $(".Connect").hide();

}






function RecupId(){
// je fait une requête ajax pour récupérer l'id de mon produit

    var id = $(this).data("id_product");// je lui donne le numéro de mon data dedans il y'a mon id de produit en php.


    $.getJSON(getRequestUrl()+"/basketlocalstorage?id="+id, addLocalStorage);// je lui assigne une page vide , requête ajax en back

}



function CountPanier(){


// Ma fonction Panier sert a avoir le nombre d'article que j'ai dans mon panier
    divPanier.empty();// ici je supprime une première fois pour par que mes numéros(nombre de produit) ce répète

    $(".divCountArticle").append(divPanier);// ici je push ma div dans un lien qui s'appelle "Mon panier"


        divPanier.text(TableauCountProduct);// ici j'affiche dans une div le nombre de produit



}

// mon paramètre article correspond au nombre de la position du TableauPanier
function PushCountProductInTab(article){

    if(TableauCountProduct == null){

        TableauCountProduct = [1];// je lui assigne une valeur de départ 1

    }else{

        TableauCountProduct = [];

        article = TableauPanier.length + 1;// ici article est égale à la position du tableau de produit et vue qu'il commence a zéro je lui rajoute 1 donc article = 1

        TableauCountProduct.push(article);// ici je push dans mon tableau de nombre de produit mon article

    }
}
function addLocalStorage(Product) {
//ici j'ajoute mon produit dans le local storage


    var id = Product.id_product;// ici la var id devient l'id du produit

    TableauPanier = loadDataFromDomStorage("Panier");


    var TabProduct = Product;

    TabProduct.quantity = $(".quantity" + id).val();// ici pour palier a un problème de classe je rajoute l'id de l'article ce qui donne par exemple quantity1 dans mon code HTML il y'a aussi l'id de l'article dans la classe.

    TabProduct.TVA = (TabProduct.saleprice*TabProduct.quantity)*0.20;
    TabProduct.TTC = (TabProduct.saleprice*TabProduct.quantity)*1.20

    // si le Tableau Panier est inexistant il me crée un Tableau.
    if (TableauPanier == null) {
        TableauPanier = [];
    }
    if (TabProduct.quantity == "") {


        TabProduct.quantity = "1";


    }
     if (TabProduct.quantity > 10){

                console.log(TabProduct.quantity)
        $("#Error"+id).empty();
        $("#Error"+id).text("Vous ne pouvez pas acheter plus de 10 produits de cette article.");
         $(".quantity"+id).val("1");


    }
    else if(TabProduct.quantity < 1){

         $("#Error"+id).empty();
         $("#Error"+id).text("Vous ne pouvez pas acheter un produit avec "+TabProduct.quantity+" en Quantité.");
     }
    else if(TabProduct.quantity >= 1){

    PushCountProductInTab()// ici je rappel ma fonction
    $(".Error").empty();

    TableauPanier.push(TabProduct);// je push mon tableau de produits avec ma quantité(TabProduct.quantity) dans mon tableau panier
    saveDataToDomStorage("Panier", TableauPanier);// ici je sauvegarde mes informations dans le localstorage(Tableau de produit)
    saveDataToDomStorage("CountArticle", TableauCountProduct);// ici je sauvegarde mes informations dans le localstorage(Tableau du nombre de produit)
         $(".quantity"+id).val("1");
    }


           // TableauPanier.push(TabProduct);


        Display()
    console.log(TableauPanier);


}

function RecapPanier(panier,Id_Delete){



    // je créer une architecture html pour avoir un récapitulatif de mon panier

    var DivRecap = $("<div class='RecapPanierProduct grid-4'>");
    var divimageproduct = $("<div class='RecapPanierImageProduct'>");
    var divInformationProduct = $("<div class='RecapPanierInformationProduct'>");
    var divInformationQuantityPrice = $("<div class='RecapPanierInformationQuantityPrice'>");



    var imageproduct = $("<img>");
    imageproduct.attr("src","../images/image_site/"+panier.photo);
    divimageproduct.append(imageproduct);

    var Produit = $("<p>");
    var Description = $("<p>");
    Produit.text(panier.name);
    Description.text(panier.description);
    divInformationProduct.append(Produit);
    divInformationProduct.append(Description);


    var Quantity = $("<p>");

    var Prix = $("<p>");

    Quantity.text("Quantité: "+panier.quantity);
    Prix.text("Prix (Hors-Taxe): "+panier.saleprice*panier.quantity+"€");
    divInformationQuantityPrice.append(Quantity);
    divInformationQuantityPrice.append(Prix);


    var divButtonAddBasket = $("<div class='RecapPanierButtonAddBasket'>");
    var DeleteArticle = $("<span class='DeleteArticle'>");
    var PDeleteArticle = $("<p>");
    PDeleteArticle.text("Supprimer");
    DeleteArticle.attr("data-suppr",Id_Delete);    // ici je crée un id pour pouvoir supprimer de mon tableau un article
    DeleteArticle.append("<i class=\"fas fa-times\">")
    DeleteArticle.on("click", SupprArticleLocalStorage)
    divButtonAddBasket.append(PDeleteArticle);
    divButtonAddBasket.append(DeleteArticle);






    DivRecap.append(divimageproduct);
    DivRecap.append(divInformationProduct);
    DivRecap.append(divInformationQuantityPrice);
    DivRecap.append(divButtonAddBasket);


    $(".VideRecapPanier").append(DivRecap);



}


// dans cette fonction je supprime L'article et en plus le nombre d'article

function SupprArticleLocalStorage(article){// ici je recois le nombre d'article

    var Delete = $(this).data("suppr");



    TableauPanier.splice(Delete,1);
    TableauCountProduct = [];
    article = TableauPanier.length;

    // Si le nombre d'article est égale a 0 je cache ma dive
    if(article == 0){


        $(".countArticle").hide();

    }

    TableauCountProduct.push(article);// push le nombre d'article restant dans TableauCountProduct

    saveDataToDomStorage("Panier",TableauPanier);// sauvegarde Mon tableau de produit dans le localstorage
    saveDataToDomStorage("CountArticle", TableauCountProduct);// sauvegarde Mon Tableau de nombre de produit dans le localstorage

    if(TableauPanier.length == 0){
        $(".DivErrorPasco").empty();
        $(".ButtonValiderBasket").empty();
        var DivError = $("<div class='ErrorPanier'>")
        var Message = $("<p>");
        var Icone = $("<p>");
        Message.text("Votre panier est vide.");// on lui donne un text.
        Icone.append("<i class=\"fas fa-sad-cry\">");
        DivError.append(Message);
        DivError.append(Icone);
        $(".EmptyErrorPanier").append(DivError);

    }

    Display();// appelle la fonction display

}

function Display(){

    $(".VideRecapPanier").empty();// ici je vide le panier pour éviter des doublon exemple (Panier1,   Panier1,Panier1,Panier2,   Panier1,Panier1,Panier1,Panier2,Panier2,Panier3)

    TableauCountProduct = loadDataFromDomStorage("CountArticle");//ici je charge les informations de mon Tableau de nombre de produit depuis localstorage
    TableauPanier = loadDataFromDomStorage("Panier");// ici je charge les informations de mon Tableau de produti depuis localstorage


    var id_Delete = 0 ;// ici je lui donne une valeur zéro

    if (TableauPanier != null) {


        // je fais une boucle pour chercher dans mon Tableau de produit

        for(var panier of TableauPanier){


            CountPanier(panier);//je rappel ma fonction CountPanier

            RecapPanier(panier,id_Delete);// ici je renvoie mon Panier + ma valeur id_Delete qui est  égale à 0
            id_Delete++// a chaque fois que je crée un produit je lui donne +1 a ma valeur id_Delete


        }





    }
}

// CODE GLOBAL
TableauCountProduct = loadDataFromDomStorage("CountArticle");//ici je charge les informations de mon Tableau de nombre de produit depuis localstorage
TableauPanier = loadDataFromDomStorage("Panier");// ici je charge les informations de mon Tableau de produti depuis localstorage


if(TableauPanier == null){// si il n'existe aucun tableau alors

    // rappel TableauPanier , stock tous mes articles.
    TableauPanier = [];// on lui recrée un tableau


}
if(TableauCountProduct == null){// si il n'existe aucun tableau alors

    // rappel TableauCountProduct , c'est le Compteur produit qu'il y'a dans le panier.
    TableauCountProduct = [];// on lui recrée un tableau


}



if(TableauPanier.length == 0){// Si il n'y a rien dans mon panier

    var DivError = $("<div class='ErrorPanier'>")
    var Message = $("<p>");
    var Icone = $("<p>");
    Message.text("Votre panier est vide.");// on lui donne un text.
    Icone.append("<i class=\"fas fa-sad-cry\">");
    DivError.append(Message);
    DivError.append(Icone);
    $(".EmptyErrorPanier").append(DivError);
}
else if(TableauPanier.length >= 1){// si il y'a plus de 1 article dans mon panier

    var ButtonValider = $("<button class='SendBasket'>");// création d'un bouton pour valider la commande

    var ButtonValiderClientNotConnected = $("<button class='ButtonErrorPasco'>")

    ButtonValiderClientNotConnected.text("Valider le panier")

    ButtonValider.text("Valider mon panier");// on lui donne un text
    $(".DivErrorPasco").append(ButtonValiderClientNotConnected)
    $(".ButtonValiderBasket").append(ButtonValider); // On l'envoye dans une div

}
$(".ButtonErrorPasco").on("click", ClientNotConnectedButtonGrey)

function  ClientNotConnectedButtonGrey() {

    Connexion();

}

$(".SendBasket").on("click", PageOfThune);

function PageOfThune(){


    var data = {

        "Panier": JSON.stringify(TableauPanier)

    }
    $.post(getRequestUrl()+"/localstoragetophp",data,ReturnLocalStorageToPHP);
    console.log(data)

}

function ReturnLocalStorageToPHP(id){



     id = JSON.parse(id);


    window.location.assign(getRequestUrl()+"/recappanier?id="+id);

}



Display();





 //var id = $(this).data("id");
   // window.location.assign(getRequestUrl()+"/categoryproductbread?id="+$(this).data("id"), EditionTweet);


// $.getJSON("Main.php?action=ajax&id="+$(this).data("id"), EditionTweet);