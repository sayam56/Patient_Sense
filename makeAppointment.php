<?php
session_start();
$username=$_SESSION['username'];
$doctor_id=$_GET['id'];

try{
    $conn=new PDO("mysql:host=localhost;dbname=patient_sense;",'root','');
    echo "<script>console.log('connection successful');</script>";
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "<script>window.alert('connection error');</script>";
}


try{
    $query="SELECT schedule_start,schedule_end from doctors WHERE id='".$doctor_id."' " ;
                $object=$conn->query($query);
                $table=$object->fetchAll();
                $schedule_start= $table[0][0];
                
                $schedule_end= $table[0][1];
                $appointmentDate=getdate();
               $date= $appointmentDate['year']."-".$appointmentDate['mon']."-".$appointmentDate['mday'];
                $max_query="SELECT MAX(appoinment_time) FROM `appointment` WHERE doctor_id='".$doctor_id."' AND appointment_date='".$date."'" ;
                $object_time=$conn->query($max_query);
                if($object_time->rowCount()==0)
                {
                   
                    $query="INSERT INTO appointment VALUES('$doctor_id','$username','$date','$table[0][0]')";
                     $conn->exec($query);

                }
                else{

                
                $table1=$object_time->fetchAll();
               $max_time=$table1[0][0]; 
               
               if($max_time==NULL)
               {
                   $max_time=$schedule_start;
               } 
               
               $appointmentTime=date('H:i',strtotime('+20 minutes +0 seconds',strtotime($max_time)));  
               
              // $date=date('yy-m-d',strtotime('+1 day',strtotime($date)));
               
               
               if($appointmentTime<$schedule_end)
               {
                   
try{
     $query="INSERT INTO appointment VALUES('$doctor_id','$username','$date','$appointmentTime:00')";
     $conn->exec($query);
    
 
 
 }
 catch(PDOException $e){
     echo "<script>window.alert('insertion error');</script>";
 }
 

               }

               
               else
               {
                   $date=date('yy-m-d',strtotime('+1 day',strtotime($date)));
                                      
try{
    $query="INSERT INTO appointment VALUES('$doctor_id','$username','$date','$schedule_start')";
    $conn->exec($query);
   


}
catch(PDOException $e){
    echo "<script>window.alert('insertion error');</script>";
}


               
               }
            }
                
                
                
             
   


}
catch(PDOException $e){
    echo "<script>window.alert('appointment schedule  error');</script>";
}







header("Location: userdash.php");








?>