<?php
    trait Schedule{
        private $starttime;
        private $endtime;
        public function __construct($STT,$ET){
            $this->starttime=$STT;
            $this->endtime=$ET;
        }
        public function getSTT(){
            return $this->starttime;
        }
        public function getET(){
            return $this->endtime;
        }
    }
?>