<?php
include("db.php");
//$sql = mysqli_query($connection, "SELECT * FROM ticket JOIN movies on ticket.movie_id=movies.movie_id");
$sql = mysqli_query($connection, "SELECT * FROM ticket JOIN movies on ticket.movie_id=movies.movie_id");
$sql1 = mysqli_query($connection, "SELECT * FROM ticket JOIN movies on ticket.movie_id=movies.movie_id ORDER BY `ticket`.`ticket_id` DESC");

/* while($result=mysqli_fetch_array($sql))
  {
  print_r($result);
  }
 */
$num_rows = mysqli_num_rows($sql);
$num_rows1 =mysqli_num_rows($sql1);
if (session_status() == PHP_SESSION_NONE) {
                session_start();
                if (!isset($_SESSION['admin_flag']) )
                {
                    $_SESSION['admin_flag'];
                }
                if (!isset($_SESSION['user_flag']) )
                {
                    $_SESSION['user_flag'];
                }
                
               
                    
    
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src = "./js/jquery.min.js"></script>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <!--<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
         Bootstrap CSS -->
        <script>
            $(document).ready((function () {
                $('.carousel-showmanymoveone .item').each(function () {
                    var itemToClone = $(this);
                    $('#carousel-tilenav').carousel({
                        interval: 2000
                    });
                    for (var i = 1; i < 6; i++) {
                        itemToClone = itemToClone.next();

                        // wrap around if at end of item collection
                        if (!itemToClone.length) {
                            itemToClone = $(this).siblings(':first');
                        }

                        // grab item, clone, add marker class, add to collection
                        itemToClone.children(':first-child').clone()
                                .addClass("cloneditem-" + (i))
                                .appendTo($(this));
                    }
                });
            }));

        </script>
    </head>
    <body style=" background-color: #fff6e8">
        <?php
        
           // if (session_status() == PHP_SESSION_NONE) {
             //   session_start();
               {
                 if($_SESSION['admin_flag'] == 1 )
    {
        include ("header1.php");
        include ("admin_nav1.php");
    }
    if($_SESSION['user_flag'] == 1 )
    {
        include ("header2.php");
        include ("user_nav1.php");
    }
     if($_SESSION['user_flag'] == 0 && $_SESSION['admin_flag'] == 0  )
{include ("header.php"); } 
}
   

    


                //include ("nav.php");
               // print_r($_SESSION);
        ?>
        
        <?php 
        if ($num_rows1 > 0) {
                    while ($result1 = mysqli_fetch_array($sql1))
                    {
                        $images[] = $result1['image'];
                        $links[] = "./".$result1['name'].".php?movie_id=".$result1['movie_id'];
                        
                    }
        }
        ?>
       <?php // print_r($links)?>
        <div>
            <div class="container">
                <div class="container">

                    <h1 class="text-center">Welcome to Movie Zip</h1>
                    <br>
                    <br>



                    <div class="row" style=" background-color: #030d1e">
                        <div class="col-md-12">
                            <div class="carousel carousel-showmanymoveone slide" id="carousel-tilenav" data-interval="false">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="<?php echo $links[0];?>"><img src="<?php echo $images[0]; ?>" class="img-responsive " ></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="<?php echo $links[0];?>"><img src="<?php echo $images[1]; ?>" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="<?php echo $links[2];?>"><img src="<?php echo $images[2]; ?>" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="<?php echo $links[3];?>"><img src="<?php echo $images[3]; ?>" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="<?php echo $links[4];?>"><img src="<?php echo $images[4]; ?>" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="<?php echo $links[5];?>"><img src="<?php echo $images[5]; ?>" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="<?php echo $links[6];?>"><img src="<?php echo $images[6]; ?>" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="<?php echo $links[8];?>"><img src="<?php echo $images[7]; ?>" class="img-responsive"></a>
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-tilenav" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                <a class="right carousel-control" href="#carousel-tilenav" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div> 
        <br>
        <br>
        
        
        <div class="container ">
            <div class="container pull-left col-md-12 ">

                <?php
                
                if ($num_rows > 0) {
                    while ($result = mysqli_fetch_array($sql)) {
                        
                        //print_r($result);
                        ?>
                        <div class="col-sm-12" style = "">
                            <div class="col-sm-2">
                                <img class="thumbnail" src="<?php echo $result['image'] ?>" width="140">
                            </div>
                            <div class="col-sm-9">  
                                <h3> <?php echo $result['name']; ?> </h3>

                                <h4> <?php
                                    $handle = fopen($result['description'], 'r');
                                    while (!feof($handle)) {
                                        echo fgets($handle, 1024);
                                        echo '<br />';
                                    }
                                    fclose($handle);
                                    ?> </h4>
                                <h4> Ratings : <?php echo $result['rating']; ?> / 10</h4>
                                <div class="pull-right">
                                    <a class="btn btn-info" href="./<?php echo $result['name'] ?>.php?movie_id=<?php echo $result['movie_id'] ; ?>">see more</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>


        </div>

    </body>
</html>