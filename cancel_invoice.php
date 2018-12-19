<?php
	include("db.php");
	if(isset($_GET['id']) != "" )
	{
		$temp_id = $_GET['id'];
		
		
                $clear=mysqli_query($connection,"delete from invoice where invoice_id = $temp_id");
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