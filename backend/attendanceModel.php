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
    public function List($data){
        $db = new Database();
        // $search = $data['search'];
        $from = $data['from'];
        $to = $data['to'];
        $department = $data['department'];
        // echo json_encode($department);
        if($department =='all'){
            $sql="SELECT * FROM  view_attendances_list  Where date  between '$from' and DATE_ADD('$to',INTERVAL 1 DAY)  ORDER BY date DESC";
        }else{
            $sql="SELECT * FROM  view_attendances_list  Where date  between '$from' and DATE_ADD('$to',INTERVAL 1 DAY) and depart_id='$department' ORDER BY date DESC";
        }
        $result = $db->mysqli->query($sql);
        $obj =[];
        while( $row = $result->fetch_assoc()){
           array_push($obj,$row);
        }
        if(empty($obj)){
             $errorr =  array('data' =>'No record!' );
             exit(json_encode( $errorr));
        }
        // echo json_encode($obj);
        $total_record = sizeof($obj);
        $per_page = $data['per_page'];
        $page_number= $data['page_number'];
        $initial_page = ($page_number-1) * $per_page; 
        $page = ceil($total_record/$per_page);
        if($department =='all'){
            $getStaffSql = "SELECT * FROM  view_attendances_list Where date  between '$from' and DATE_ADD('$to',INTERVAL 1 DAY)   ORDER BY date DESC LIMIT ".$initial_page.','.$per_page;
        }else{
            $getStaffSql = "SELECT * FROM  view_attendances_list Where date  between '$from' and DATE_ADD('$to',INTERVAL 1 DAY)  and depart_id='$department' ORDER BY date DESC LIMIT ".$initial_page.','.$per_page;
        }
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
    public function ListToday(){
        $db = new Database();
        $sql="SELECT * FROM  view_attendances_list  WHERE DATE(date)=CURDATE()  ORDER BY date DESC";
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
    public function Filter($data){
        $db = new Database();
        $search = $data['search'];
        $from = $data['from'];
        $to = $data['to'];
        $department = $data['department'];
        // echo json_encode($department);

        if($department =='all'){
        $sql="SELECT * FROM  view_attendances_list   WHERE   date >= '$from' and date <='$to' AND name LIKE '%$search%' ";
        }else{
        $sql="SELECT * FROM  view_attendances_list   WHERE   date >= '$from' and date <='$to' AND name LIKE '%$search%' and depart_id='$department' ";
        }
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
        if($department =='all'){
           $getStaffSql = "SELECT * FROM  view_attendances_list WHERE   date >= '$from' and date <='$to' AND name LIKE '%$search%' ORDER BY date DESC LIMIT ".$initial_page.','.$per_page;
        }else{
            $getStaffSql = "SELECT * FROM  view_attendances_list WHERE   date >= '$from' and date <='$to' AND name LIKE '%$search%' and depart_id='$department'  ORDER BY date DESC LIMIT ".$initial_page.','.$per_page;
        }
        $result1 = $db->mysqli->query($getStaffSql);
        // echo json_encode($result1);
        $obj1 =[];
        while( $row1 = $result1->fetch_assoc()){
            array_push($obj1,$row1);
        }
        // echo json_encode($obj1);
        $dataPagination = [
            'page' =>$page,
            'page_number'=>$page_number,
            'per_page'=>$per_page
        ];
        $dataPage = array('data'=>$obj1 , 'paginate'=>$dataPagination);
        echo json_encode($dataPage);
    }
 }

?>