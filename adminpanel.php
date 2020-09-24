<?php
session_start();
if(isset($_SESSION['username'])) $username=$_SESSION['username'];



$_SESSION['username']=$username;


$count = 1;

try{
    $conn=new PDO("mysql:host=localhost;dbname=patient_sense;",'root','');
    echo "<script>console.log('connection successful');</script>";
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "<script>window.alert('connection error');</script>";
}


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Patient Sense - Admin</title>
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
        <h2><?php echo $username ?></h2>
    </div>

    <div class="logoutBTN">
            <button onclick="logout();">Logout</button>
    </div>
    
</div>



<div class="outerbox">

  
     <table class="table table-striped" style="width: 80%; margin: auto;  ">
                <thead class="thead-dark" style="text-align: center;">

                  <tr>
                    <th scope="col" width="9%">Serial No.</th>
                    <th scope="col" width="18%">Doctor Name</th>
                    <th scope="col" width="18%">Appoinment Date</th>
                    <th scope="col" width="18%">Appointment Time</th>
                  </tr>
                  
                </thead>
            
          
              
                <tbody class="table" style="color: black;">
                  <?php

                  $count = 1;
                  $sql= "SELECT doc_id  FROM approval where status= 'pending' ";
                  $obj = $conn->query($sql);

                  if ($obj -> rowCount() == 0) {
                    #table is empty as in to room available
                    ?>
                      <tr>
                        <td colspan="4" style="text-align: center;">NO APPROVAL REQUESTS PENDING</td>
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