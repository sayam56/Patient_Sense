<?php


session_start();
if(isset($_SESSION['fname'])) $fname=$_SESSION['fname'];
if(isset($_SESSION['lname'])) $lname=$_SESSION['lname'];
if(isset($_SESSION['doc_id'])) $doc_id=$_SESSION['doc_id'];


$_SESSION['fname']=$fname;
$_SESSION['lname']=$lname;
$_SESSION['doc_id']=$doc_id;


if($_SERVER['REQUEST_METHOD']=="POST")
	{

		if(isset($_POST['department']))
			$department=$_POST['department'];
		if(isset($_POST['start_time']))
            $start_time=$_POST['start_time'];
            if(isset($_POST['end_time']))
			$end_time=$_POST['end_time'];
		if(isset($_POST['location']))
			$location=$_POST['location'];
		if(isset($_POST['price']))
            $price=$_POST['price'];
        if(isset($_POST['details']))
            $details=$_POST['details'];
        if(isset($_POST['id']))
            $id=$_POST['id'];

		try{
                $conn=new PDO("mysql:host=localhost;dbname=patient_sense;",'root','');
                echo "<script>console.log('connection successful');</script>";
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "<script>window.alert('connection error');</script>";
            }


            try {
            	$sql= "UPDATE doctors set department = '$department', schedule_start= '$start_time' , schedule_end='$end_time', location='$location', price='$price', description='$details' where id='$id' ";
            	$obj = $conn->query($sql);
            } catch (PDOException $e) {
            	echo $e;
            }


            try {

            	$sqll= "INSERT into approval(doc_id,status) values ($id,'pending') ";
            	$objl = $conn->query($sqll);
            	
            } catch (PDOException $ex) {
            	echo $ex;
            }


            header("Location: doctor.php");


        }/*if ends*/


?>