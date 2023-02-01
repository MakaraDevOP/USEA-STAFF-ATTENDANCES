<?php
   include('connection.php');
   include('getIPaddress.php');
   include('getLocation.php');
   class Department  {
       private $name;
       private $description;
       private $code_name;

    public function List(){
        $db = new Database();
        $sql="SELECT * FROM  departments ORDER BY code_name ASC";
        $result = $db->mysqli->query($sql);
        $obj =[];
        while( $row = $result->fetch_assoc()){
           array_push($obj,$row);
        }
        if(empty($obj)){
             $errorr =  array('data' =>'No record!' );
             exit(json_encode( $errorr));
        }
        echo json_encode($obj);
    }
    public function Insert($data){
        $name =  $data['name'];
        $code =  $data['code_name'];
        $description =  $data['description'];

        $db = new Database();
        $getName = "SELECT * FROM departments WHERE name='$name'";
        $getCode= "SELECT * FROM departments WHERE code_name='$code'";
        $selectCode =  $db->mysqli->query($getCode); 
        $selectName =  $db->mysqli->query($getName); 
        // ការកំណត់ មិនស្ទួន  Code 
        if($selectCode->num_rows > 0){
             $errorr =  array('error' =>'This code is already being used' );
            exit(json_encode($errorr));
        }
        // ការកំណត់ មិនស្ទួន Email
        if($selectName->num_rows > 0){
             $errorr =  array('error' =>'This name is already being used' );
            exit(json_encode($errorr));
        } 
        $sql="INSERT INTO departments (name,code_name, description) VALUES ('$name','$code','$description')";
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }
    public function Edit($data){
        $db = new Database();
        $id = $data['id'];
        $sql="SELECT * FROM  departments WHERE id=$id";
        $result = $db->mysqli->query($sql);
        $row = $result->fetch_assoc();
        echo json_encode($row);
    }
    public function Update($data){
        $id= $data['id'];
        $name =  $data['name'];
        $code =  $data['code_name'];
        $description =  $data['description'];
        
        $db = new Database();
        $sql="UPDATE departments  SET name='$name',code_name='$code',description='$description' WHERE id=$id";
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }
    public function Search($data){
        $db = new Database();
        $search = $data['search'];
        $sql="SELECT * FROM  departments WHERE  name LIKE '%$search%' OR code_name LIKE '%$search%'";
        $result = $db->mysqli->query($sql);
        $obj =[];
        while( $row = $result->fetch_assoc()){
           array_push($obj,$row);
        }
        if(empty($obj)){
             $errorr =  array('data' =>'No record!' );
             exit(json_encode( $errorr));
        }
        echo json_encode($obj);
    }
    public function Destroy($data){
        $id= $data['id'];        
        $db = new Database();
        $getUser = "SELECT * FROM departments WHERE id=$id";
        $getDepartUser = "SELECT * FROM users WHERE depart_id=$id";

        $selectUser =  $db->mysqli->query($getUser); 
        $selectDepartUser =  $db->mysqli->query($getDepartUser); 

        // Existing
        if($selectUser->num_rows < 0){
             $errorr =  array('error' =>'This department is not exist' );
            exit(json_encode($errorr));
        } 
        if($selectDepartUser->num_rows > 0){
             $errorr =  array('error' =>'This department is used by user , if you want delete please delete users first');
            exit(json_encode($errorr));
        } 
        $sql="DELETE FROM  departments WHERE id=$id";
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }
 }

?>