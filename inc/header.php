<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Bienvenue sur votre base de donnée de films" /> <!-- Texte qui aparaitra dans les moteur de recherche -->
    <meta name="keywords" content="base de donnée, database, cinema, movie, film" /> <!-- reférencement -->
    <meta name="author" content="Ahmed, Camille, Emilie, Jonathan" /> <!-- Les auteurs du site -->
    <meta name="robots" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- meta permetant d'utiliser les media query pour le responsive -->
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" href="asset/css/style.css"> <!-- Les liens vers le css et les polices en ligne -->
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet">
    <!-- Le commentaire suivant fait en sorte que Internet expolorer 9 fonctionne avec html 5 -->
  <!--[if lt IE 9]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  </head>
  <body>
    <h1> base de donnée, database, cinema, movie, film </h1> <!-- Reférencement -->
    <header>

      <!-- Le logo  -->
      <a href="index.php"> <img src="asset/img/logo.png" alt="logo"> </a>

      <!-- Le titre du site -->
      <div class="titre">
        <h2>Le carnet du cinéaste</h2>
      </div>

      <!-- Inscription / connexion / deconnexion -->
      <div class="compte">
        <?php
          if (is_logged()==false) {
            echo '<p> <a href="inscription.php"> Inscription </a> </li>
            <p> <a href="connexion.php"> Connexion </a> </p>';
             br();
          }else{
            echo '<p>Bienvenue : '. $_SESSION['user']['pseudo'] .' </p> <br/>
            <p> <a href="deconnexion.php"> Deconnexion </a> </p>';
          }
?>
      </div>
      <div class="clear"></div>
    </header>
<div class="clear"></div>
    <div id="container">
