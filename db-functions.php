<?php

/* Remarque générale : éviter d'ajouter les echos et foreach etc dans les fonctions, comme ça on peut réutiliser les fonctions où l'on a besoin. (Appeler les echo et foreach par exemple dans les pages que l'on affiche, en faisant référence à la fonction voulue) */

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
    /* Requête sql pour savoir ce que l'on sélectionne */
    $sqlQuery = 'SELECT * FROM product';
    /* nous ajoutons prepare afin de sécuriser les informations, ainsi, on execute uniquement ce qui a été préparé auparavant */
    $tousProduits = $pdo->prepare($sqlQuery);
    $tousProduits->execute();
    /* Tous les éléments sont stockés dans un tableau */
    $products = $tousProduits->fetchAll();
    /* return indique ce qui sera rretourné lorsque l'on appelle la fonction */
    return $products;

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
    /* Récupérer un seul élément : fetch()/ fetchAll() : pour plusieurs éléments, renvoie un tableau */
    $produit = $leProduit->fetch();
    return $produit;
}


//Fonction insertProduct($name,$descr,$price) : insère en bdd un nouvel enregistrement dans la table product

function insertProduct($name,$descr,$price){
    $pdo = connexion();
    /* On insère les paramètres de insertProducts en tant que valeurs dans la table product */
    $sql = "INSERT INTO 
    product(name,description,price)
    VALUES('$name','$descr',$price)";

    /* On peut récupérer le dernier id dans cette fonction, car comme on insert le dernier produit, il y a déjà une requete sql avec SELECT, et il n'y a plus qu'à éxecuter et récupérer le dernier ID du produit qu'on vient d'insérer (comme on y a accès) */
    /* On crée une variable pour stocker la préparation de la requete (pour ne pas écraser $pdo) */
    $insert= $pdo->prepare($sql);
    /* On exécute la requete qui a été préparée */
    $insert->execute();
    /* On retourne un integer */
    return $pdo->lastInsertId();
}


?>