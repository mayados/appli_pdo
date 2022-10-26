<?php
    /* Permet de démarrer une session sur le serveur pour l'utilisateur courant, ou la récupérer s'il en avait déjà une */
    session_start();
    require('functions.php');
    require('db-functions.php');
    connexion();
    findAll();

    /* On a indiqué dans index que le mot clé pour récupérer action s'appelle "action"*/
    $action = $_GET["action"];
    /* Pour éviter des erreurs, on vérifie s'il y a bien la valeur à la variable ref / les  ":" signifient que s'il n'y a pas on met rien */
    $ref = (isset($_GET['ref'])) ? $_GET['ref'] : "";
    $name = (isset($_GET['name'])) ? $_GET['name'] : "";
    $price = (isset($_GET['price'])) ? $_GET['price'] : "";
    var_dump($ref);
    $produit = (isset($_GET['produit'])) ? $_GET['produit'] : "";   
    $qtt = 1; 
    /* Si un produit est ajouté.. */
    switch($action) {

        case "ajouterProduit":
              /* Vérifier si l'on a la clé id du produit */
            if(isset($_GET['ref'])){
                /* Vérification de l'intégralité des valeurs transmises dans le tableau $_POST en fonction de celles que nous attendons */
                $id = $ref;
                $name = $name;
                $price = $price;
                $qtt = $qtt;


                //Nous devons conserver chaque produit renseigné, donc les stocker esession. On décide d'abord de leur organisation au sein de la session 
                if($name){

                    $product = [
                        "id" => $id,
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price*$qtt
                    ];
                
                    /* On enregistre le produit en session */
                    /* On appelle le tableau session fournit par php, on y indique un clé "products" */
                    $_SESSION['products'][] = $product;
                    
                    $_SESSION['message'] = "<div id='succes'>Le produit $name a été ajouté avec succès</div>";

                    
                }
            }


            /* Redirection vers la page admin, qu'il soit saisi ou non */
            header("Location:recap.php");
        break;

        /* On a nommé l'action "viderPanier" dans récap.php. Au cas où c'est cela, on retire tous les produits de la session et on rediirige vers la page recap.php */
        case "viderPanier":
            unset($_SESSION['products']);
            $_SESSION['message'] = "<div id='panier-sup'>L'ensemble du panier a été supprimé</div>" ;        
            header("Location:recap.php");
        break;

        case "augmenterQuantite":
            /* IL FAUT PRECISER OBLIGATOIREMENT L INDEX DU PRODUIT QUE L'ON VEUT AUGMENTER */
            $_SESSION['products'][$ref]["qtt"]++;
            /* On dit que le total des produits pour cet index est égal à la quantité de cet index multiplié au prix affiché dans cet index */
            $_SESSION['products'][$ref]["total"] =  $_SESSION['products'][$ref]["qtt"] *  $_SESSION['products'][$ref]["price"];
            header("Location:recap.php");
        break;

        case "baisserQuantite":
            /* Il faut supprimer le produit quand la quantité est inférieure à 1 */
            if($_SESSION['products'][$ref]["qtt"] > 1){
                $_SESSION['products'][$ref]["qtt"]--;
                $_SESSION['products'][$ref]["total"] =  $_SESSION['products'][$ref]["qtt"] *  $_SESSION['products'][$ref]["price"];                
            }else {
                unset($_SESSION['products'][$ref]);   
            }
            header("Location:recap.php");            
        break;

        case "suppprimerProduit":  
            unset($_SESSION['products'][$ref]);
            /* Ici, on a pu obtenir le nom du produit grace à GET plus haut (recuperation des données depuis recap.php) */
            $_SESSION['message'] ="<div id='produit-sup'>Le produit $produit a été supprimé</div>" ;        
            header("Location:recap.php");
        break;
    }

  
?>