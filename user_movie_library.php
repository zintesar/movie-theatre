
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
<?php include ("user_nav1.php"); ?>
	
</div>	
<div><h3 align="center">Movie library </h3></div>
<div class = "container">

<br>
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
    
               
	if(!$_POST)         
   {
	    $select = mysqli_query($connection, "SELECT * from movies");
   }
  $num_row = mysqli_num_rows($select);
   
 if( $num_row > 0) 
 {
?>
<div class="container">
    <table class="table table-striped">
          <tr>
              <th>ID</th>
              <th>movie name</th>
              <th>description</th>
              <th>image</th>
              <th>ratings </th>
          
              <th>Action</th>
          </tr>
          <?php while( $userrow = mysqli_fetch_array($select) ) { ?>
          <tr>
              <td><?php echo $userrow['movie_id']; ?></td>
              <td><?php echo $userrow['name']; ?></td>
              <td> <img src=""><?php echo $userrow['description']; ?></td>
              <td><img src="<?php echo $userrow['image']; ?> " width="120"</td>
              <td><?php echo $userrow['rating']; echo" / 10";?></td>
              
              <td>
                  <?php$a="./".$userrow['name'].".php?movie_id=".$userrow['movie_id'];
                  echo $a;?>
                  <a class="btn btn-info" href="./<?php echo $userrow['name'] ?>.php?movie_id=<?php echo $userrow['movie_id'] ; ?>">go to</a>
              
              </td>
          </tr>
          <?php } ?>
      </table>
<?php } ?>
        
 </div>
</body>