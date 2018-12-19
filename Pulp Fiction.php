<?php
if (isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];
   date_default_timezone_set('asia/dhaka');
}

include("./db.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$name = $_SESSION['username'];


$sql = mysqli_query($connection, "SELECT * FROM movies  where movie_id = '$movie_id'");
$sql1 = mysqli_query($connection, "SELECT * FROM ticket  where movie_id = '$movie_id'");
$sql4 = mysqli_query($connection, "SELECT * FROM user  where name = '$name'");

$num_rows4 = mysqli_num_rows($sql4);
$num_rows = mysqli_num_rows($sql);
$num_rows1 = mysqli_num_rows($sql1);

$result = mysqli_fetch_array($sql);
$result1 = mysqli_fetch_array($sql1);
$result4 = mysqli_fetch_array($sql4);

$user_id = $result4['user_id'];

if ($_POST) {
    $tempdate =$result1['datetime'];
            $date2= date_create("$tempdate");
            //$date = new DateTime($date_expire);
            $date1 = new DateTime();
            //$date1= date_create("Y-m-d h:i:s");
             $diff=date_diff($date1,$date2);
            //echo $result1['datetime'];
             $tempdiff = $diff->format('%R%a days');
             
   // echo 'true';
            // echo gettype($tempdiff);
    $errors = array();


    if (empty($_POST['ticket_book'])) {


        $errors['ticket_book1'] = "Enter number of ticket";
    }
    if (($_POST['ticket_book']) > $result1['ticket_left']) {

        $errors['ticket_book2'] = "Can not book more than available ticket";
    }
    if ($tempdiff < 1)
    {
        $errors['ticket_book3'] = "Cannot book ticket moive is already shown need to book 1 day before";
    }
    $a = $_POST['ticket_book'];
    $user_id = $result4['user_id'];
    

    $c = $result1['ticket_left'] - $a;
    
    if (count($errors) == 0) {


        $ticket_id = $result1['ticket_id'];
        $sql2 = "UPDATE ticket SET ticket_left = '$c'  WHERE movie_id = '$movie_id' ";
        $sql3 = mysqli_query($connection, $sql2);
        $sql5 = "insert into invoice (ticket_id , user_id , ticket_amount , date_of_issue , payment_tick ) values('$ticket_id','$user_id','$a',now(),0)";
        $sql6 = mysqli_query($connection, $sql5) or die(mysqli_error($connection));
        $b = "/" . $result['name'] . ".php?movie_id=" . $movie_id;
        
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
        <script src = "./js/jquery.min.js"></script>
        <link href="./bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
         <style>
            .error_red
            {
                color : red ;
            }
        </style>
    </head>
    <body style=" background-color: #fff6e8"  > 
        <?php
       
        if ($_SESSION['admin_flag'] == 1) {
            include ("header1.php");
            include ("admin_nav1.php");
        }
        if ($_SESSION['user_flag'] == 1) {
            include ("header2.php");
            include ("user_nav1.php");
        }
        if ($_SESSION['user_flag'] == 0 && $_SESSION['admin_flag'] == 0) {
            include ("header.php");
        }
        ?>
        <div class="container">
            <h2> <?php 
            

            echo $result['name'] ?></h2>
        </div>
        <br>
        <br>
        <div class=" container pull-right col-sm-3">
            <img class="thumbnail" src="<?php echo $result['image']; ?>" width="240">
        </div>

        <div class="container">
            <h3 class="col-sm-9"> <?php
                $handle = fopen("" . $result['description'], 'r');
                while (!feof($handle)) {
                    echo fgets($handle, 1024);
                    echo '<br />';
                }
                fclose($handle);
                ?></h3>
            <h3 class="col-sm-8" style=" color: red"> Ratings :  <?php echo $result['rating'] ?> / 10 </h3>

            <h2 class="col-sm-6"> Tickets Available: <?php echo $result1['ticket_left'] ?> </h2>
            <h3 class="col-sm-6"> Tickets Price: <?php echo $result1['price'] ?>  BDT</h3>
            <h3 class="col-sm-6"> Time Table: <?php echo $result1['datetime'] ?>  </h3>
            <form action=# method = "post" class="form-horizontal"  target = "">
                <div class="card-body col-sm-6">


                    <div class="form-group text-left">
                        <br>
                        <label for="ticket_book">Ticket book</label>
                        <br>
                        <input type="text" class="form-control col-sm-2" name="ticket_book" >
                        <p class="error_red"><?php if (isset($errors['ticket_book1'])) echo $errors['ticket_book1']; ?></p> 
                        <p class="error_red"><?php if (isset($errors['ticket_book2'])) echo $errors['ticket_book2']; ?></p>
                        <p class="error_red"><?php if (isset($errors['ticket_book2'])) echo $errors['ticket_book2']; ?></p>
                        <br>
                        <br>
                        <input class="btn btn-info" type="submit" name="    book" value="Book"> 
                    </div>   
                </div> 
        </div>


    </body>
</html>