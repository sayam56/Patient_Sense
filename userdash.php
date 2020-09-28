<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/userdash.css">
     <title>Patient Sense</title>
     <link rel="icon" href="res/logo.ico">
    <script>
  window.watsonAssistantChatOptions = {
      integrationID: "5a767665-73fd-478c-b458-78dc702db162", // The ID of this integration.
      region: "us-south", // The region your integration is hosted in.
      serviceInstanceID: "9170f223-091a-4e08-8822-3733120b1651", // The ID of your service instance.
      onLoad: function(instance) { instance.render(); }
    };
  setTimeout(function(){
    const t=document.createElement('script');
    t.src="https://web-chat.global.assistant.watson.appdomain.cloud/loadWatsonAssistantChat.js";
    document.head.appendChild(t);
  });
</script>


    
</head>
<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        $username=$_SESSION['username'];
    }

/*
    $_SESSION['username']=$username;*/

    ?>




<body onload="reqAppBTN('<?php echo $username?>')">
   
   


    <?php
    
   /* if(isset($_SESSION['username']))
    {*/

        $username=$_SESSION['username'];

        $_SESSION['username']=$username;

        if(isset($_GET['dep']))
        {
            $price=$_GET['price'];
            $location=$_GET['location'];
            $department=$_GET['dep'];

            try{
                $conn=new PDO("mysql:host=localhost;dbname=patient_sense;",'root',''); 
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              }
              catch(PDOException $ex)
              {
                http_response_code(503);
        
                echo ("database connection error");
              }
              ?>

               <!-- after getting watson recommendation page elements -->
            <div class="container">
        <div class="header">
            <img src="res/logo_used.png" alt="">
            <div class="header_icons">
                
               <button> <a href="logout.php">Log Out</a></button> 

            </div>
        </div>
        <div class="appointment_alert">
        <div class="appointment_alert_icon">
        <i class="fa fa-bell" aria-hidden="true"></i>
        <h1>Your upcoming appointments</h1>
        
            </div>
        <div class="appointment_alert_exist" id="appointment_list">
            
            </div>
        </div>
        <div class="bot_component" id="doctor_row">
           
        </div>
        </div>


              
                     <?php
                     try{
                
  
                        $sqlquery="SELECT * FROM `doctors` WHERE department='$department' AND location='$location' AND price<=$price";
                      
                        $pdostmt=$conn->query($sqlquery);
                        if($pdostmt->rowCount()>0){
                            $table=$pdostmt->fetchAll();
                           foreach($table as $key)
                           {
                               
                              
                                
                               ?>
                               <script>
                                   var content=document.getElementById('doctor_row');
                                  var div=document.createElement('div');
                                  var div__left=document.createElement('div');
                                  var div__left_p=document.createElement('div');
                                  var div__right=document.createElement('div');
                                  var div__right_p=document.createElement('div');
                                  

                                  div__left.innerHTML='<h1>Dr. <?php echo $key['f_name'];  ?></h1><br>Green Life Medical<br><?php echo $key['department']?><br><?php echo $key['description']?><br>5years+';
                                  div__right.innerHTML="Tuesday off<br><br>Visiting hours<br> from <?php echo $key['schedule_start']?> to <?php echo $key['schedule_end']?> <br><br>Rating: 5<br> <button><a href='makeAppointment.php?id=<?php echo "$key[0]";?>'>Make an appointment</a></button> ";


                                  div__left.appendChild(div__left_p);
                                  div__right.appendChild(div__right_p);
                                  




                                  
                                  div.innerHTML="";
                                  div.className='doctor_row_element';
                                  div__left.className='doctor_row_element_left';
                                  div__right.className='doctor_row_element_right';
                                  div.appendChild(div__left);
                                  div.appendChild(div__right);
                                  content.appendChild(div);
                               </script>
                  <?php
                  }
                 }
  
                  //http_response_code(200);
                  //echo json_encode(array("department"=>$table[0][2])); //sending back the recommended type of doctor 
              
              else{
                  ///no data found for the given id value
                  http_response_code(400);
                  
                  echo json_encode(array("message"=>"No doctor matches your preferences"));
              }
          }
          catch(PDOException $ex){
            ///database or query error
            http_response_code(503);
    
            echo ("query error");
        }
         

  


            ?>
           

            <?php
        }
        else{
        	$_SESSION['username']=$username;
            ?>
            <!-- without hitting watson page elements -->
            <!-- html components of patient dashboard -->
        <div class="container">
        <div class="header">
            <img src="res/logo_used.png" alt="">
            <div class="header_icons">
               <h2 style="margin-left: -250px;">Username: <?php echo $username?></h2>
               <button> <a href="logout.php">Log Out</a></button> 

            </div>
        </div>
        <div class="appointment_alert">
            <div class="appointment_alert_icon">
        <i class="fa fa-bell" aria-hidden="true"></i>
        <h1>Your upcoming appointments</h1>
        </div>
        <div class="appointment_alert_exist" id="appointment_list">
            
        </div>
        </div>
        <div class="bot_component">
            <div class="guidance">
                
                <div class="guidance_element">

                    <h2>Finding a suitable doctor has never been this simple</h2>
                    <div class="guidance_p">
                    <p>Revolutionary recommendation system is just one CLICK away </p>
                    <p> Tap the bottom right button to get started with our Assistant.</p>
                    </div>
                </div>
                <!-- <div class="guidance_img">
                
                    <img src="https://img.icons8.com/officel/250/000000/ibm-watson.png" alt="">
                    </div> -->
            </div>
          
        </div>
        </div>


        <!-- Page design ends here -->
            <?php
        }
        ?>
        
        <?php
/*    }
    else
    {
        ?>
        <h1>You are not logged in</h1>
        <?php
    }
    */
    
    ?>
</body>
</html>



<script src="https://kit.fontawesome.com/6795b26b1a.js" crossorigin="anonymous"></script>
<script>
    function reqAppBTN(username){
/*		console.log("doc id: "+doc_id+" status: "+status);
		console.log(document.getElementById("tr_"+doc_id));*/

		

		var ajaxreq=new XMLHttpRequest();
		  ajaxreq.open("GET","appointment_view.php?username="+username); 


		  ajaxreq.onreadystatechange=function ()
		  {
		   if(ajaxreq.readyState==4 && ajaxreq.status==200)
		          {
		               var response=ajaxreq.responseText;
		              
		               var divelm=document.getElementById('appointment_list');
		              	
		              
		               divelm.innerHTML=response;
		         
		               
		          }
		  }
		  
		  ajaxreq.send();
	}
</script>
