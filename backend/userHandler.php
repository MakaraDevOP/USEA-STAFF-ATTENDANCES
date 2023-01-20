<?php 
require_once 'userModel.php';
// User Create 
/**
 * សម្រាប់ Method  POST ❤️☕
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // …
  if( $_POST["mode"]=='create'){
      $user = new User();
      $user->Insert($_POST);
  }
  if($_POST['mode']=='update'){
        $user = new User();
       $user->Update($_POST);
  }
   if($_POST['mode']=='delete'){
        $user = new User();
       $user->Destroy($_POST);
  }
}
/**
 * សម្រាប់ Method  GET ❤️☕
 */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        //យក ទិន្នន័យ
    if($_GET["mode"] =='list'){
        $user = new User();
        $user->List($_GET);
    }
    // User Edit 
    if($_GET["mode"]=='edit'){
        $user = new User();
        $user->Edit($_GET);
    }
    //ស្វែងរក ទិន្នន័យ 
    if($_GET["mode"] =='search'){
        $user = new User();
        $user->Search($_GET);
    }
}

?>