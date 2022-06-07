<?php
    include "../Frontend/TopNav.html";
    include "../Frontend/SideMenu.html";
    require_once "User.php";
    require "UserInfo.php";
    require "Courses.php";
    require "CourseInterface.php";
    require "Grades.php";
    require "Schedule.php";
    require "Bus.php";
    class Student extends UserInfo implements User, CourseInterface{
        private $phone;
        private $address;
        use Courses{
            Courses::__construct as crs;
        }
        use Grades{
            Grades::__construct as grd;
        }
        use Schedule{
            Schedule::__construct as sch;
        }
        use Bus{
            Bus::__construct as bs;
        }
        public function __construct($ID, $fn, $ln, $em, $pass, $ph, $ad)
        {
            parent::__construct($ID, $fn, $ln, $em, $pass);
            $this->phone=$ph;
            $this->address=$ad;
        }
        public function SetCourse($CID,$CN)
        {
            $this->crs($CID,$CN);
        }
        public function SetGrade($grd)
        {
            $this->grd($grd);
        }
        public function SetSchedule($STT,$ET){
			$this->sch($STT,$ET);
		}
        public function SetBus($bid,$br,$drn)
        {
            $this->bs($bid,$br,$drn);
        }
        public function getadd(){
            return $this->address;
        }
        public function getph(){
            return $this->phone;
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
        }
        public function ShowCRS(){
            echo $this->getCID();
            echo "<hr>";
            echo $this->getCN();
            echo "<hr>";
        }
        public function ShowGRD(){
            echo $this->getGRD();
            echo "<hr>";
        }
        public function ShowSCH(){
			echo $this->getSTT();
			echo"<hr>";
			echo $this->getET();
			echo "<hr>";
		}
        public function ShowBus(){
            echo $this->getBID();
            echo"<hr>";
            echo $this->getBR();
            echo"<hr>";
            echo $this->getDRN();
            echo"<hr>";
        }
    }
?>