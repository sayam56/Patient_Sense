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
		if(isset($_GET['status'])) $status = $_GET['status'];



    try {
        $upd= "UPDATE approval SET status='$status' where doc_id='$doc_id' ";
        $up_obj = $conn->prepare($upd)->execute();
        

        ?>

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
                      
                      <tr style="border-bottom: 2px solid black; text-align:center; font-size: 20px; color: black;">


                        <td width="7%"><?php echo $count ?></td> 

                        
                        <td width="18%"><?php echo $k[2]." ".$k[3] ?></td>

                        <td width="18%"><?php echo $k[4] ?> </td>

                        <td width="13%"><?php echo $k[7] ?> </td>
                        <td width="10%"><?php echo $k[8] ?>tk </td>
                        <td width="14%"><?php echo $k[9] ?> </td>

                        <td width="20%">
                            <button class="btn btn-danger" >Delete</button>

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

        <?php
            
        

           

        
    } catch (PDOException $e) {
        echo $e;
    }


 
		?> 