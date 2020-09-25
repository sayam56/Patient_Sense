
<?php
	   /*DB connect*/
try{
    $conn=new PDO("mysql:host=localhost;dbname=patient_sense;",'root','');
    echo "<script>console.log('connection successful');</script>";
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "<script>window.alert('connection error');</script>";
}


        if(isset($_GET['doc_id'])) $doc_id = $_GET['doc_id'];
                    		
                    		

              try{
                	$gsql = "DELETE FROM doctors WHERE id=$doc_id "  ;
 					$gobj = $conn->query($gsql);



 					} //bairer try

 					catch(PDOException $ex){
 						echo $ex;
                    
                } //bairer catch


		?> 
								

