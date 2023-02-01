<?php 
require_once 'attendanceModel.php';
require_once 'systemInfo.php';

// Attendance Create 
/**
 * សម្រាប់ Method  POST ☕
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if($_POST["mode"] =='clockin'){
      $attendance = new Attendance();
      $attendance->ClockIn($_POST);
    }
    if($_POST["mode"] =='clockout'){
      $attendance = new Attendance();
      $attendance->ClockOut($_POST);
    }
}
/**
 * សម្រាប់ Method  GET ☕
 */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        //យក ទិន្នន័យ
    if($_GET["mode"] =='list'){
        $attendance = new Attendance();
        $attendance->List($_GET);
    }
    if($_GET["mode"] =='list-today'){
        $attendance = new Attendance();
        $attendance->ListToday($_GET);
    }
    if($_GET['mode'] =='filter'){
      $attendance = new Attendance();
      $attendance->Filter($_GET);
    }
}

?>