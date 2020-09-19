<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/adminpanel.css">
</head>
<body>
    <div class="header">
        <img src="res/logo.png" alt="none">
<button><a href="logout.php">Logout</a></button> 
</div>
    <?php
session_start();
    if(isset($_SESSION['username']))
    {
        ?>
        <div class="outerbox">
            <div class="outerbox_left">
        <h1>Update Doctor List </h1>
        </div>
        <form method="POST">
        <p>Doctor's Name</p>
        <input type="text" name="doctor_name">
        <p>Department</p>
        <input type="text" name="department">
        <p>Schedule_start</p>
        <input type="time" name="schedule_start">
        <p>Schedule_end</p>
        <input type="time" name="schedule_end">
        <p>Location</p>
        <input type="text" name="location">
        <p>Fee</p>
        <input type="text" name="fee"><br>
        <input type="submit" value="Add doctor">
    </form>
    </div>
        <?php
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $doctor_name=$department=$schedule_start=$schedule_end=$location=$fee="";
            if(isset($_POST['doctor_name']))
                $doctor_name=$_POST['doctor_name'];
            if(isset($_POST['department']))
                $department=$_POST['department'];
                if(isset($_POST['schedule_start']))
                $schedule_start=$_POST['schedule_start'];
            if(isset($_POST['schedule_end']))
                $schedule_end=$_POST['schedule_end'];
            if(isset($_POST['location']))
                $location=$_POST['location'];
                if(isset($_POST['fee']))
                $fee=$_POST['fee'];
    
            try{
                    $conn=new PDO("mysql:host=localhost;dbname=patient_sense;",'root','');
                    echo "<script>console.log('connection successful');</script>";
                    
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch(PDOException $e){
                    echo "<script>window.alert('connection error');</script>";
                }
    
    
    
                try{
                    $query="INSERT INTO doctors VALUES('','$doctor_name','$department','$schedule_start','$schedule_end','$location','$fee')";
                    $conn->exec($query);
                   
    
    
                }
                catch(PDOException $e){
                    echo "<script>window.alert('insertion error');</script>";
                }
    
    
    
        }




    }
    else
    {
        ?>
        <h1>I am not logged in</h1>
        <?php
    }
    
    
    ?>
</body>
</html>