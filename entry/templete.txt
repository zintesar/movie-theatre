<?php

if(isset($_GET['movie_id']))
	{
		$movie_id=$_GET['movie_id'];
		
	}

include("../db.php");
$sql = mysqli_query($connection, "SELECT * FROM movies  where movie_id = '$movie_id'");
$sql1 = mysqli_query($connection, "SELECT * FROM ticket  where movie_id = '$movie_id'");

$num_rows = mysqli_num_rows($sql);
$num_rows1 = mysqli_num_rows($sql1);

$result = mysqli_fetch_array($sql);
$result1 = mysqli_fetch_array($sql1);

print_r($result);
print_r($result1);
if($_POST)
	{
    echo 1;
		$errors = array();
		    echo 2;

		if(empty($_POST['ticket_book']))
		{
			    echo 3;

			$errors['ticket_book1'] = "Enter number of ticket";
		    echo 4;

		}
		if(($_POST['ticket_book']) > $result1['ticket_left'] )
		{     echo 5;

			$errors['ticket_book2'] = "Can not book more than available ticket";
			    echo 6;

		}
		$a = $_POST['ticket_book'];
                echo "<br>";
                echo  $a;
                echo "<br>";
                    echo 7;
                    $a = $result1['ticket_left'] - $a;
                    echo $a;
		if(count($errors) == 0 )
		{
			    echo 8;

			
			$sql2 = "UPDATE ticket SET ticket_left = '$a'  WHERE movie_id = '$movie_id' ";
                        $sql3 = mysqli_query($connection, $sql2);
                        
                        $b = "./".$result['name'].".php?movie_id=".$movie_id;  
                        echo $b;
                        header('Location:' . $b);
                       // header('Location: .'.$result['name'].'.php?movie_id='.$movie_id');
                }
        }
        ?>	


<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src = "../js/jquery.min.js"></script>
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    </head>
    <body> 
        <?php include ("../header.php"); ?>
        <div class="container">
		<h2> <?php echo $result['name'] ?></h2>
        </div>
        <br>
        <br>
       <div class=" container pull-right col-sm-3">
            <img class="thumbnail" src=".<?php echo $result['image']; ?>" width="240">
        </div>
        
        <div class="container">
            <h3 class="col-sm-9"> <?php
                                    $handle = fopen(".".$result['description'], 'r');
                                    while (!feof($handle)) {
                                        echo fgets($handle, 1024);
                                        echo '<br />';
                                    }
                                    fclose($handle);
                                    ?></h3>
             <h3 class="col-sm-8" style=" color: red"> Ratings :  <?php echo $result['rating'] ?> / 10 </h3>
             
             <h2 class="col-sm-6"> Tickets Available: <?php echo $result1['ticket_left']?> </h2>
             
            <form action=# method = "post" class="form-horizontal"  target = "">
            <div class="card-body col-sm-6">
			
            <div class="form-group text-left">
                <br>
                <label for="ticket_book">Ticket book</label>
                <br>
                <input type="text" class="form-control col-sm-2" name="ticket_book" >
                <p class="error_red"><?php if(isset($errors['ticket_book1'])) echo $errors['ticket_book1']; ?></p> 
		<p class="error_red"><?php if(isset($errors['ticket_book2'])) echo $errors['ticket_book2']; ?></p>
                <br>
                <br>
                <input class="btn btn-info" type="submit" name="    book" value="Book"> 
             </div>   
            </div> 
                </div>
        
          
    </body>
</html>