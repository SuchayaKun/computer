<?php require_once('../Connections/computer.php'); ?>
<?php 

    session_start();

    if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {

?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_RecordSearch = "-1";
if (isset($_POST['search'])) {
  $colname_RecordSearch = $_POST['search'];
}
mysql_select_db($database_computer, $computer);
$query_RecordSearch = sprintf("SELECT * FROM books WHERE b_name LIKE %s", GetSQLValueString("%" . $colname_RecordSearch . "%", "text"));
$RecordSearch = mysql_query($query_RecordSearch, $computer) or die(mysql_error());
$row_RecordSearch = mysql_fetch_assoc($RecordSearch);
$totalRows_RecordSearch = mysql_num_rows($RecordSearch);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
	

  <style type="text/css">
  			
	 body{background-image:url("img/about_overlay.png");}
	  
	 form {
    width: 900px;
	background-color:#FFFFFF;
}
	header {
   	background-color:#FFFFFF;
}
  </style>    


<!--	<link rel="stylesheet" href="style.css">-->
	  <?php include('bootstrap_h.php')?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>

<body>
	
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
		
  		<?php include('menu2.php')?>
	</div>    	
</div>
	
	
<div class="container" align="center">
<form>
	<hr>
<h2>ชื่อสินค้า :<?php echo $row_RecordSearch['b_name']; ?></h2>
<h>
  <p>ราคาสินค้า :<?php echo $row_RecordSearch['b_price']; ?> | <a href="update.php?id=<?php echo $row_RecordSearch['id']; ?>">แก้ไข</a> | <a href="delete.php?id=<?php echo $row_RecordSearch['id']; ?>">ลบ</a></p>
  
</h>
<p><img src="./img-books/<?php echo $row_RecordSearch['b_img']; ?>" width="262" /></p>
	<br>
<h></h>
	</form>
</div>

	<?php include('script.php')?>
</body>
</html>
<?php
mysql_free_result($RecordSearch);
?>
<?php } ?>
