<?php 
require_once 'loginModel.php';
// User Create 
/**
 * សម្រាប់ Method  POST ❤️☕
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // …
  if( $_POST["mode"]=='login'){
      $log = new Login();
      $log->Login($_POST);
  }
  if( $_POST["mode"]=='logout'){
      $log = new Login();
      $log->Logout($_POST);
  }
}
/**
 * សម្រាប់ Method  GET ❤️☕
 */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        //យក ទិន្នន័យ

}

?>