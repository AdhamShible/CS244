<?php
    class Principal{
        private $id;
        private $fname;
        private $lname;
        private $email;
        public function __construct($id, $f,$l,$em)
        {
            $this->ID=$id;
            $this->fname=$f;
            $this->lname=$l;
            $this->email=$em;
        }
        public function getid(){
            return $this->id;
        }
        public function Fees(){
            return $this->Fees;
        }
        public function getfname(){
            return $this->fnamed;
        }
        public function getlname(){
            return $this->lname; 
        }
        public function getemail(){
            return $this->email;
        }
        function __destruct(){
        
    }

    }
?>
