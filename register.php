<?php
include("db.php");
if ($_POST) {

    $errors = array();
    if (empty($_POST['name'])) {
        $errors['Name1'] = "Your name cannot be empty";
    }
    if (strlen($_POST['name']) < 2) {
        $errors['Name2'] = "Your name must be atleast 2 characters long";
    }
    if (empty($_POST['password'])) {
        $errors['password1'] = "Your password cannot be empty";
    }
    if (strlen($_POST['password']) < 4) {
        $errors['password2'] = "Your password must be atleast 4 characters long";
    }

    if (empty($_POST['email'])) {
        $errors['email1'] = "Email cannot be empty";
    }
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
    if (preg_match($pattern, $_POST['email']) == false) {
        $errors['email2'] = "Invalid Email";
    }
    if ($_POST['password'] != $_POST['confirm_password'])
    {
         $errors['password3'] = "Passwords dont match";
    }

    /* if(!isset($_POST['birth_day']))
      {
      $errors['birthday'] = "Date of birth can not be empty";

      } */






    if (count($errors) == 0) {
        //redirect to success pages
        //header("Location: insert.php");
        //exit();
        // if(isset($_POST['go']) != "" ) {echo  "11" ;	

        $name = mysqli_real_escape_string($connection, $_POST['name']);

        $email = mysqli_real_escape_string($connection, $_POST['email']);


        $password = mysqli_real_escape_string($connection, $_POST['password']);










        $sql = "INSERT INTO user (name,email,password,admin_status)VALUES('$name','$email','$password','$admin_status')";


        if (mysqli_query($connection, $sql)) {

            session_start();
            $_SESSION['POST'] = $_POST;

            header("Location: index.php");
        } else {
            //echo "ERROR: Could not able to execute $sql. " . 
            echo mysqli_error($connection);
        }


        mysqli_close($connection);
        //header("Location: success.php");
        exit();
    }
}
?>


<!doctype html>
<html>
    <head>
        <title>application</title>
        <style>
            .error_red
	{
		color : red ;
	}
        </style>

    </head>
    <body style = "margin : 0px 0px 0px 0px"  >

        <div>
<?php include ("header.php"); ?>
        </div>

        <div class="container">
             <form action=# method = "post" class="form-horizontal"  target = "">
            <div class="card-body">
	<h4 class="card-title text-center">Registration page</h4>
			
            <div class="form-group text-left">
                           
                            <label for="name">Username</label>
                            <input class="form-control" type="text" name="name"  value ="<?php if (isset($_POST['name'])) echo $_POST['name']; ?> "> 
                            <p class="error_red" ><?php if (isset($errors['Name1'])) echo $errors['Name1']; ?></p>   
                            <p class="error_red"><?php if (isset($errors['Name2'])) echo $errors['Name2']; ?></p>
                            <label for="email">Email</label>
                            <input class="form-control" type="text"  name="email"   value ="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                            <p class="error_red"><?php if (isset($errors['email1'])) echo $errors['email1']; ?></p>   
                            <p class="error_red"><?php if (isset($errors['email2'])) echo $errors['email2']; ?></p>

                           <label for="password">Password</label>
                           <input  class="form-control" type="password" name="password"  value =""> 
                            <p class="error_red"><?php if (isset($errors['password1'])) echo $errors['password1']; ?></p>    
                            <p class="error_red"><?php if (isset($errors['password2'])) echo $errors['password2']; ?></p>  
                           <label for="password">Confirm Password</label>
                           <input  class="form-control" type="password" name="confirm_password"  value =""> 
                           <p class="error_red"><?php if (isset($errors['password3'])) echo $errors['password3']; ?></p>  
                           <br>
                           <br>
                           <input class="btn btn-default    " type="submit" name="go" value = "submit">	
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>