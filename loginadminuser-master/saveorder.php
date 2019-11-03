<meta charset="utf-8" />
<?php
	session_start();
	
	echo "<pre>";
	print_r($_POST); //แสดงแบบ array ทีละบรรทัด
	echo "</pre>";
	
	echo "<hr>";
	print_r($_SESSION); //แสดงแบบ array ทีละบรรทัด
	
?>
