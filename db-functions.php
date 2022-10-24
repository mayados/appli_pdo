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
    echo $product['name']." ".$product['description']." ".$product['price']." euros<br>"; 
    }
}

findAll();

//Fonction findOneById($id) : renvoie le produit répondant à l'id en paramètre



//Fonction insertProduct($name,$descr,$price) : insère en bdd un nouvel enregistrement dans la table product

function insertProduct(){
    $pdo = connexion();
    $sql = "INSERT INTO 
    product(name,description,price)
    VALUES('mangue','fruit avec beaucoup d eau',5)";

    $pdo->prepare($sql);
    $pdo->exec($sql);
    echo "entree ajoutee";
}

// insertProduct();

?>