<?php
	if (session_status() != PHP_SESSION_NONE) {
    session_unset();
	}

	include("db.php");
	if($_POST)
	{
		$errors = array();
		
		if(empty($_POST['username']))
		{
			
			$errors['username'] = "Enter Username";
		
		}
		if(empty($_POST['password']))
		{;
			$errors['pass1'] = "Enter Password";
			
		}
		
		if(count($errors) == 0 )
		{
			
			$name=mysqli_real_escape_string($connection,$_POST['username']);
			$password=mysqli_real_escape_string($connection,$_POST['password']);
			$sql = "select * from user where name ='$name' and password='$password'";
                if($result=(mysqli_query($connection, $sql)))
                {
					
                    if(mysqli_num_rows($result)>0)
                    {
						session_start();
						$_SESSION['POST'] = $_POST;
						
						$row=mysqli_fetch_array($result);
						//print_r( $row );
						if($row['admin_status']==1)
						{
							session_start();
							$_SESSION['username'] = $_POST['username'];
                                                        $_SESSION['admin_flag'] = 1;
                                                        $_SESSION['user_flag'] = 0;
							header("Location:admin_panel.php");
						}
						if($row['admin_status']==0)
							
						{
							session_start();
							$_SESSION['username'] = $_POST['username'];
							$_SESSION['admin_flag'] = 0;
                                                        $_SESSION['user_flag'] = 1;
							header("Location:user_panel.php");
						}
						
						
					}
					
					else 
					{
						$errors['nomatch'] = "Incorrect Username and Password";
						
					}
				}	
                   
                    
                else
                {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
                }
 

                mysqli_close($connection);
			
		}
		
	}




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
   <script src = "./js/jquery.min.js"></script>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
         <style>
            .error_red
	{
		color : red ;
	}
            </style>
  </head>
  <body>
      <?php include("header.php") ?>
      <div class="container">
           <form action=# method = "post" class="form-horizontal"  target = "">
            <div class="card-body">
			<h4 class="card-title text-center">Login page</h4>
			
            <div class="form-group text-left">
              <label for="username">Username</label>
			  
			 <input class="form-control" placeholder="Login name" type="text" name="username"/>
			 <p class="error_red"><?php if(isset($errors['username'])) echo $errors['username']; ?></p>
			 </div>
			 
			 
			<div class="form-group text-left">
			  <label for="Password">Password</label>
			  <input class="form-control" placeholder="Password" type="password" name="password"/>
			<p class="error_red"><?php if(isset($errors['pass1'])) echo $errors['pass1']; ?></p> 
			<p class="error_red"><?php if(isset($errors['nomatch'])) echo $errors['nomatch']; ?></p>
			</div>
			
			<input type="submit" name="go" value="Submit" class="btn btn-default"></input>
            
			</div>
               </form>
      </div>
      
  </body>