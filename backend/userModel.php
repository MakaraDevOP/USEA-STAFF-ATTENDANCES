<?php
   include('connection.php');
   class User  {
       private $name;
       private $role;
       private $code;
       private $email;
       private $phone;
       private $status;
       private $password;
    public function List(){
        $db = new Database();
        $sql="SELECT * FROM  users ORDER BY code ASC";
        $result = $db->mysqli->query($sql);
        $obj =[];
        while( $row = $result->fetch_assoc()){
           array_push($obj,$row);
        }
        echo json_encode($obj);
    }
    public function Insert($data){
        $name =  $data['name'];
        $code =  $data['code'];
        $role =  $data['role'];
        $email =  $data['email'];
        $phone =  $data['phone'];
        $status =  $data['status'];
        $password =  $data['password'];
        $db = new Database();
        $getCode = "SELECT * FROM users WHERE code='$code'";
        $getEmail = "SELECT * FROM users WHERE email='$email'";
        $selectCode =  $db->mysqli->query($getCode); 
        $selectEmail =  $db->mysqli->query($getEmail); 
        // ការកំណត់ មិនស្ទួន  Code 
        if($selectCode->num_rows > 0){
             $errorr =  array('error' =>'This code is already being used' );
            exit(json_encode($errorr));
        }
        // ការកំណត់ មិនស្ទួន Email
        if($selectEmail->num_rows > 0){
             $errorr =  array('error' =>'This email is already being used' );
            exit(json_encode($errorr));
        } 
        $sql="INSERT INTO users (name,code ,role,email,phone,password,status) VALUES ('$name','$code','$role','$email','$phone','$password','$status')";
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }
    public function Edit($data){
        $db = new Database();
        $id = $data['id'];
        $sql="SELECT * FROM  users WHERE id=$id";
        $result = $db->mysqli->query($sql);
        $row = $result->fetch_assoc();
        echo json_encode($row);
    }
    public function Update($data){
        $id= $data['id'];
        $name =  $data['name'];
        $code =  $data['code'];
        $role =  $data['role'];
        $email =  $data['email'];
        $phone =  $data['phone'];
        $status =  $data['status'];
        $password =  $data['password'];
        
        $db = new Database();
        // $getCode = "SELECT * FROM users WHERE code='$code'";
        // $getEmail = "SELECT * FROM users WHERE email='$email'";
        // $selectCode =  $db->mysqli->query($getCode); 
        // $selectEmail =  $db->mysqli->query($getEmail); 
        // // ការកំណត់ មិនស្ទួន  Code 
        // if($selectCode->num_rows > 0 && ){
        //      $errorr =  array('error' =>'This code is already being used' );
        //     exit(json_encode($errorr));
        // }
        // // ការកំណត់ មិនស្ទួន Email
        // if($selectEmail->num_rows > 0){
        //      $errorr =  array('error' =>'This email is already being used' );
        //     exit(json_encode($errorr));
        // } 
        $sql="UPDATE users  SET name='$name',code='$code',role='$role',email='$email',phone='$phone',password='$password',status ='$status' WHERE id=$id";
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }
    public function Search($data){
        $db = new Database();
        $search = $data['search'];
        $sql="SELECT * FROM  users WHERE id LIKE '%$search%' OR name LIKE '%$search%' OR code LIKE '%$search%'";
        $result = $db->mysqli->query($sql);
        $obj =[];
        while( $row = $result->fetch_assoc()){
           array_push($obj,$row);
        }
        echo json_encode($obj);
    }
    public function Destroy($data){
        $id= $data['id'];        
        $db = new Database();
        $getUser = "SELECT * FROM users WHERE id=$id";
        $selectUser =  $db->mysqli->query($getUser); 
        // Existing
        if($selectUser->num_rows < 0){
             $errorr =  array('error' =>'This staff is not exist' );
            exit(json_encode($errorr));
        }
        $sql="DELETE FROM  users WHERE id=$id";
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }


 }

?>