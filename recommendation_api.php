

<?php
//uri POST http://127.0.0.1/patient_sense/recommendation_api.php
if($_SERVER['REQUEST_METHOD']=="POST"){
	///setting necessary CORS headers
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $jsonstring=file_get_contents("php://input");
	
	$phparray=json_decode($jsonstring,true);

	if(isset($phparray['entity'])){
		///receiving the parameter value
        $entity=$phparray['entity'];
        $location=$phparray['location'];
        $username=$phparray['username'];
        $price=$phparray['price'];
        foreach($entity as $key) {
           $symptom[]=$key['entity'] ;
        
        
          }
          

          try{
            $conn=new PDO("mysql:host=localhost;dbname=patient_sense;",'root',''); 
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
          catch(PDOException $ex)
          {
            http_response_code(503);
    
            echo json_encode(array("message"=>"database error"));
          }

          try{
              $department=$symptom[0];

            $sqlquery="SELECT * FROM `doctors` WHERE department='$department' AND location='$location' AND price<=$price";
            echo $sqlquery;
            $pdostmt=$conn->query($sqlquery);
			if($pdostmt->rowCount()>0){
                $table=$pdostmt->fetchAll();
               

				//http_response_code(200);
				echo json_encode(array("department"=>$table[0][2]));
			}
			else{
				///no data found for the given id value
				http_response_code(400);
				
				echo json_encode(array("message"=>"Doctor nai"));
            }
        }



          
          catch(PDOException $ex){
            ///database or query error
            http_response_code(503);
    
            echo json_encode(array("message"=>"query error"));
        }
         
      
      
    }
    else
    {
        echo json_encode(array("message"=>"hoy nai"));
    }
}
        ?>
