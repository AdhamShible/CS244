<?php
    session_start();
    require_once "User.php";
    require "UserInfo.php";
    class Student extends UserInfo implements User{ 
        private $phone;
        private $address;
        private $busid;
        public function __construct($ID, $fn, $ln, $em, $pass, $ph, $ad, $bid)
        {
            parent::__construct($ID, $fn, $ln, $em, $pass);
            $this->phone=$ph;
            $this->address=$ad;
            $this->busid=$bid;
        }
        public function getadd(){
            return $this->address;
        }
        public function getph(){
            return $this->phone;
        }
        public function getbid(){
            return $this->busid;
        }
        public function __destruct()
        {
        }
        public function ShowProfile(){
            echo $this->getID();
            echo "<hr>";
            echo $this->getfName();
            echo "<hr>";
            echo $this->getlName();
            echo "<hr>";
            echo $this->getem();
            echo "<hr>";
            echo $this->getph();
            echo "<hr>";
            echo $this->getadd();
            echo "<hr>";
            echo $this->getbid();
            echo "<hr>";
        }
    }
    $id_value = $_SESSION['ID'];
    $filename="Student.txt";
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($Arrline[0]==$id_value){
            $st=new Student($Arrline[0],$Arrline[1],$Arrline[2],$Arrline[3],$Arrline[4],$Arrline[5],$Arrline[6],$Arrline[7]);
        }
    }
    fclose($file);
    $st->ShowProfile();
?>