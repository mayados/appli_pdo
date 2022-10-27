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
    <h1>Ajouter un nouveau produit</h1>
    <?php
        /* Il faut avoir accès au tableau $_SESSION pour connaître le nombre de produits actuels */
        session_start();
        require('db-functions.php');
        connexion();
        findAll();
        require('functions.php');
        showMessage();
        
    ?>

                        <p>Nombre de produits actuels : 
                            <?php
                               
                                if(isset($_SESSION['products'])){
                                    /* Déclarer la variable ici et non en dehors de la condition, sinon cela fera undefined */
                                    $nombreProduits = $_SESSION['products']; 
                                    echo " ".count($nombreProduits)."";
                                } else{
                                    echo "0";
                                }
                            ?>
          
        

    </div>
</body>
</html>
