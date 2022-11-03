<?php
            /* Il faut avoir accès au tableau $_SESSION pour connaître le nombre de produits actuels */
            session_start();
            require('db-functions.php');
            connexion();
            /* On utilise findAll() pour trouver chaque produit */
            $products = findAll();
            require('functions.php');
            showMessage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="5"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="css/index.css">
    <title>index php</title>
</head>
<body>
    <div id="container-page">
        <div id="container-infos">
            <div id="panier">
                <a id="recap" href="recap.php"><i class="fa-solid fa-cart-shopping"></i></a> 
                <p id="nb-produits">
                                    <?php
                                    
                                        if(isset($_SESSION['products'])){
                                            /* Déclarer la variable ici et non en dehors de la condition, sinon cela fera undefined */
                                            $nombreProduits = $_SESSION['products']; 
                                            echo " ".count($nombreProduits)."";
                                        } else{
                                            echo "0";
                                        }
                                    ?>
                </p>
            </div>
        </div>
        <div id="container-products">
            <?php
            
            /* Pour chaque produit, on affiche ses informations */
            foreach ($products as $product) {
            echo "<div class ='container-product'>
                    <h3><a href='product.php?ref=".$product['id']."'>".$product['name']."</a></h3> "
                    .substr($product['description'],0,45)."...<br> 
                    <strong>".$product['price']." euros</strong><br>
                    <a href='traitement.php?action=ajouterProduit&ref=".$product['id']."'>Ajouter au panier</a>
                </div>"; 
            }
        ?>
        </div>
        

    </div>
</body>
</html>
