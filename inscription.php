<?php
include('inc/fonctions.php');
include('inc/pdo.php');

$error =array();
$success  = false;

if (!empty($_POST['submitted'])) {

  $pseudo   = clean('pseudo');
  $email    = clean('email');
  $pwd      = clean('pwd');
  $pwd2     = clean('pwd2');

  if(!empty($pseudo)) {
    if(strlen($pseudo) < 3 ) {
      $error['pseudo'] = 'Ce champs est trop court.(minimum 3 caractères)';
    } elseif(strlen($pseudo) > 20) {
      $error['pseudo'] = 'Ce champs est trop long.(maximum 20 caractères)';
    } else {
      $sql="SELECT pseudo FROM m5_users WHERE pseudo = :pseudo"; //requete à modifier
      $query= $pdo -> prepare($sql) ;//preparer la requete
      $query-> bindValue(':pseudo' , $pseudo , PDO::PARAM_STR );
      $query-> execute(); //execute la requete
      $testpseudo = $query -> fetch();

      if (!empty($testpseudo)) {
            $error['pseudo'] =  'Ce pseudo est déjà pris';
      }
    }
  } else {
      $error['pseudo'] = 'Veuillez renseigner ce champs';
  }


  if(!empty($email)) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $error['email'] = 'Ceci n\'est pas une adresse mail.';
    } else {
      $sql="SELECT email FROM m5_users WHERE email = :email"; //requete à modifier
      $query= $pdo -> prepare($sql) ;//preparer la requete
      $query-> bindValue(':email' , $email , PDO::PARAM_STR );
      $query-> execute(); //execute la requete
      $testemail = $query -> fetch();

      if (!empty($testemail)) {
          $error['email'] =  'Cet email est déjà pris';
      }
    }
  } else {
    $error['email'] = 'Veuillez renseigner ce champs';
  }

  if(!empty($pwd) && !empty($pwd2)) {
    if($pwd != $pwd2) {
      $error['pwd'] = 'Les mots de passe sont différents';
    }

   }else  {
       $error['pwd'] = 'Veuillez renseigner ce champs';

  }


  if (count($error)==0) {
    $success  = true;
    $hash     = password_hash($pwd , PASSWORD_DEFAULT);
    $token    = generateRandomString(120);

    $sql = "INSERT INTO `m5_users`(`pseudo`, `email`, `token`, `password`, `role`, `created_at`) VALUES (:pseudo , :mail , :token, :pwd ,'user' , now()) ";
    $query= $pdo -> prepare($sql) ;
    $query-> bindvalue(':pseudo' , $pseudo , PDO::PARAM_STR );
    $query-> bindvalue(':mail' , $email , PDO::PARAM_STR );
    $query-> bindvalue(':pwd' , $hash , PDO::PARAM_STR );
    $query-> bindvalue(':token' , $token , PDO::PARAM_STR );
    $query-> execute(); //execute la requete
    header('location: index.php');
  }


}


include('inc/header.php');
$title = 'inscription';
?>

<h2>INSCRIPTION :</h2>

<form action="" method="post">
  <label for="pseudo">Pseudo :</label>
  <input type="text" name="pseudo" value="<?php value('pseudo') ?>">
  <span><?php spanError($error,'pseudo') ?></span>

  <label for="email">Email :</label>
  <input type="text" name="email" value="<?php value('email') ?>">
  <span><?php spanError($error,'email') ?></span>

  <label for="pwd">Mot de passe :</label>
  <input type="password" name="pwd" value="<?php value('pwd') ?>">
  <span><?php spanError($error,'pwd') ?></span>

  <label for="pwd2">Confirmation du mot de passe :</label>
  <input type="password" name="pwd2" value="">

  <input type="submit" name="submitted" value="Envoyer">

</form>





<?php include('inc/footer.php'); ?>