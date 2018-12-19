<?php
include("db.php");

if (isset($_GET['id'])) {
    $movie_id = $_GET['id'];
}
$sql = mysqli_query($connection, "SELECT * FROM movies  where movie_id = '$movie_id'");
$num_rows = mysqli_num_rows($sql);
$result = mysqli_fetch_array($sql);

if ($_POST) {


    $errors = array();

    if (empty($_POST['total_ticket'])) {
        //echo "2";

        $errors['total_ticket'] = "Movie name cannot be empty";
    }


    if (empty($_POST['price'])) {//echo "7";
        $errors['price'] = "ratings cannot be empty";
    }
    if (empty($_POST['datetime'])) {
        $errors['datetime'] = "Time table cannot be empty";
    }





    if (count($errors) == 0) {
        //echo $_POST['name'];
        
       
        


        $total_ticket = mysqli_real_escape_string($connection, $_POST['total_ticket']);
        $ticket_left= $total_ticket;
        $price = mysqli_real_escape_string($connection, $_POST['price']);
        $a=$_POST['datetime'];


//echo "18";


        $sql = "insert into ticket  (movie_id,ticket_total,ticket_left,price,datetime) values  ('$movie_id','$total_ticket','$ticket_left','$price','$a')";
    

        if (mysqli_query($connection, $sql)) {
            //          echo "23";    
            //header("Location:movie_library.php");
        } else {
            //			echo "24";
            //echo "ERROR: Could not able to execute $sql. " . 
            echo mysqli_error($connection);
        }


        mysqli_close($connection);
        //header("Location: success.php");
    }
}
?>


<!doctype html>
<html>
    <head>
        <title>application</title>
        <link rel="stylesheet" href="./css/mystyle.css">
        <style>
            .error_red
	{
		color : red ;
	}
            </style>
    </head>
    <body style = "margin : 0px 0px 0px 0px"  >

        <div>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include ("header1.php");
?>
        </div>
        <div>
            <?php include ("admin_nav1.php"); ?>
        </div>
        <div class="container">
            <form action=# method = "post" class="form-horizontal"  target = "" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title text-center">Adding ticket for movie : <?php echo $result['name'];?></h4>



                    <div class="form-group text-left">
                        <label for="total_ticket">Total ticket</label>
                        <input type="text" class="form-control" name="total_ticket" value ="<?php if (isset($_POST['total_ticket'])) echo $_POST['total_ticket']; ?>" placeholder="Total ticket"> 
                        <p class="error_red" ><?php if (isset($errors['total_ticket'])) echo $errors['total_ticket']; ?></p>   
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" value ="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>" placeholder="price">
                        <p class="error_red"><?php if (isset($errors['price'])) echo $errors['price']; ?></p>   
                        <label for="datetime">time table</label>
                      
                        <input type="datetime-local"  class="form-control" name="datetime">
                        <p class="error_red"><?php if (isset($errors['datetime'])) echo $errors['datetime']; ?></p>  


                    </div>

                    <input type="submit" name="go" value = "submit">	
                </div>

            </form>
        </div>

    </body>
</html>