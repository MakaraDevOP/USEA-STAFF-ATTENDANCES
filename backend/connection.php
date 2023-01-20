<?php 
    class database{
        private $servername='localhost';
        private $username='root';
        private $password='';
        private $dbname='staff_attendence';
        private $result=array();
        public $mysqli='';
        // ការភ្ជាប់ទៅកាន់ Database
        public function __construct(){
            $this->mysqli = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        }
        // ការផ្ដាច់ Connect Database
        public function __destruct(){
            $this->mysqli->close();
        }
    }
?>