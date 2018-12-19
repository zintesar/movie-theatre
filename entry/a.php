<?php
$handle = fopen("templete.txt", 'r');
                                    
                                        $a =file_get_contents('templete.txt');
                                       
                                    
                                    fclose($handle);
		$myfile = fopen("b.php", "w");
		fwrite($myfile, $a);
        fclose($myfile);
?>