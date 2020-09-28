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
    <link rel="stylesheet" href="css/adminpanel.css">
</head>
<body>

<div class="topbar">

    <div class="name">
        <h2>Admin</h2>
    </div>

    <div class="logoutBTN">
            <button onclick="logout();">Logout</button>
    </div>
    
</div>
<div class="btnArea">
	<button type="button" class="btn btn-info" id="apprvBTN" onclick="showApproval();">Show Approval Requests</button>
	<button type="button" class="btn btn-info" id="docBTN" onclick="showDoc();">Show Doctors List</button>
</div>



 <div class="outerbox">

 <div id="approval">
 	     <table class="table table-striped" style="width: 98%; margin: auto; text-align: center;">
                <thead class="thead-dark">

                  <tr style="text-align: center;">
                    <th scope="col" style="text-align: center;" width="7%">Serial</th>
                    <th scope="col" style="text-align: center;" width="18%">Doctor Name</th>
                    <th scope="col" style="text-align: center;" width="18%">Department</th>
                    <th scope="col" style="text-align: center;" width="13%">Location</th>
                    <th scope="col" style="text-align: center;" width="10%">Price</th>
                    <th scope="col" style="text-align: center;" width="14%">Description</th>
                    <th scope="col" style="text-align: center;" width="20%">Action</th>
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
                        <td colspan="7" style="text-align: center;">NO APPROVAL REQUESTS PENDING</td>
                      </tr>
                    <?php
                  }else
                  {

                    $table = $obj->fetchAll();

                    foreach ($table as $val) {

                    	$qry = "SELECT * FROM doctors where id='".$val[0]."' ";
                    	$qryObj = $conn->query($qry);
                    	$qryTab = $qryObj->fetchAll();

                    	foreach ($qryTab as $k) {
                    		
                    		?>
                      
                      <tr style="border-bottom: 2px solid black; text-align:center; font-size: 20px; color: black;" id="tr_<?php echo $val[0]; ?>">


                        <td width="7%"><?php echo $count ?></td> 

                        
                        <td width="18%"><?php echo $k[2]." ".$k[3] ?></td>

                        <td width="18%"><?php echo $k[4] ?> </td>

                        <td width="13%"><?php echo $k[7] ?> </td>
                        <td width="10%"><?php echo $k[8] ?>tk </td>
                        <td width="14%"><?php echo $k[9] ?> </td>

                        <td width="20%">
                        	<button class="btn btn-success" onclick="reqAppBTN('<?php echo $val[0]?>' , 'approved');" >Approve</button>
                        	<button class="btn btn-danger" onclick="reqAppBTN('<?php echo $val[0]?>' , 'rejected');" >Reject</button>

                        	 </td>

                        
                        <?php $count++; ?>
                      </tr>
                      <?php

                    	}/*inner foreach*/

                   
                      
                      
                    }/*foreach ends here*/
                  }

                  ?>

                </tbody>
              

              </table>
 </div><!-- approval ends -->


 <div id="docList">
 		     <table class="table table-striped" style="width: 98%; margin: auto; text-align: center;">
                <thead class="thead-dark">

                  <tr style="text-align: center;">
                    <th scope="col" style="text-align: center;" width="7%">Serial</th>
                    <th scope="col" style="text-align: center;" width="18%">Doctor Name</th>
                    <th scope="col" style="text-align: center;" width="18%">Department</th>
                    <th scope="col" style="text-align: center;" width="13%">Location</th>
                    <th scope="col" style="text-align: center;" width="10%">Price</th>
                    <th scope="col" style="text-align: center;" width="14%">Description</th>
                    <th scope="col" style="text-align: center;" width="20%">Action</th>
                  </tr>
                  
                </thead>
            
          
              
                <tbody class="table" style="color: black;">
                  <?php

                  $count = 1;
                  $sql= "SELECT doc_id  FROM approval where status= 'approved' ";
                  $obj = $conn->query($sql);

                  if ($obj -> rowCount() == 0) {
                    #table is empty as in to room available
                    ?>
                      <tr>
                        <td colspan="7" style="text-align: center;">NO APPROVED DOCTORS</td>
                      </tr>
                    <?php
                  }else
                  {

                    $table = $obj->fetchAll();

                    foreach ($table as $val) {

                    	$qry = "SELECT * FROM doctors where id='".$val[0]."' ";
                    	$qryObj = $conn->query($qry);
                    	$qryTab = $qryObj->fetchAll();

                    	foreach ($qryTab as $k) {
                    		
                    		?>
                      
                      <tr style="border-bottom: 2px solid black; text-align:center; font-size: 20px; color: black;" id="tr_<?php echo $val[0]; ?>">


                        <td width="7%"><?php echo $count ?></td> 

                        
                        <td width="18%"><?php echo $k[2]." ".$k[3] ?></td>

                        <td width="18%"><?php echo $k[4] ?> </td>

                        <td width="13%"><?php echo $k[7] ?> </td>
                        <td width="10%"><?php echo $k[8] ?>tk </td>
                        <td width="14%"><?php echo $k[9] ?> </td>

                        <td width="20%">
                        	<button class="btn btn-danger" onclick="delDoc('<?php echo $val[0]; ?>');">Delete</button>

                        	 </td>

                        
                        <?php $count++; ?>
                      </tr>
                      <?php

                    	}/*inner foreach*/

                   
                      
                      
                    }/*foreach ends here*/
                  }

                  ?>

                </tbody>
              

              </table>
 	
 </div> <!-- docList ends -->


</div>  <!-- OuterBox -->



<!-- <div class="footerLogo">
    <img src="res/logo.png">
</div>

 -->



<script>
    function logout(){
        window.location.href='logout.php';
    }

	function showApproval(){

		if ($("#approval").is(":visible")) {
			$("#approval").hide("slow");
			$("#docList").show("slow");
			document.getElementById('apprvBTN').style.background="red";
			document.getElementById('docBTN').style.background="green";
			
		}else{
			$("#approval").show("slow");
			$("#docList").hide("slow");
			document.getElementById('apprvBTN').style.background="green";
			document.getElementById('docBTN').style.background="red";
		}
		
	}

	function showDoc(){

		if ($("#docList").is(":visible")) {
			$("#docList").hide("slow");
			$("#approval").show("slow");
			document.getElementById('docBTN').style.background="red";
			document.getElementById('apprvBTN').style.background="green";
			
		}else{
			$("#docList").show("slow");
			$("#approval").hide("slow");
			document.getElementById('docBTN').style.background="green";
			document.getElementById('apprvBTN').style.background="red";

		}

	}


	function reqAppBTN(doc_id,status){
/*		console.log("doc id: "+doc_id+" status: "+status);
		console.log(document.getElementById("tr_"+doc_id));*/

		$('#tr_'+doc_id).hide("slow");

		var ajaxreq=new XMLHttpRequest();
		  ajaxreq.open("GET","reqAppAjax.php?doc_id="+doc_id+'&status='+status); 


		  ajaxreq.onreadystatechange=function ()
		  {
		   if(ajaxreq.readyState==4 && ajaxreq.status==200)
		          {
		               var response=ajaxreq.responseText;
		              
		               var divelm=document.getElementById('docList');
		              	$('#tr_'+doc_id).hide("slow");
		              
		               divelm.innerHTML=response;
		         
		               
		          }
		  }
		  
		  ajaxreq.send();
	} /*reqAppBTN*/



	function delDoc(doc_id){
		console.log("doc id: "+doc_id);

		$('#tr_'+doc_id).hide("slow");

/*		var ajaxreq=new XMLHttpRequest();
		  ajaxreq.open("GET","docDelAjax.php?doc_id="+doc_id); 


		  ajaxreq.onreadystatechange=function ()
		  {
		   if(ajaxreq.readyState==4 && ajaxreq.status==200)
		          {
		               var response=ajaxreq.responseText;
		              
		               var divelm=document.getElementById('docList');
		              	
		              
		               divelm.innerHTML=response;
		         
		               
		          }
		  }
		  
		  ajaxreq.send();*/
	}


</script>

</body>
</html>