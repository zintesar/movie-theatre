<?php
include("db.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<?php
//print_r($_SESSION);

if ($_POST) {

    $errors = array();
  
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
    if ($_POST['password'] != $_POST['confirm_password']) {
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

        if ($_SESSION['user_flag'] == 1 && $_SESSION['admin_flag'] == 0) {

            $aname = $_SESSION['username'];
            $select = mysqli_query($connection, "SELECT * from user where name ='$aname'") or die(mysqli_error($connection));
            $result = mysqli_fetch_array($select);
            $user_id = $result['user_id'];
            $sql = "update  user set name = '$name' ,email = '$email' ,password = '$password' ,admin_status = '$admin_status' where user_id ='$user_id'";
            $q = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            
        }








        $sql = "update  user set name = '$name' ,email = '$email' ,password = '$password' ,admin_status = '$admin_status' where user_id ='$id'";


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
    <body style = "margin : 0px 0px 0px 0px ;background-color: #fff6e8"  >

        <div>
<?php include ("header1.php"); ?>
        </div>

        <div class="container">
            <form action=# method = "post" class="form-horizontal"  target = "">
                <div class="card-body">
                    <h4 class="card-title text-center">Registration page</h4>

                    <div class="form-group text-left">
                       
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