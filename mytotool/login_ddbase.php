<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo</title>
    <link href="design.css" rel="stylesheet">
</head>

<body>



    <?php

    $dbConnection = null;
    /* fonction pour ce connecter a la base de donné - chemin vers mysql vers base de donné "connexiontodo" en utilsant les mdp de mysql*/
    function getConnection()
    {
        try {
            $dbConnection = new PDO('mysql:host=localhost;dbname=connexiontodo', 'root', 'root');
        } catch (PDOException $e) {
            /* message si erreur de connexion */
            echo 'Connexion échouée : ' . $e->getMessage();
        }
        return $dbConnection;
    }
    /* execute la fonction "$dbConnection" */
    $dbConnection = getConnection();


    /* Récupération des login et mdp pour connexion */
    $login = $_POST['login'];
    $password = $_POST['password'];
    /* fonction pour verifier que le user et le password sont bien dans la BDD */
    function select($dbConnection, $login, $password)
    {
        /* selectionne tout depuis "usertodo" où le nom utilisateur est égale à son nom et son mdp égale à son mot de passe */
        $requete_string = "SELECT * FROM usertodo WHERE user_name = '$login' AND password = '$password'";
        $requete = $dbConnection->prepare($requete_string);
        $requete->execute();
        $result = $requete->fetchAll();
        return $result;
    }

    $result = select($dbConnection, $login, $password);



    /* Si on ne trouve rien dans la BDD on envoie un message d'erreur */
    if (empty($result)) {
        echo "Identifiant ou mot de pass incorrect. Veuillez réessayer ou créer votre espace.";
    } else {
        // si non je renvoie vers la page "principale.php"
        header('location: principale.php');
    }



    ?>

    <div class="btn_redirection"><a href="connexion.html">test</a></div>

</body>