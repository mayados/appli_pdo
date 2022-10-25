<?php

/* Connexion à la base de données */

function connexion(){
    try{
        $pdo = new PDO(
            'mysql:dbname=store;host=127.0.0.1',
            'root',
            '',
            [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ]
        );     
        

        /* Comme ça il n'y a pas de soucis de portabilité de la variable, il suffit d'appeler la fonction connexion */
        return $pdo;

    }catch(Exception $e){
        /* S'il y a une erreur (dans le login, mot de passe etc) on affiche un message (indiquant la nature de l'erreur) et on arrête tout */
        die('Erreur : '.$e->getMessage());
    }

}

connexion();

//Fonction findAll() : retourner tous les produits de la base de données

function findAll(){
    /* cette variable est égale au return de la fonction connexion() */
    $pdo = connexion();
    $sqlQuery = 'SELECT * FROM product';
    /* nous ajoutons prepare afin de sécuriser les informations */
    $tousProduits = $pdo->prepare($sqlQuery);
    $tousProduits->execute();
    /* Tous les éléments sont stockés dans un tableau */
    $products = $tousProduits->fetchAll();

    /* Pour chaque produit, on affiche ses informations */
    foreach ($products as $product) {
    echo "<br><br><a href='product.php?ref=".$product['id']."'>".$product['name']."</a><br><br> "
    .substr($product['description'],0,45)."...<br> 
    <strong>".$product['price']." euros</strong><br>
    <a href='#'>Ajouter au panier</a>"; 
    }
}

// findAll();

//Fonction findOneById($id) : renvoie le produit répondant à l'id en paramètre

function findOneById($id){
    /* Nous nous connectons à la base de données */
    $pdo = connexion();
    /* Faire attention à la syntaxe (des quotes) sinon la variable n'est pas récupérée */
    $sqlQuery = 'SELECT name,description,price FROM product WHERE id='.$id.'';
    $leProduit = $pdo->prepare($sqlQuery);
    $leProduit->execute();
    $produit = $leProduit->fetchAll();
    foreach ($produit as $prod) {
        echo "<br>".$prod['name']."<br>"
        .$prod['description']."<br>"
        .$prod['price']."<br>"; 
    }
}

// findOneById(10);

//Fonction insertProduct($name,$descr,$price) : insère en bdd un nouvel enregistrement dans la table product

function insertProduct($name,$descr,$price){
    $pdo = connexion();
    $sql = "INSERT INTO 
    product(name,description,price)
    VALUES('$name','$descr','$price')";

    $pdo->prepare($sql);
    $pdo->exec($sql);
    echo "entree ajoutee";
}

//  insertProduct('ballon','super objet pour les fêtes',4);

?>