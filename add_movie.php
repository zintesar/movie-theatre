<?php
include("db.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


if ($_POST) {

    $filename = $_FILES['image']['name'];
    $filetmp = $_FILES['image']['tmp_name'];
    $filesize = $_FILES['image']['size'];
    $fileerror = $_FILES['image']['error'];
    $filetype = $_FILES['image']['type'];

    $fileext = explode('.', $filename);
    $fileactualext = strtolower(end($fileext));

    $allowed = array('jpg', 'jpeg', 'png');
    if (in_array($fileactualext, $allowed)) {
        if ($fileerror === 0) {
            if ($filesize < 10485760) {
                $filenamenew = $_POST['movie_name'] . "." . $fileactualext;
                $filedestination = './images/' . $filenamenew;
                move_uploaded_file($filetmp, $filedestination);
            } else {
                echo "file too big";
            }
        } else {
            echo "error uploading file";
        }
    } else {
        echo "wrong file type";
    }

    $errors = array();

    if (empty($_POST['movie_name'])) {
        //echo "2";

        $errors['movie_name1'] = "Movie name cannot be empty";
    }


    if (empty($_POST['ratings'])) {//echo "7";
        $errors['ratings1'] = "ratings cannot be empty";
    }
    if (empty($_POST['description'])) {
        $errors['description'] = "description cannot be empty";
    }





    if (count($errors) == 0) {
        //echo $_POST['name'];
        $myfile = fopen("./description/" . $_POST['movie_name'] . ".txt", "w");
        $txt = $_POST['description'];
        $descriptiondir = "./description/" . $_POST['movie_name'] . ".txt";
        fwrite($myfile, $txt);
        fclose($myfile);



        $a = file_get_contents('./templete.txt');
        $path = $_POST['movie_name'] . ".php";
        $myfile1 = fopen($path, "w");
        fwrite($myfile1, $a);
        fclose($myfile1);




        // $path="./entry/".$_POST['movie_name'].".php"; 
        //file_put_contents($path, $a);
        //$myfile2 = fopen($path, "w");
        //fwrite($myfile2, $a);
        //  fclose($myfile2);
        //redirect to success pages
        //header("Location: insert.php");
        //exit();
        // if(isset($_POST['go']) != "" ) {echo  "11" ;	
        //echo "14";
        $movie_name = mysqli_real_escape_string($connection, $_POST['movie_name']);
        $ratings = mysqli_real_escape_string($connection, $_POST['ratings']);


//echo "18";


        $sql = "insert into movies  (name,description,image,rating) values  ('$movie_name','$descriptiondir','$filedestination','$ratings')";


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
        

    </head>
    <body style = "margin : 0px 0px 0px 0px"  >
        <style>
            .error_red
            {
                color : red ;
            }
        </style>
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
                    <h4 class="card-title text-center">Adding movie</h4>



                    <div class="form-group text-left">
                        <label for="movie_name">Movie name</label>
                        <input type="text" class="form-control" name="movie_name" value ="<?php if (isset($_POST['movie_name'])) echo $_POST['movie_name']; ?>" placeholder="Movie name"> 
                        <p class="error_red" ><?php if (isset($errors['movie_name1'])) echo $errors['movie_name1']; ?></p>   
                        <label for="ratings">Ratings</label>
                        <input type="text" class="form-control" name="ratings" value ="<?php if (isset($_POST['ratings'])) echo $_POST['ratings']; ?>" placeholder="Ratings">
                        <p class="error_red"><?php if (isset($errors['ratings1'])) echo $errors['ratings1']; ?></p>   
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description"  rows="5" ></textarea>
                        <p class="error_red"><?php if (isset($errors['description'])) echo $errors['description']; ?></p>  
                        <label for="image">Image</label>
                        <input type="file"  class="form-control" name="image">
                        <p class="error_red"><?php if (isset($errors['image'])) echo $errors['image']; ?></p>  


                    </div>

                    <input type="submit" name="go" value = "submit">	
                </div>

            </form>
        </div>

    </body>
</html>