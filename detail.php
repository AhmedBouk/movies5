<?php include('inc/fonction.php'); ?>
<?php include('inc/data.php');


//debug($movies);
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
  $id =  $_GET['id'];
  foreach ($movies as $movie) {
      if($id == $movie['id']) {
        $film = $movie;
      }
  }
} else {
  die('404');
}

//print_r($film);

?>

<?php $title = 'detail'; ?>
<?php include('inc/header.php'); ?>

  <div class="film">
      <h1><?php echo $film['title']; ?></h1>
      <?php imageMovie($film); ?>
      <p class="year">Year: <?php echo $film['year']; ?></p>
      <p class="directors">Directors: <?php echo $film['directors']; ?></p>
      <p class="rating">Rating: <?php echo $film['rating']; ?></p>
      <p class="imdb_id">imdb_id: <?php echo $film['imdb_id']; ?></p>
  </div>

<?php include('inc/footer.php'); ?>
