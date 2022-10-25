<?php
    require('db-functions.php');
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
            findOneById(15);
        ?>
        <a href="#">Ajouter au panier</a>
    </div>
</body>
</html>