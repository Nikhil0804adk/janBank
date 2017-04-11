<?php
header('Content-Type: text/xml');
echo '<? xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
echo '<response>';
 $trans_status=$_GET['transstatus'];
 if (trans_status) 
		echo 'Transaction Successful ...!';
 else
 		echo 'Transaction Failed ...!';
echo '</response>'; 

?>