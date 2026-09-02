<?php
// var_dump($_SERVER); 
// die;
$_SESSION['ext_redirect'] = $_SERVER['HTTP_REFERER'];
if (!isset($_GET['ext_link'])) {
// die;
header("Location:". $_SERVER['HTTP_REFERER']);
exit();
}else{
 $admin = selectContent($conn,"admin",["hash_id"=>base64url_decode($_GET['admin'])]);

if (count($admin) <1) {
  // die;
  header("Location:". $_SERVER['HTTP_REFERER']);
  exit();
}

$_SESSION['admin_id'] = base64url_decode($_GET['admin']);


  header("Location:".$_GET['ext_link']);
  exit();
}

 ?>
