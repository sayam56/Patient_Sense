<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
   <a href="logout.php">logout</a> 
   


    <?php
    session_start();
    if(isset($_SESSION['username']))
    {
        ?>
        <h1>The recommendation Bot will be implemented here </h1>
        <?php
    }
    else
    {
        ?>
        <h1>I am not logged in</h1>
        <?php
    }
    
    
    ?>
</body>
</html>