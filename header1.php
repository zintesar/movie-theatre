<!doctype html>
<html>
    <head>
        <title> </title>


        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <link rel="stylesheet" href="css/bootstrap.css" >
        <!--<link rel="stylesheet" href="customStyle.css">
        <link rel="stylesheet" href="./css/mystyle.css">
        <link href='https://fonts.googleapis.com/css?family=Lily Script One'rel='stylesheet'>
        
        <link rel="stylesheet" href="./bootstrap-3.3.7-dist/bootstrap.css"> 
        <link rel="stylesheet" href="./css/foundation.css">-->
        <script src = "./js/jquery.min.js"></script>
        <script src = "./js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="./css/a.css">
       <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
       <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>



    </head>
    <body>
        <?php
        
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }?>
        <header>
            <div class="container-fluid" style="background-color: #342206; padding-bottom: 20px; padding-top: 20px;">
                <div class="container">

                    <div id="status-holder" class="pull-left">


                    </div>

                    <div class="pull-right" id="status-holder" >
                        <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_SESSION['username'] ?> <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="admin_panel.php">admin page</a></li>
                                <li><a href="logout.php">logout</a></li>
                                
                            </ul>
                        </div>
      
                        

                    </div>
                    <div class="logo container">
                        <a href="index.php"> <img src="./images/logo.png"></a>
                    </div>

                </div> 
            </div>
        </header>


    </body>	

