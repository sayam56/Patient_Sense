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

if(isset($_GET['username']))
{
    $username=$_GET['username'];
    try{

        $sqlquery="SELECT * FROM `appointment` WHERE username='$username' ";
        $pdostmt=$conn->query($sqlquery);
        if($pdostmt->rowCount()>0){
            $table=$pdostmt->fetchAll();

            foreach($table as $key)
            {
                $doc_name="SELECT f_name FROM `doctors` WHERE id='$key[0]' ";
        $pdostmt=$conn->query($doc_name);
        if($pdostmt->rowCount()>0){
            $table1=$pdostmt->fetchAll();
            foreach($table1 as $key1)
            {
                $doc=$key1[0];
            }
        }

                //var_dump($key);
                ?>
                

                <div class="appointment_list_item">
                    <p>Dr.<?php echo $doc?> <br><?php echo $key[3]?> on <?php echo $key[2]?></p>
                </div>
                <?php
            }
        }
        else
        {
            ?>
            
            <div class="appointment_list_item">
                    <h3>No appointments</h3>
                </div>
            <?php
            
        }

    }

    catch(PDOException $ex){
        ///database or query error
        http_response_code(503);

        echo ("query error");
}
}


?>

