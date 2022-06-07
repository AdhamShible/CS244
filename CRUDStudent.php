<?php
    session_start();
    include "../Backend/Student.php";
    //Function reads courseid, and returns course name when found
    function readCID($CID){
        $filename='../Invoices/Courses.txt';
        $file=fopen($filename, 'a+') or die ('File Inaccesible');
        $seperator="|";
        while(!feof($file)){
            $line=fgets($file);
            $Arrline=explode($seperator,$line);
            if($Arrline[0]==$CID){
                return $Arrline[1];
                fclose($file);
            }
        }
        fclose($file);
    }
    function readTchSch($TchID,Student $st){
        $filename='../Invoices/TeacherSchedule.txt';
        $file=fopen($filename, 'a+') or die ('File Inaccesible');
        $seperator="|";
        while(!feof($file)){
            $line=fgets($file);
            $Arrline=explode($seperator,$line);
            if($TchID==$Arrline[0]){
                $st->SetSchedule($Arrline[1],$Arrline[2]);
                $st->ShowSCH();
            }
        }
    }
    function readTchCrs($CID,Student $st){
        $filename='../Invoices/TchToCrsRelation.txt';
        $file=fopen($filename, 'a+') or die ('File Inaccesible');
        $seperator="|";
        while(!feof($file)){
            $line=fgets($file);
            $Arrline=explode($seperator,$line);
            if($CID==$Arrline[1]){
                $CID;
                readTchSch($Arrline[0],$st);
            }
        }
    }
    function readBus($BID,Student $st){
        $BID=trim($BID);
        $filename='../Invoices/Bus.txt';
        $file=fopen($filename, 'a+') or die ('File Inaccesible');
        $seperator="|";
        while(!feof($file)){
            $line=fgets($file);
            $Arrline=explode($seperator,$line);
            if($BID==$Arrline[0]){
                $st->SetBus($Arrline[0],$Arrline[1],$Arrline[2]);
            }
        }
    }
    //Recieve ID from login page, searches for it in student file, then creates an object of the student
    $id_value = $_SESSION['ID'];
    $filename='../Invoices/Student.txt';
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

    echo "Profile:<br><br>";
    $st->ShowProfile();

    echo "<br><br>";
    echo "Courses:<br><br>";
    /*Searches for student id in the student to course relation file,
        when found, inputs the corresponding course id in a variable then used to be sent as a parametre,
        2 functions are called, SetCourse which constructs courseid, and coursename,
        coursename is constructed by calling readCID function, which searches for course id inside of courses file,
        when found, the function returns the course name related to the course id,
        ShowCRS function is called to output the course id and course name from trait course
    */
    $filename='../Invoices/StToCrsRelation.txt';
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($st->getID()==$Arrline[0]){
            $CID=$Arrline[1];
            $st->SetCourse($CID[1],readCID($CID[1]));
            $st->ShowCRS();
        }
    }
    fclose($file);
    
    echo "<br><br>";
    echo "Grades:<br><br>";
    //Grades
    $filename='../Invoices/StGrd.txt';
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($st->getID()==$Arrline[0]){
            $CID=$Arrline[1];
            $st->SetGrade($Arrline[2]);
            $st->SetCourse($Arrline[1],readCID($CID[1]));
            $st->ShowCRS();
            $st->ShowGRD();
        }
    }
    fclose($file);
    //Schedule
    echo"<br><br>";
	echo "Schedule:<br><br>";

    $filename='../Invoices/StToCrsRelation.txt';
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($st->getID()==$Arrline[0]){
            $CID=$Arrline[1];
            $st->SetCourse($CID,readCID($CID[1]));
            $st->ShowCRS();
            readTchCrs($CID,$st);
            echo "<br>";
        }
    }
    fclose($file);
    //Bus
    echo"<br><br>";
	echo "Bus:<br><br>";

    $filename='../Invoices/BusToStudent.txt';
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($st->getID()==$Arrline[0]){
            readBus($Arrline[1],$st);
            $st->ShowBus();
        }
    }
    fclose($file);
?>