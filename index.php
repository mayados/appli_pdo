<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="5"> -->
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <title>index php</title>
</head>
<body>
    <div id="container-page">
    <?php
        /* Il faut avoir accès au tableau $_SESSION pour connaître le nombre de produits actuels */
        session_start();
        require('db-functions.php');
        connexion();
        /* On utilise findAll() pour trouver chaque produit */
        $products = findAll();
        require('functions.php');
        showMessage();
        
        /* Pour chaque produit, on affiche ses informations */
        foreach ($products as $product) {
        echo "<br><br><a href='product.php?ref=".$product['id']."'>".$product['name']."</a><br><br> "
        .substr($product['description'],0,45)."...<br> 
        <strong>".$product['price']." euros</strong><br>
        <a href='traitement.php?action=ajouterProduit&ref=".$product['id']."'>Ajouter au panier</a>"; 
        }
    ?>

                        <p>Nombre de produits actuels : 
                            <?php
                               
                                if(isset($_SESSION['products'])){
                                    /* Déclarer la variable ici et non en dehors de la condition, sinon cela fera undefined */
                                    $nombreProduits = $_SESSION['products']; 
                                    echo " ".count($nombreProduits)."<br>";
                                } else{
                                    echo "0 <br>";
                                }
                            ?>

        <a id="recap" href="recap.php">Récapitulatif</a> 
          
        

    </div>
</body>
</html>
