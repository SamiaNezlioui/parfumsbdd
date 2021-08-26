<?php
//connexion a la base de donnée
//  1 creation des parametres permettant d'etablir la connexion PDO
try{
    $db = new PDO('mysql:host=localhost; dbname=boutique_en_ligne; charset=utf8', 'root', '');

}
catch (PDOException $e){
     echo 'erreur : '.$e->getMessage();
     die();
 }

