<!doctype html>
<html>
    <head>
        <title> </title>

        

        <style>



        </style>

    </head>

    <body style=" background-color: #fff6e8"  >

        
            

        

	
        <?php
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            
        }
       include ("header1.php");
       include ("admin_nav1.php");
        ?>
        <div class=" container ">   
            <h1 align = center> Welcome <?php echo $_SESSION['username'] ?> </h1>
            <h2 align = center> You are logged in as admin </h2>
        </div>>




    </body>
</html>

