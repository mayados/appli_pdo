<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css"> 
    <title>Accueil admin</title>
</head>
<body>
<div id="container-page">
    <?php

    /* Il faut avoir accès au tableau $_SESSION pour connaître le nombre de produits actuels */
    session_start();
    require('functions.php');
    showMessage();
    ?>
    <h1>Ajouter un nouveau jeu dans la base de données</h1>
        <section id="formulaire">
            <form action="traitement.php?action=ajouterProduitBdd" method="post">
                <p>
                    <label>
                        <p class="label-p">Nom du jeu :</p>
                        <!-- required pour indiquer que c'est un champ qui doit obligatoirement être rempli -->
                        <input required type="text" name="name">
                    </label>
                </p>
                <p>
                    <label>
                        <p class="label-p">Prix du jeu :</p>
                        <input required type="number" step="any" name="price" min=0>
                    </label>
                </p>
                <p>
                    <label>
                        <p class="label-p">Description :</p>
                        <textarea name="descr" required></textarea>
                    </label>
                </p>
                <p>
                    <input id="ajouter" type="submit" name="submit" value="Ajouter le produit">
                </p>
                <p>
                    <label>
                        <p>Nombre de produits actuels : 
                            <?php
                               /* S'il y a des produits dans la session, on compte le nombre d'index de la session (car 1 index = 1 produits) */
                               /* S'il n'y a pas de produits en session, on affiche 0 */
                                if(isset($_SESSION['products'])){
                                    /* Déclarer la variable ici et non en dehors de la condition, sinon cela fera undefined */
                                    $nombreProduits = $_SESSION['products']; 
                                    echo " ".count($nombreProduits)."";
                                } else{
                                    echo "0";
                                }
                            ?>
                        </p>
                    </label>
                </p>
            </form>
        </section>

        <a id="recap" href="recap.php">Récapitulatif</a>            
        

    </div>
</body>
</html>

