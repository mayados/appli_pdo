<?php

    require('db-functions.php');
    /* On se connecte à la base de données */
    connexion();
    /* On récupère la référence du produit concerné */
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
            $produit = findOneById($id);


                echo "<br>".$produit['name']."<br>"
                .$produit['description']."<br>"
                .$produit['price']." euros<br>"; 
                /* On renvoie vers l'action ajouterProduit pour que ce soit rajouté dans la session et dans le panier. On indique l'id de l'élément en question */
                echo "<a href='traitement.php?action=ajouterProduit&ref=".$id."'>Ajouter au panier</a>";        

            // die;
        ?>
    </div>
</body>
</html>