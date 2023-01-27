<?php
   session_start();
   include('connection.php');
   include('getIPaddress.php');
   include('getLocation.php');
   class Login {
       private $name;
       private $password;

    public function Login($data){
        $name =  $data['email'];
        $password =  $data['password'];
 
        $db = new Database();
        // 
        if(empty($name)){
             $errorr =  array('error' =>'This username or email is not exist ' );
            exit(json_encode($errorr));
        }
        // 
        if(empty($password)){
            $errorr =  array('error' =>'This password is not exist ' );
            exit(json_encode($errorr));
        } 
        $sql="SELECT * FROM users WHERE  email='$name' AND password='$password' AND status=1";
        $result = $db->mysqli->query($sql);
        $row = $result->fetch_assoc();
        if($row==null){
            $errorr =  array('error' =>'This username or password is not exist ' );
            exit(json_encode($errorr));
        }
        // SET AUTH SESSION
        $_SESSION['users'] =$row['name'];
        $_SESSION['role'] =$row['role'];
        $_SESSION['userid'] =$row['id'];
        // SET AUTH SESSION
        echo json_encode($row);
    }
    public function Logout(){
        // Finally, destroy the session.
        session_destroy();
         $message =  array('message' =>'logout successfull ' );
        echo json_encode($message);
    }
    
 }

?>