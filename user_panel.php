<!doctype html>
<html>
    <head>
        <title> </title>

           <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>

        <style>



        </style>

    </head>

    <body style=" background-color: #fff6e8"   >

        
            

        

	
        <?php
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            //print_r($_SESSION);
            
        }
       include ("header2.php");
       include ("user_nav1.php" );
        ?>
        <div class=" container ">   
            <h1 align = center> Welcome <?php echo $_SESSION['username'] ?> </h1>
            <h2 align = center> You are logged in as user </h2>
        </div>>




    </body>
</html>

