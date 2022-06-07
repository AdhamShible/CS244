<?php
    trait Grades{
        private $grades;
        public function __construct($grd){
            $this->grades=$grd;
        }
        public function getGRD(){
            return $this->grades;
        }
    }
?>