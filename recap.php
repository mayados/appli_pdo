<!-- Pour cette page, nous avons besoin de parcourir le tableau session. Il faut donc d'abord récupérer la session de l'utilisateur  -->
<?php
    session_start();
    require('functions.php');
    showMessage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="3"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/recapitulatif.css">
    <title>Récapitulatif des produits</title>
</head>
<body>
    <div id="container-page">
        <h1> Votre récapitulatif de commande </h1>            
        <div id="tableau">
            <?php 
                    /* Si la clé "products" du tableau session n'existe pas OU si elle existe mais ne contient auncune donnée, on affiche un message */
                    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                        echo "<p> Auncun produit en session...</p>";
                    }
                    /* Au cas où la clé existe et contient quelque chose, on affiche nos produits dans un tableau HTML */
                    else{
                        echo "<table id='tableau-recap'>",
                            "<thead>",
                                "<tr>",
                                    "<th>#</th>",
                                    "<th>Nom</th>",
                                    "<th>Prix</th>",
                                    "<th>Quantité</th>",
                                    "<th>Total</th>",
                                    "<th></th>",
                                "</tr>",
                            "</thead>",
                            "<tbody>";
                        $totalGeneral = 0;
                        $nombreProduits = count($_SESSION['products']); 
                        /* Pour chaque element product du tableau products : products correspond à l'index*/
                        foreach($_SESSION['products'] as $index => $product){
                            $ref = $index;
                            $quantiteProduit = $product['qtt'];
                            $produit = $product['name'];
                            echo "<tr>",
                                    "<td>".$index."</td>",
                                    "<td>".$product['name']."</td>",
                                    /* On modifie l'affichage du prix avec number_format */
                                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                    "<td id='quantite-produit'>
                                    <a href='traitement.php?action=baisserQuantite&ref=$index'>-</a>".$quantiteProduit."<a href='traitement.php?action=augmenterQuantite&ref=$index'>+</a> </td>",
                                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                    /* La référence du lien guide vers la page retrait_produit.php. On indique que le retrait correspond à l'index auquel nous sommes (du tableau products) */
                                    "<td><a href='traitement.php?action=suppprimerProduit&ref=$index&produit=$produit'>Supprimer</a></td>",
                                "</tr>";

                            $totalGeneral += $product['total'];
                        }
                        echo    "<tr id='general'>",
                                    /* Cellule fusionnée de 4 cellules = l'affichage des mots "total général" prend 4 celulles sur 5 */
                                    "<td colspan=4 id='total-g'>Total général : </td>",
                                    /* &nbsp; est un espace insécable */
                                    "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                                "</tr>",
                                "<tr>",
                                    "<td id='nb-produits'colspan=4> Nombre de produits : </td>",
                                    "<td>".$nombreProduits."</td>",
                                "</tr>",
                                "<tr>",
                                    "<td id='supp-produits'><a href='traitement.php?action=viderPanier'>Supprimer tous les produits</a></td>",
                                "</tr>",
                            "</tbody>",
                            "</table>";
                    }
                ?>
        </div>

            <a id="retour-index" href="index.php">
                <i class="fa-solid fa-rotate-left"></i>
                <p>Retour à l'index</p>
            </a>          

    </div>

</body>
</html>
