<?php
$host="127.0.0.1:3306";
$db="photo4you";
$user="root";
$pw="";
// connection à la base de données avec test si il y a une erreur
try
{
    $db = new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$pw);
    // Si il y a une erreur lors de la création de l'objet PDO
    // Les lignes suivantes ne sont pas executées 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    // Cette instruction n'est executée que si le bloc try génère une exception de type Exception. 
    die('Erreur : ' . $e->getMessage());
}
?>