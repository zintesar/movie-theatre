
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
    <?php include('header1.php');?>


</div>
<div>
<?php include ("admin_nav1.php"); 
         include ("db.php");?>
	
</div>	
<div><h3 align="center">Movie library </h3></div>
<div class = "container">

<br>
    <!--<form  action="" method="POST" class="form-horizontal" >
                <div class="card-body">
                <div class="form-group text-center">
                            <b>Search By movie name </b><br>
                            <input class="form-control"  type="text" name="searchid">
                   <br>
               <br><input type="submit" class="btn btn-info" name="Search" value="Search" >
    </form>
</div>
        </div>
</div>-->
<?php
/*
     
    include("db.php");
	
   if (isset($_POST['Search'])) 
 {
	 
        if($_POST)                         
        {  
			$searchid =mysqli_real_escape_string($connection,$_POST['searchid']);
			
            if(!empty($_POST['searchid'])){
                $select = mysqli_query($connection, "SELECT * from movies where name='$searchid'");
			}
            else{
                $select = mysqli_query($connection, "SELECT * from movies ");
            }
            
        }
		else
		{
			echo mysqli_error($connection);
		}
		
   }
    
               
	if(!$_POST)*/         
   {
	    $select = mysqli_query($connection, "select invoice.invoice_id , movies.name AS movie_name , user.name , invoice.ticket_amount , ticket.price , invoice.ticket_amount * ticket.price AS total_price , invoice.date_of_issue , ticket.datetime , invoice.payment_tick from invoice join movies join ticket JOIN user on invoice.ticket_id = ticket.ticket_id && movies.movie_id = ticket.ticket_id && invoice.user_id = user.user_id");
   }
  $num_row = mysqli_num_rows($select);
 
 if( $num_row > 0) 
 {
?>
<div class="container">
    <table class="table table-striped">
          <tr>
              <th>invoice_id</th>
              <th>movie_name</th>
              <th>user name</th>
              <th>ticket_amount</th>
              <th>price</th>
              <th>total price</th>
              <th>date of issue</th>
              <th>time table </th>
               <th>payment status</th>
          </tr>
          <?php while( $userrow = mysqli_fetch_array($select) ) {
             // print_r($userrow);?>
          <tr>
              <td><?php echo $userrow['invoice_id']; ?></td>
              <td><?php echo $userrow['movie_name']; ?></td>
              <td> <img src=""><?php echo $userrow['name']; ?></td>
              <td><?php echo $userrow['ticket_amount']; ?> </td>
                <td><?php echo $userrow['price']; ?> BDT</td>
               <td><?php echo $userrow['total_price']; ?> BDT</td>
                <td><?php echo $userrow['date_of_issue']; ?></td>
                <td><?php echo $userrow['datetime']; ?></td>
                 <td><?php if($userrow['payment_tick']==1)
						{	
							echo "yes";
						}
						else 
						{
							echo"no";
						}   ?>             
              <td>
                  <a class="btn btn-info"  href="accept_payment.php?id=<?php echo $userrow['invoice_id']; ?>"> accept payment </a>  						
                <a class="btn btn-info"  href="cancel_invoice.php?id=<?php echo $userrow['invoice_id']; ?>" onclick="return confirm('Are you sure you wish to delete this Record?');">
                      <span class="delete" title="Delete"> cancel ticket</span>
                  </a>
              </td>
          </tr>
          <?php } ?>
      </table>
<?php } ?>
        
 </div>
</body>