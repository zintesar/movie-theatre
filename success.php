<?php
session_start();
$temp = $_SESSION['POST'];

//print_r( $temp);
?>

<!doctype html>
<html>
<head>
<title> </title>

<link rel="stylesheet" href="./css/mystyle.css">

<style>



</style>

</head>

<body style = "margin : 0px 0px 0px 0px"  >

<div >
<?php include ("header.php"); ?>
</div>
	<div style = "padding-top : 50px ;">
		
		<H3 align = center > Your request is being processed </h3>
		<br>
		<p align = center ><?php echo $temp['firstname']    ?></p>
		
	</div>	
	
</body>
</html>