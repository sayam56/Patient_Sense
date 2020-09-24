<?php
session_start();
if(isset($_SESSION['fname'])) $fname=$_SESSION['fname'];
if(isset($_SESSION['lname'])) $lname=$_SESSION['lname'];
if(isset($_SESSION['doc_id'])) $doc_id=$_SESSION['doc_id'];


$_SESSION['fname']=$fname;
$_SESSION['lname']=$lname;
$_SESSION['doc_id']=$doc_id;

$count = 1;

try{
    $conn=new PDO("mysql:host=localhost;dbname=patient_sense;",'root','');
    echo "<script>console.log('connection successful');</script>";
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "<script>window.alert('connection error');</script>";
}

$status='';
 try{
        $query="SELECT status from approval where doc_id='$doc_id' ";
        $object=$conn->query($query);
        if ($object->rowCount() == 0) {
            $status='Not Submitted';
        }
        else{
             $table = $object->fetchall();

            foreach ($table as $key) {
                $status=$key[0];
                 }
        }

}
catch(PDOException $e){
    echo "<script>window.alert('insertion error');</script>";
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Patient Sense</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

           <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>   

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="icon" href="res/logo.ico">
    <link rel="stylesheet" href="css/doc.css">
</head>
<body>

<div class="topbar">

    <div class="name">
        <h2><?php echo $fname." ".$lname; ?></h2>
    </div>

    <div class="logoutBTN">
            <button onclick="logout();">Logout</button>
    </div>
    
</div>

<div class="status">
    <?php
        if ($status == 'pending') {
            ?> 
           <h2 style="color: orange;">Status: <?php echo $status;?></h1> 
             <?php
        }
        elseif ($status == 'rejected') {
            ?> 
           <h2 style="color: red;">Status: <?php echo $status;?></h1> 
             <?php
        }
        elseif ($status == 'approved'){
            ?> 
           <h2 style="color: green;">Status: <?php echo $status;?></h1> 
             <?php
        }
        else{
            ?> 
           <h2 style="color: black;">Status: <?php echo $status;?></h1> 
             <?php
        }
    ?>

</div> <!-- status ends -->


<?php 
    if ($status == 'Not Submitted') {
        ?>
        <div class="login">
            <div class="approval">
                <form action="updateApproval.php" method="POST">
                    <h1>Update Info For Approval</h1>
                        <p>Department</p>
                        <input type="text" name="department">
                        <p>Chamber Start Time</p>
                        <input type="time" name="start_time">
                        <p>Chamber End Time</p>
                        <input type="time" name="end_time">
                        <p>Location</p>
                        <input type="text" name="location">
                        <p>Visit Price</p>
                        <!-- <p>Confirm pasword</p>-->
                        <input type="text" name="price"><br> 
                        <p>Other Details</p>
                        <textarea rows="2" cols="30" name="details" id='details' placeholder="Enter Your Professional Experiences Here"></textarea>
                        <input type="hidden" name="id" value="<?php echo $doc_id; ?>" >
                        <input type="submit" value="Request For Approval">
                </form>
            </div>  
        </div>

        <?php


    }/*if ends*/

    elseif ($status == 'pending') {
         ?>
        <div class="login">
            <div class="approval">
                <form action="updateApproval.php" method="POST">
                    <h1>Awaiting Approval</h1>
                        
                </form>
            </div>  
        </div>


    <div class="outerbox">

  
     <table class="table table-striped" style="width: 80%; margin: auto;  ">
                <thead class="thead-dark" style="text-align: center;">

                  <tr>
                    <th scope="col" width="9%">Serial No.</th>
                    <th scope="col" width="18%">Patient Name</th>
                    <th scope="col" width="18%">Appoinment Date</th>
                    <th scope="col" width="18%">Appointment Time</th>
                  </tr>
                  
                </thead>
                <tbody class="table" style="color: black;">
                      <tr>
                        <td colspan="4" style="text-align: center;">WAITING FOR APPROVAL</td>
                      </tr>

                </tbody>
              </table>

</div>


        <?php

        
    }/*elseif*/
    elseif ($status == 'rejected') {

        ?>
        <div class="login">
            <div class="approval">
                <form action="updateApproval.php" method="POST">
                    <h1>Rejected</h1>
                        
                </form>
            </div>  
        </div>

    <div class="outerbox">

  
     <table class="table table-striped" style="width: 80%; margin: auto;  ">
                <thead class="thead-dark" style="text-align: center;">

                  <tr>
                    <th scope="col" width="9%">Serial No.</th>
                    <th scope="col" width="18%">Patient Name</th>
                    <th scope="col" width="18%">Appoinment Date</th>
                    <th scope="col" width="18%">Appointment Time</th>
                  </tr>
                  
                </thead>
                <tbody class="table" style="color: black;">
                      <tr>
                        <td colspan="4" style="text-align: center; color: red;">REJECTED!! CANNOT GET APPOINTMENTS</td>
                      </tr>

                </tbody>
              </table>

</div>

        <?php

    }
     elseif ($status == 'approved') {

        ?>
        <div class="login">
            <div class="approval">
                <form action="updateApproval.php" method="POST">
                    <h1>Approved</h1>
                        
                </form>
            </div>  
        </div>


<div class="outerbox">

  
     <table class="table table-striped" style="width: 80%; margin: auto;  ">
                <thead class="thead-dark" style="text-align: center;">

                  <tr>
                    <th scope="col" width="9%">Serial No.</th>
                    <th scope="col" width="18%">Patient Name</th>
                    <th scope="col" width="18%">Appoinment Date</th>
                    <th scope="col" width="18%">Appointment Time</th>
                  </tr>
                  
                </thead>
            
          
              
                <tbody class="table" style="color: black;">
                  <?php

                  $count = 1;
                  $sql= "SELECT *  FROM appointment where doctor_id= '".$doc_id."' ";
                  $obj = $conn->query($sql);

                  if ($obj -> rowCount() == 0) {
                    #table is empty as in to room available
                    ?>
                      <tr>
                        <td colspan="4" style="text-align: center;">NO APPOINTMENTS YET</td>
                      </tr>
                    <?php
                  }else
                  {

                    $table = $obj->fetchAll();

                    foreach ($table as $val) {
                   
                      ?>
                      
                      <tr style="border-bottom: 2px solid black; text-align:center; font-size: 20px; color: black;">

                        <td width="9%"><?php echo $count ?></td> 

                        
                        <td width="18%"><?php echo $val[1] ?></td>

                        <td width="18%"><?php echo $val[2] ?> </td>

                        <td width="18%"><?php echo $val[3] ?> </td>


                        
                        <?php $count++; ?>
                      </tr>
                      <?php
                      
                    }/*foreach ends here*/
                  }

                  ?>

                </tbody>
              

              </table>

</div>


        <?php

     }


?>

<div class="footerLogo">
    <img src="res/logo.png">
</div>





<script>
    function logout(){
        window.location.href='logout.php';
    }



</script>

</body>
</html>