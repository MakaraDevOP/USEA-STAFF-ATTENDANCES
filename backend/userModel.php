<?php
   include('connection.php');
   include('getIPaddress.php');
   include('getLocation.php');
   class User  {
       private $name;
       private $role;
       private $code;
       private $email;
       private $phone;
       private $status;
       private $password;
       private $depart_id;

    public function List($data){
        $db = new Database();
        $sql="SELECT * FROM  view_staff_list ORDER BY code ASC";
        $result = $db->mysqli->query($sql);
        $obj =[];
        while( $row = $result->fetch_assoc()){
            array_push($obj,$row);
        }
        if(empty($obj)){
            $errorr =  array('data' =>'No record!' );
            exit(json_encode( $errorr));
        }

        $total_record = sizeof($obj);
        $per_page = $data['per_page'];
        $page_number= $data['page_number'];
        $initial_page = ($page_number-1) * $per_page; 
        $page = ceil($total_record/$per_page);
        $getStaffSql = "SELECT * FROM  view_staff_list ORDER BY code ASC LIMIT ".$initial_page.','.$per_page;
        $result1 = $db->mysqli->query($getStaffSql);
        // echo json_encode($result1);
        $obj1 =[];
        while( $row1 = $result1->fetch_assoc()){
            array_push($obj1,$row1);
        }
        $dataPagination = [
            'page' =>$page,
            'page_number'=>$page_number,
            'per_page'=>$per_page
        ];
        $dataPage = array('data'=>$obj1 , 'paginate'=>$dataPagination);
        echo json_encode($dataPage);
    }
    public function Insert($data){
        $name =  $data['name'];
        $code =  $data['code'];
        $role =  $data['role'];
        $email =  $data['email'];
        $phone =  $data['phone'];
        $status =  $data['status'];
        $password =  $data['password'];
        $departID  =$data['department'];
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
        $sql="INSERT INTO users (name,code ,role,email,phone,password,status,depart_id) VALUES ('$name','$code','$role','$email','$phone','$password','$status','$departID')";
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
        $departID  =$data['department'];
        $db = new Database();
        $sql="UPDATE users  SET name='$name',code='$code',role='$role',email='$email',phone='$phone',password='$password',status ='$status', depart_id='$departID' WHERE id=$id";
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }
    public function Search($data){
        $db = new Database();
        $search = $data['search'];
        $sql="SELECT * FROM  view_staff_list WHERE id LIKE '%$search%' OR name LIKE '%$search%' OR code LIKE '%$search%'";
        $result = $db->mysqli->query($sql);
        $obj =[];
        while( $row = $result->fetch_assoc()){
           array_push($obj,$row);
        }
        if(empty($obj)){
             $errorr =  array('data' =>'No record!' );
             exit(json_encode( $errorr));
        }
        $total_record = sizeof($obj);
        $per_page = $data['per_page'];
        $page_number= $data['page_number'];
        $initial_page = ($page_number-1) * $per_page; 
        $page = ceil($total_record/$per_page);
        $getStaffSql = "SELECT * FROM  view_staff_list   WHERE id LIKE '%$search%' OR name LIKE '%$search%' OR code LIKE '%$search%' ORDER BY code ASC LIMIT ".$initial_page.','.$per_page;
        $result1 = $db->mysqli->query($getStaffSql);
        // echo json_encode($result1);
        $obj1 =[];
        while( $row1 = $result1->fetch_assoc()){
            array_push($obj1,$row1);
        }
        $dataPagination = [
            'page' =>$page,
            'page_number'=>$page_number,
            'per_page'=>$per_page
        ];
        $dataPage = array('data'=>$obj1 , 'paginate'=>$dataPagination);
        echo json_encode($dataPage);
        // echo json_encode($obj);
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