<?php

/* Connexion à la base de données */

function connexion(){
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
}


?>