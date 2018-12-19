<?php
	include("db.php");
	if(isset($_GET['id']) != "" )
	{
		$temp_id = $_GET['id'];
		
		$accept=mysqli_query($connection,"delete from ticket where movie_id = $temp_id");
                $clear=mysqli_query($connection,"delete from invoice where movie_id = $temp_id");
			if($accept)
			{
				header("Location:movie_library.php");
			}
			else
			{
				echo mysqli_error($connection);
			}
	}
	?>