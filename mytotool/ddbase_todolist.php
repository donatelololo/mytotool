<?php

$dbConnection = null;

function getConnection(){


/* fonction pour ce connecter a la base de donné */
    try{
        $dbConnection = new PDO('mysql:host=localhost;dbname=connexiontodo', 'root', 'root');
        echo "Connexion à la base de données réussie";
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
    return $dbConnection;
}

$dbConnection=getConnection();

/* fonction pour ce connecter a la table todo */
function select($dbConnection){
    $requete_string = "SELECT * FROM todo";
    $requete = $dbConnection->prepare($requete_string);
    $requete->execute();
    $result = $requete->fetchAll();
}

select($dbConnection);


$titre=$_POST['title'];
$description=$_POST['description'];
$nom=$_POST['nom'];
/* fonction pour enregister les infos dans la BDD */
function insert($dbConnection, $titre, $description, $nom){


    $requete_string = "INSERT INTO todo(titre, description, nom) VALUES (:title, :description, :nom)";
    $requete = $dbConnection->prepare($requete_string);
    $requete->bindValue(':title', $titre, PDO::PARAM_STR);
    $requete->bindValue(':description', $description, PDO::PARAM_STR);
    $requete->bindValue(':nom', $nom, PDO::PARAM_STR);
    $requete->execute();


}

insert($dbConnection, $titre, $description, $nom);
// je renvoie vers la page "principale.php"
header ('location: principale.php');


?>