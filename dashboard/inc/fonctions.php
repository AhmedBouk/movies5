<?php
function br(){
  echo '<br>';
}
function debug($array){
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
function validationTexte($error, $data, $min, $max, $key, $empty = true){
  if (!empty($data)){
      if(strlen($data) < $min ) {
        $error[$key] = 'trop court.';
      } elseif(strlen($key) > $max) {
        $error[$key] = 'trop long.';
      }
  } else {
    if ($empty) {
      $error[$key] = 'Veuillez renseignez ce champ';
    }
  }
return $error;
}
function value($key){
	 if(!empty($_POST[$key])) {
     echo $_POST[$key]; }
}

function spanError($error, $key){
    if(!empty($error[$key])) {
       echo $error[$key]; }
}

function clean($key){
  return trim(strip_tags($_POST[$key]));
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function is_logged(){
  if (
    !empty($_SESSION['user']['id'])
  && !empty($_SESSION['user']['pseudo'])
  && !empty($_SESSION['user']['email'])
  && !empty($_SESSION['user']['role'])
  && $_SESSION['user']['ip'] = $_SERVER['REMOTE_ADDR']){
    return true;
  }else {
  return false;
  }
}
function is_admin(){
  if (is_logged() == true && $_SESSION['user']['role'] === 'admin'){
    return true;
  }
}
