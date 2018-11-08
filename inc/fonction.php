<?php
// Fonction qui fait revenir à la ligne Utilisation : br();
function br(){
  echo '<br />';
}

// Fonction qui test les arrays, U: debug($nomduarray);
function debug($array){
echo '<pre>';
print_r($array);
echo '</pre>';
}

//ferme la page immediatement et retourne a l'adresse indiqué'fonction native'
header('location: index.php');

//FORMULAIRE /

// Enlève les espace au début et à la fin et les caractères qui pourraitcréer des scripts (obligatoire, faute proffesionnelle).
function verifsecu($value){
  return trim(strip_tags($_POST[$value]));
}

//valide un texte, comme un pseudo, nom ou message (necessite le array suivant : $error =array();)
function validationText($error,$value,$min,$max,$key) {
  if(!empty($value)) {
    if(strlen($value) < $min ) {
      $error[$key] = 'Ce champs est trop court.(minimum '. $min .' caractères)';
    } elseif(strlen($value) > $max) {
      $error[$key] = 'Ce champs est trop long.(maximum '. $max .'  caractères)';
    }
  } return true;
}

//valide un mail (necessite le array suivant : $error =array();)
function validationEmail($error,$email,$key){
  if(!empty($email)) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $error[$key] = 'Ceci n\'est pas une adresse mail.';
    }
  } return true;
}

//valide si deux champs mod de passe sont identiques.
function validation2Password($error,$password1,$password2,$key){
  if(!empty($password1) && !empty($password2)) {
    if($password1 != $password2) {
      $error[$key] = 'Les mots de passe sont différents';
    }
   }else  {
       $error[$key] = 'Veuillez renseigner ce champs';
     } return true;
  }
//Remets la valeur dans le champs si le formulaire ne peut être soumis
// A mettre dans <input value:'ICI'>
//$value = name=''
function retourValue($key){
if(!empty($_POST[$key])) {
  echo $_POST[$key];
}
}

//Ecris l'erreur lié à un champs
// A mettre dans dans une span a coté de <input>
//$error ne change pas $value = name=''
function retourValueError($error,$key){
if(!empty($error[$key])) {
   echo $error[$key];
}
}

//Génère des strings aléatoire pour protègé les mots de passe
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Vérifie si ll'utilisateur est loggué
function isLogged($mainkey,$key1,$key2,$key3,$key4,$key5){
    if (!empty($_SESSION[$mainkey][$key1])) {
      if (!empty($_SESSION[$mainkey][$key2])) {
        if (!empty($_SESSION[$mainkey][$key3])) {
          if (!empty($_SESSION[$mainkey][$key4])) {
            if (!empty($_SESSION[$mainkey][$key5])) {
              if ($_SESSION[$mainkey][$key5] == $_SERVER["REMOTE_ADDR"]) {
                return true;

}}}}}}
return false;
}
// Vérifie si ll'utilisateur est loggué et si c'est un admin
function isAdmin(){
    if (islogged($mainkey,$key,$keyvalue)){
      if (!empty($_SESSION[$mainkey][$key])) {
        if ($_SESSION[$mainkey][$key] == $keyvalue){
          return true;
        }
        return false;
      }
      return false;
    }
    return false;
}
