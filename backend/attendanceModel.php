<?php
   include('connection.php');
   include('getIPaddress.php');
   include('getLocation.php');
   require_once('systemInfo.php');
   class Attendance  {
       private $date;
       private $user_id;
       private $location;
       private $device_name;
       private $date_clock_in;
       private $date_clock_out;
       private $work_time;
       private $note;
    public function List(){
        $db = new Database();
        $sql="SELECT * FROM  view_attendances_list ORDER BY date DESC";
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
    public function ListToday(){
        $db = new Database();
        $sql="SELECT * FROM  view_attendances_list  WHERE DATE(date)=CURDATE() ORDER BY date DESC";
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
    public function ClockIn($data){
        $id =  $data['user'];
        $date =  $data['date'];
        $date_clock_in =  $data['date'];
        $location =  $data['location'];
        $note =  $data['note'];
         
        $browser = Detect::browser();
        $device = Detect::systemInfo();
        $os = array($device);
        $bs = array($browser);
         $device_name = $os[0]['device']."-".$os[0]['os']."-".$bs[0];

        $db = new Database();
        // $getName = "SELECT * FROM attendances WHERE name='$name'";
        // $getCode= "SELECT * FROM attendances WHERE code_name='$code'";
        // $selectCode =  $db->mysqli->query($getCode); 
        // $selectName =  $db->mysqli->query($getName); 
        // // ការកំណត់ មិនស្ទួន  Code 
        if(empty($date_clock_in)){
             $errorr =  array('error' =>'This date_clock_in is reqired' );
            exit(json_encode($errorr));
        }
        if(empty($id)){
             $errorr =  array('error' =>'This user is reqired' );
            exit(json_encode($errorr));
        }
        if(empty($date)){
             $errorr =  array('error' =>'This date is reqired' );
            exit(json_encode($errorr));
        }
        $sql="INSERT INTO attendances (user_id ,location, device_name,note,date,date_clock_in, date_clock_out,work_time) VALUES ('$id','$location','$device_name','$note','$date','$date_clock_in',null,null)";
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }
    public function ClockOut($data){
        $txn_id = $data['txn_id'];
        $id =  $data['user'];
        $date =  $data['date'];
        $date_clock_in =  $data['date'];
        $location =  $data['location'];
        $note =  $data['note'];
        $date_clock_out = $data['date'];
        $work_time = $data['work_time'];
        $db = new Database();
        if(empty($txn_id)){
             $errorr =  array('error' =>'This txn_id is reqired' );
            exit(json_encode($errorr));
        }
        if(empty($date_clock_in)){
             $errorr =  array('error' =>'This date_clock_in is reqired' );
            exit(json_encode($errorr));
        }
        if(empty($id)){
             $errorr =  array('error' =>'This user is reqired' );
            exit(json_encode($errorr));
        }
        if(empty($date)){
             $errorr =  array('error' =>'This date is reqired' );
            exit(json_encode($errorr));
        }
        $sql=" UPDATE attendances SET location='$location',note ='$note',date_clock_out='$date_clock_out', work_time='$work_time' WHERE id =$txn_id";
        // echo json_encode($sql);
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }
    public function Insert($data){
        $name =  $data['name'];
        $code =  $data['code_name'];
        $description =  $data['description'];

        $db = new Database();
        $getName = "SELECT * FROM attendances WHERE name='$name'";
        $getCode= "SELECT * FROM attendances WHERE code_name='$code'";
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
        $sql="INSERT INTO attendances (name,code_name, description) VALUES ('$name','$code','$description')";
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }
    public function Edit($data){
        $db = new Database();
        $id = $data['id'];
        $sql="SELECT * FROM  attendances WHERE id=$id";
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
        $sql="UPDATE attendances  SET name='$name',code_name='$code',description='$description' WHERE id=$id";
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }
    public function Search($data){
        $db = new Database();
        $search = $data['search'];
        $sql="SELECT * FROM  attendances WHERE  name LIKE '%$search%' OR code_name LIKE '%$search%'";
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
        $getUser = "SELECT * FROM attendances WHERE id=$id";
        $selectUser =  $db->mysqli->query($getUser); 
        // Existing
        if($selectUser->num_rows < 0){
             $errorr =  array('error' =>'This department is not exist' );
            exit(json_encode($errorr));
        } 
        $sql="DELETE FROM  attendances WHERE id=$id";
        $result = $db->mysqli->query($sql);
        echo json_encode($result);
    }
 }

?>