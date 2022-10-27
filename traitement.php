<?php
    /* Permet de démarrer une session sur le serveur pour l'utilisateur courant, ou la récupérer s'il en avait déjà une */
    session_start();
    require('functions.php');
    require('db-functions.php');
    connexion();
    /* Pour récupérer les éléments de la bdd, il faut s'y connecter. Et connexion() a déjà été appelée dans cette fonction*/
    findAll();
    
    /* On a indiqué dans index que le mot clé pour récupérer action s'appelle "action"*/
    $action = $_GET["action"];
    /* Pour éviter des erreurs, on vérifie s'il y a bien la valeur à la variable ref / les  ":" signifient que s'il n'y a pas on met rien */
    $ref = (isset($_GET['ref'])) ? $_GET['ref'] : ""; 
    $qtt = 1; 
    $idP= $_GET['ref']; 
    /* Si un produit est ajouté.. */
    switch($action) {
        
        case "ajouterProduit":
            /* Notre produit est égal à la function findOneById (car on récupère tous les éléments définissants le produit) ayant pour référence $_GET['ref'] (= on récupère la référence du produit avec un get)*/
            $produit = findOneById($_GET['ref']);
              /* Vérifier si l'on a la clé id du produit */
            if(isset($idP)){
        
                /* Vérification de l'intégralité des valeurs transmises dans le tableau $_POST en fonction de celles que nous attendons */
                
                $id = $idP;
                /* $name est égal à l'attribut 'name' du produit que l'on a récupéré avec findOneById (le produit est ici représenté par la variable $produit) */
                $name = $produit['name'];
                $price = $produit['price'];
                $qtt = $qtt;    
                // var_dump($id);    
                // var_dump($name);      
                // var_dump($price);       
                // die;                   
                
                
                /* Enlever les doublons dans le panier */

                /* Pour chaque produit dans le panier, nous avons l'index et le produit. L'index est égal à l'index affiché dans le panier (=chaque produit se situe à un index du tableau products) */
                foreach($_SESSION['products'] as $index => $product){
                    var_dump($product['id']);
                    var_dump($id);
                    
                    if($product['id'] == $id){
                        /* Si l'id (de la bdd) du produit mis dans le panier est égal à l'id (de la dbb) du produit que l'on souhaite ajouter, on appelle l'action augmenterQuantité (qui va éxecuter le code présent dans cette action) */
                        header("Location:traitement.php?action=augmenterQuantite&ref=".$index);
                        /* Sans le die, cette action ne s'effectue pas, on arrête l'éxecution du programme ici */
                        die;
                    }
                    /*  Pas de else ici, ainsi ca ne rajoute pas des produits inutilement. Naturellement, dans l'autre cas, le produit sera ajouté */
                }


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


            /* Redirection vers la page recap */
            header("Location:recap.php");
        break;

        case "ajouterProduitBdd":
            /* On vérifie d'abord que le formulaire a été envoyé avec le bouton */
            if(isset($_POST['submit'])){
                /* On filtre les input et textarea pour ne pas qu'il y ait des failles allant contre la sécurité */
                $nom = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
                $prix = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $descr = filter_input(INPUT_POST, "descr", FILTER_SANITIZE_SPECIAL_CHARS);

                /* Si nous avons tous les champs remplis correctement */
                if($nom && $prix && $descr){
                    /* On appelle la fonction créée dans db-functions.php pour insérer un produit dans la bdd */
                    /* Penser à mettre les variables dans le même ordre que dans la fonction */
                    /* On a return un integer depuis la function insertProduct, donc quand on appelle la function, on appel l'entier qui y est associé */
                    $lastId = insertProduct($nom,$descr,$prix);
                }
            }
                header("Location:product.php?&ref=$lastId&name=$nom&price=$prix");
 

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