<?php

    require('db-functions.php');
    connexion();
    
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
        <a href="admin.php">Retour</a>
        <?php
            /* Nous récupérons la valeur envoyée dans le lien, qui correspond à l'id du produit */
            $ref = (isset($_GET['ref'])) ? $_GET['ref'] : "";
            findOneById($ref);
        ?>
        <!-- On renvoie vers la page traitement pour que les produits soient ajoutés -->
        <a href="traitement.php?action=ajouterProduit&ref=$ref&$name=$name&price=$price">Ajouter au panier</a>
    </div>
</body>
</html>