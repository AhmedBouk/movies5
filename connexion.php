<?php
include('inc/fonctions.php');
include('inc/pdo.php');

$error=array();

if(!empty($_POST['submitted'])){

$login  = clean('login');
$password  = clean('password');

$sql="SELECT * FROM m5_users WHERE pseudo =:login "; //requete à modifier
$query= $pdo -> prepare($sql) ;//preparer la requete
$query-> bindvalue(':login' , $login , PDO::PARAM_STR );
$query-> execute(); //execute la requete
$user = $query -> fetch(); // $a variable retourner / fetchall() pour les requetes avec multiple array sinon fetch()

if(!empty($user)) {
  if (!password_verify ($password , $user['password'] )) {
    $error['password'] = 'Mauvais mot de passe';
  }
  }else{
    $error['password'] = 'Veuillez vous inscrire';
}

if (count($error) == 0) {
  $_SESSION['user'] = array(
    'id'      =>$user['id'],
    'pseudo'  =>$user['pseudo'],
    'email'   =>$user['email'],
    'role'    =>$user['role'],
    'ip'      =>$_SERVER["REMOTE_ADDR"]

  );
  header('location: index.php');
}

}


$title = 'Connexion';
include('inc/header.php');

?>
<!-- Il y a une div class container autour du body  -->

<form  action="" method="post">


  <input type="text" name="login" placeholder="Pseudo" value="">
  <span><?php spanError($error,'login') ?></span>

  <input type="password" name="password" placeholder="Mot de passe" value="">
  <span><?php spanError($error,'password') ?></span>

  <input type="submit" name="submitted" value="Connexion">
</form>

<a href="mdpOublie.php">Mot de passe oublié ?</a>





<?php include('inc/footer.php'); ?>
