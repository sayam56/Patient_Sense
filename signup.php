<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Patient Sense</title>
    <link rel="icon" href="res/logo.ico">
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
<div class="outerbox">
    <div class="get__started">
        <div class="get__startedContent">
    <img src="res/logo.png" alt="none">
    <h1>Get Started</h1>
    <div class="buttons">
    <button>Sign up with Google</button><br>
    <button>Sign up with Facebook</button>
    </div>



    </div>
    </div>

    <div class="login">
  
    <a href = "login.php" >←</a>
    <form method="POST">
    <h1>Sign Up</h1>
        <p>Username</p>
        <input type="text" name="username">
        <p>First Name</p>
        <input type="text" name="first_name">
        <p>Last Name</p>
        <input type="text" name="last_name">
        <p>Email</p>
        <input type="email" name="email">
        <p>Password</p>
        <input type="text">
        <p>Confirm pasword</p>
        <input type="text" name="pass"><br>
        <input type="submit" value="Register">
    </form>
    </div>
    <!-- database connection and data entry -->

    <?php
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$username=$first_name=$last_name=$email=$pass="";
		if(isset($_POST['username']))
			$username=$_POST['username'];
		if(isset($_POST['first_name']))
            $first_name=$_POST['first_name'];
            if(isset($_POST['last_name']))
			$last_name=$_POST['last_name'];
		if(isset($_POST['email']))
			$email=$_POST['email'];
		if(isset($_POST['pass']))
			$pass=sha1( $_POST['pass']);

		try{
                $conn=new PDO("mysql:host=localhost;dbname=patient_sense;",'root','');
                echo "<script>console.log('connection successful');</script>";
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "<script>window.alert('connection error');</script>";
            }



            try{
            	$query="INSERT INTO users VALUES('$username','$first_name','$last_name','$email','$pass')";
            	$conn->exec($query);
            	echo "<script>location.assign('login.php')</script>";


            }
            catch(PDOException $e){
                echo "<script>window.alert('insertion error');</script>";
            }



	}



 ?>
</body>
</html>