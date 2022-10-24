<?php
    /* Permet de démarrer une session sur le serveur pour l'utilisateur courant, ou la récupérer s'il en avait déjà une */
    session_start();
    require('functions.php');

    /* On a indiqué dans index que le mot clé pour récupérer action s'appelle "action"*/
    $action = $_GET["action"];
    /* Pour éviter des erreurs, on vérifie s'il y a bien la valeur à la variable ref / les  ":" signifient que s'il n'y a pas on met rien */
    $ref = (isset($_GET['ref'])) ? $_GET['ref'] : "";
    $produit = (isset($_GET['produit'])) ? $_GET['produit'] : "";    
    /* Si un produit est ajouté.. */
    switch($action) {

        case "ajouterProduit":
              /* Vérifier si la clé "submit" correspond bien à l'attribut "name" du bouton du formulaire : cela limite l'accès à traitement.php. Seules les requêtes HTTP provenant de la soumission de notre formulairesont acceptées */
            if(isset($_POST['submit'])){
                /* Vérification de l'intégralité des valeurs transmises dans le tableau $_POST en fonction de celles que nous attendons */
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);


                //Nous devons conserver chaque produit renseigné, donc les stocker esession. On décide d'abord de leur organisation au sein de la session 
                if($name && $price && $qtt){

                    $product = [
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


            /* Redirection vers le formulaire, qu'il soit saisi ou non */
            header("Location:index.php");
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