<?php
    trait Bus{
        private $busID;
        private $busroute;
        private $drivername;
        public function __construct($bid,$br,$drn){
            $this->busID=$bid;
            $this->busroute=$br;
            $this->drivername=$drn;
        }
        public function getBID(){
            return  $this->busID;
        }
        public function getBR(){
            return  $this->busroute;
        }
        public function getDRN(){
            return  $this->drivername;
        }
    }
?>