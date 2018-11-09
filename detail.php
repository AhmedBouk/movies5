<?php
include('inc/pdo.php');
include('inc/fonctions.php');

// titre de la page//
$title = 'Detail';
$droitVote = true;
$error = array();

// si $_get['slug'] est pas vide
if(!empty($_GET['slug']))
{

  // requete du titre du film  avec son slug (titre et date film)
  $slug = $_GET['slug'];
  $sql= "SELECT * FROM movies_full WHERE slug=:slug";
  // preparation de la requête
  $query = $pdo -> prepare($sql);
  // Protection injections SQL
  $query->bindValue(':slug',$slug, PDO::PARAM_STR);
  // execution de la requête preparé
  $query -> execute();
  $movie = $query -> fetch();
  // si $movie est pas vide
  if(!empty($movie)) {
    // si on est connecté
    if(is_logged()) {
      // requete pour selectionner les informations du film
      $idSession = $_SESSION['user']['id'];
      $sql = "SELECT * FROM m5_filmsavoir
              WHERE id_users = :iduser
              AND id_movies = :idmovie";
      // preparation bdd
      $query = $pdo->prepare($sql);

      // Protection injections SQL
      $query->bindValue(':iduser',$idSession);
      $query->bindValue(':idmovie',$movie['id']);

      // execution de la requête preparé
      $query->execute();
      $note = $query->fetch();
      if(!empty($note)) { $droitVote = false;}

      // si formulaire $_post est soumis
      if(!empty($_POST['submitted'])) {

        // Protection XSS
        //idmovierecup égal a $_post['movie']
        $idmovierecup = trim(strip_tags($_POST['movie']));
        // et si idmovie egal à $movieid
        if($idmovierecup == $movie['id']) {
           // requete ajout de film dans base de donnée m5_filmsavoir
           $sql = "INSERT INTO m5_filmsavoir( id_users, id_movies,note,	created_at)
                   VALUES ( :idusers, :idmovies,null, NOW())";

            // Preparation bdd
            $query = $pdo->prepare($sql);
            // Protection injections SQL
            $query->bindValue(':idusers',$idSession);
            $query->bindValue(':idmovies',$idmovierecup);
            $query->execute();
            // $droitVote = false;

            // redirection vers la page des films àà voir +++!!!
            header("Location: filmfavoris.php");
        }
      }
    }
  } else {
    die('404');
  }
} else {
  die('404');
}

if(!empty($_POST['submitrate'])) {

  $rate = clean('note');

  if(!empty($rate)) {
    if(is_numeric($rate) < 0) {
      // $error['note'] = 'la note doit être supérieure à 0';
      die('404');
    } elseif(is_numeric($rate) > 100) {
      // $error['note'] = 'la note doit être inferieure à 100';
      die('404');
    } else {
      $sql= "SELECT * FROM movies_full WHERE slug=:slug";
      // preparation de la requête
      $query = $pdo -> prepare($sql);
      $query->bindValue(':slug',$slug, PDO::PARAM_STR);
      // execution de la requête preparé
      $query -> execute();
      $movie = $query -> fetch();

      $sql = "UPDATE `m5_filmsavoir` SET `note`= :note,`update_at`= now()  WHERE id_users = :iduser AND id_movies = :idmovie";

       $query = $pdo->prepare($sql);
       $query->bindValue(':note',$rate);
       $query->bindValue(':iduser',$idSession);
       $query->bindValue(':idmovie',$movie['id']);
       $query->execute();

    }
  }
}

include('inc/header.php');
?>
  <!-- les détails du films avec comme classe descritpion  -->

<ul class="description">
      <li>  <?php echo '<img src="posters/'.$movie['id'].'.jpg" alt="">'?></li>
      <li>  Titre : <?php echo $movie['title'] ;?> </li>
      <li>  Date de sortie : <?php echo $movie['year'] ;?></li>
      <li>  Genre : <?php echo $movie['genres'] ;?> </li>
      <li>  De : <?php echo $movie['directors'] ;?> </li>
      <li>  Avec : <?php echo $movie['cast'] ;?></li>
      <li>  Durée : <?php echo $movie['runtime'] ;?> min</li>
      <li>  Classification des films : <?php echo $movie['mpaa'] ;?> <p></li>
      <li>  Note : <?php echo $movie['rating'] ;?> notes </li>
      <li>  Popularité : <?php echo $movie['popularity'] ;?></li>
      <li> <h2>SYNOPSIS ET DÉTAILS </h2><br> <?php echo $movie['plot'] ;?></li>
</ul>

<!-- bouton ajout de film dans la base de donné m5_filmsavoir -->


<?php if(is_logged() && $droitVote){ ?>
  <form action="" method="post">
      <input type="hidden" name="movie" value="<?php echo $movie['id']; ?>">
      <input type="submit" name="submitted" value="film à voir">
  </form>
<?php } ?>


<?php if(is_logged()) {
$idSession = $_SESSION['user']['id'];
$slug = $_GET['slug'];
  ?>
<form method="post" action="">
<input type="hidden" name="note" value="">
<select name="note">
<?php for ($rater=0; $rater <=100 ; $rater++) {
  echo '<option value="'. $rater .'">'. $rater .'</option>';
} ?>
</select>
<input type="submit" name="submitrate" value="Note">
</form>
<?php } ?>
<?php include('inc/footer.php');
