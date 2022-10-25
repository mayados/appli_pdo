
<?php

    /* Il faut avoir accès au tableau $_SESSION pour connaître le nombre de produits actuels */
    session_start();
    require('db-functions.php');
    connexion();
    findAll();
    require('functions.php');
    showMessage();
?>
