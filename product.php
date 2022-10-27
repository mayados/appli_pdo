<?php

    require('db-functions.php');
    connexion();
    $id= $_GET['ref'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
    <div id="container-page">
        <a href="index.php">Retour</a>
        <?php
            /* Nous récupérons la valeur envoyée dans le lien, qui correspond à l'id du produit */
            $ref = (isset($_GET['ref'])) ? $_GET['ref'] : "";
            $produit = findOneById($ref);


            foreach ($produit as $prod) {
                echo "<br>".$prod['name']."<br>"
                .$prod['description']."<br>"
                .$prod['price']." euros<br>"; 
                echo "<a href='traitement.php?action=ajouterProduit&ref=".$id."'>Ajouter au panier</a>";        
            }
            // die;
        ?>
        <!-- On renvoie vers la page traitement pour que les produits soient ajoutés -->
        
    </div>
</body>
</html>