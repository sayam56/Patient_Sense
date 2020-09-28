<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Sense</title>
    <link rel="icon" href="res/logo.ico">
    <link rel="stylesheet" href="css/style.css">
</head>


<body>

<div class="outerbox">
    <div class="get__started">
    <img class="logo" src="res/logo.png" alt="none">
    <h1>Get Started</h1>
    <div class="buttons">
    <button>Sign in with Google</button><br>
    <button>Sign in with Facebook</button>
    </div>



    
    </div>
    <div class="login">
        <!-- <a href="signup.php"><button>Register</button></a> -->
        
    <form method="POST">   
        <h1 style="margin-top: -35px">Log In</h1>
    
    <p>Username</p>
    <input type="text" name="username" id="user">
    <p>Password</p>
    <input type="password" name="password"><br>
    <p>Sign In As:</p>
        <input type="radio" name="role"  value="user" checked> Regular User
        <input type="radio" name="role"  value="doctor"> Doctor 
    <input type="submit" name="signin" id="sign_in_button" value="Sign In"><br>

    <div class="links">
    <a href="password_recover.php" id="forgot">Forgot Password</a>
    <a href="signup.php">Not a member yet?</a>
    </div>
</form>
    
    
    
    
    </div>

</div>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
    if(isset($_POST['signin']))
    {
        $signin=$_POST['signin'];
        
        if($signin=="Sign In")       //determining if you are loging in as user 
        {
        
    $username=$password="";
    if(isset($_POST['username']))
        $username=$_POST['username'];
    if(isset($_POST['password']))
        $password=sha1($_POST['password']);
    if(isset($_POST['role']))
            $role = $_POST['role'];


    try{
            $conn=new PDO("mysql:host=localhost;dbname=patient_sense;",'root','');
            echo "<script>console.log('connection successful');</script>";
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "<script>window.alert('connection error');</script>";
        }


        if ($role == 'user') {

            try{
                $query="SELECT * from users WHERE username='".$username."' AND pass='".$password."'" ;
                $object=$conn->query($query);
                if($object->rowCount()==1)
                {
                    
                    $table=$object->fetchAll();
                    
                        session_start();
                        $_SESSION['username']=$table[0][0];
                        header('LOCATION:userdash.php');
                }
                else
                {
                    echo "<script>window.alert('Wrong username or password')</script>";
                }
            }
            catch(PDOException $e){
               
                echo "<script>window.alert('Error!!')</script>";
            }
            
        }
        elseif ($role == 'doctor') {
            try{
                $query="SELECT * from doctors WHERE username='".$username."' AND pass='".$password."'" ;
                $object=$conn->query($query);
                if($object->rowCount()==1)
                {
                    
                    $table=$object->fetchAll();
                    
                        session_start();
                        $_SESSION['fname']=$table[0][2];
                        $_SESSION['lname']=$table[0][3];
                        $_SESSION['doc_id']=$table[0][0];
                        header('LOCATION:doctor.php');
                }
                else
                {
                    echo "<script>window.alert('Wrong username or password')</script>";
                }
            }
            catch(PDOException $e){
               
                echo "<script>window.alert('Error!!')</script>";
            }
        }

         





    }

    else{
        $username=$password="";        // you are loging in as admin 
        if(isset($_POST['username']))
            $username=$_POST['username'];
        if(isset($_POST['password']))
            $password=sha1($_POST['password']);
    
    
        try{
                $conn=new PDO("mysql:host=localhost;dbname=patient_sense;",'root','');
                echo "<script>console.log('connection successful');</script>";
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "<script>window.alert('connection error');</script>";
            }
    
    
    
             try{
                $query="SELECT * from administrator WHERE username='".$username."' AND pass='".$password."'" ;
                $object=$conn->query($query);
                if($object->rowCount()==1)
                {
                    $table=$object->fetchAll();
                        session_start();
                        $_SESSION['username']=$table[0][0];
                        ?>
                        <script type="text/javascript">
                            location.assign("adminpanel.php");            			</script>
                            
                            
                                        <?php
                }
                else
            {
                echo "<script>window.alert('Wrong username or password')</script>";
            }
            }
            catch(PDOException $e){
                echo "<script>window.alert('Login unsuccessful');</script>";
            }
    }
}

}





?>

<script type="text/javascript" src="adminlogincheck.js"></script>

    
</body>
</html>