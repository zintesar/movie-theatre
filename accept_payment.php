<?php

	include("db.php");
	
	if(isset($_GET['id']) != "" )
	{	
		
	
		
		$temp_id =mysqli_real_escape_string($connection,$_GET['id']);
               
		$payment_flag = mysqli_query($connection,"select payment_tick from invoice where invoice_id = '$temp_id'") or die(mysqli_error($connection));
			$payment_flag=mysqli_fetch_array($payment_flag);
                        ;
		
		if($payment_flag['payment_tick']== 1)
		{;
			echo "<script type='text/javascript'>alert('already paid');
                    window.window.history.go(-1);
                    </script>";
		};
		if($payment_flag['payment_tick']== 0)
		{
			;
			$accept=mysqli_query($connection,"update invoice set payment_tick = 1   where invoice_id = '$temp_id'");
			
			
			
			
			if($accept)
				
			{
				
			
				echo "<script type='text/javascript'>alert('payment accepted');
                    window.window.history.go(-1);
                    </script>";
				
				
				//, date_of_join = now()
			}
			
			
		}
	}
	?> 