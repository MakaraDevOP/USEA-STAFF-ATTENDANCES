<?php 
require_once 'departmentModel.php';
// User Create 
/**
 * សម្រាប់ Method  POST ❤️☕
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // …
  if( $_POST["mode"]=='create'){
      $depart = new Department();
      $depart->Insert($_POST);
  }
  if($_POST['mode']=='update'){
        $depart = new Department();
       $depart->Update($_POST);
  }
   if($_POST['mode']=='delete'){
        $depart = new Department();
       $depart->Destroy($_POST);
  }
}
/**
 * សម្រាប់ Method  GET ❤️☕
 */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        //យក ទិន្នន័យ
    if($_GET["mode"] =='list'){
        $depart = new Department();
        $depart->List($_GET);
    }
    // User Edit 
    if($_GET["mode"]=='edit'){
        $depart = new Department();
        $depart->Edit($_GET);
    }
    //ស្វែងរក ទិន្នន័យ 
    if($_GET["mode"] =='search'){
        $depart = new Department();
        $depart->Search($_GET);
    }
}

?>