
<head>
    <!--<link rel="stylesheet" href="./css/mystyle.css">
    <link rel="stylesheet" href="./css/foundation.css">-->
    <link rel="stylesheet" href="./css/bootstrap.min.css"> 
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src = "./js/jquery.min.js"></script>
    <script src = "./js/bootstrap.min.js"></script>
    <style>


    </style>

</head>
<body>
    <div>
        <?php include('header1.php'); ?>


    </div>
    <div>
        <?php include ("admin_nav1.php"); ?>

    </div>	
    <div><h3 align="center">Movie </h3></div>
    <div class = "container">


        <form  action="" method="POST" class="form-horizontal" >
            <div class="card-body">
                <div class="form-group text-center">
                    <b>Search By movie name </b><br>
                    <input class="form-control"  type="text" name="searchid">
                    <br>
                    <br><input type="submit" class="btn btn-info" name="Search" value="Search" >
                    </form>
                </div>
            </div>
    </div>
    <?php
    include("db.php");

    if (isset($_POST['Search'])) {

        if ($_POST) {
            $searchid = mysqli_real_escape_string($connection, $_POST['searchid']);

            if (!empty($_POST['searchid'])) {
                // $select1=mysqli_query($connection, "SELECT * from movies where name = '$searchid'");
                // echo "1";
                // $num_row1 = mysqli_num_rows($select1);
                // echo "2";
                // $userrow1 = mysqli_fetch_array($select1);
                //echo "3";
                //$mid=$userrow1['movie_id'];
                // echo "4";
                $name = mysqli_real_escape_string($connection, $_POST['searchid']);
                $select = mysqli_query($connection, "SELECT movies.movie_id, movies.name , ticket.ticket_id , ticket.ticket_total , ticket.ticket_left ,ticket.price,ticket.datetime from movies JOIN ticket ON movies.movie_id=ticket.movie_id where movies.name = '$name' ORDER BY `ticket_id` ASC") or die(mysqli_error($connection));
            } else {
                $select = mysqli_query($connection, "SELECT movies.movie_id, movies.name , ticket.ticket_id , ticket.ticket_total , ticket.ticket_left ,ticket.price,ticket.datetime from movies JOIN ticket ON movies.movie_id=ticket.movie_id ORDER BY `ticket_id` ASC") or die(mysqli_error($connection));
            }
        } else {
            echo mysqli_error($connection);
        }
    }


    if (!$_POST) {
                $select = mysqli_query($connection, "SELECT movies.movie_id, movies.name , ticket.ticket_id , ticket.ticket_total , ticket.ticket_left ,ticket.price,ticket.datetime from movies JOIN ticket ON movies.movie_id=ticket.movie_id ORDER BY ticket.ticket_id ASC");
    }
    $num_row = mysqli_num_rows($select);

    if ($num_row > 0) {
        ?>
        <div class="container">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Movie name</th>
                    <th>Ticket total</th>
                    <th>Ticket_left</th>
                    <th>Price </th>
                    <th>Time table </th>
                    <th>Action</th>
                </tr>
    <?php while ($userrow = mysqli_fetch_array($select)) { ?>
                    <tr>
                        <td><?php echo $userrow['movie_id']; ?></td>
                        <td><?php echo $userrow['name']; ?></td>
                        <td> <?php echo $userrow['ticket_total']; ?></td>
                        <td><?php echo $userrow['ticket_left']; ?> </td>
                        <td><?php echo $userrow['price']; ?> </td>     
                        <td><?php echo $userrow['datetime']; ?> </td>
                        <td>
                            <a class="btn btn-info"  href="add_ticket.php?id=<?php echo $userrow['movie_id']; ?>"> add ticket </a>  
                            <a class="btn btn-info"  href="edit_ticket.php?id=<?php echo $userrow['movie_id']; ?>"> edit ticket </a> 							
                            <a class="btn btn-info"  href="delete_ticket.php?id=<?php echo $userrow['movie_id']; ?>" onclick="return confirm('Are you sure you wish to delete this Record?');">
                                <span class="delete" title="Delete"> Delete</span>
                            </a>
                        </td>
                    </tr>
    <?php } ?>
            </table>
<?php } ?>

    </div>
</body>