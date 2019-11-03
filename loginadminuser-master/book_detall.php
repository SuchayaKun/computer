<?php require_once('../Connections/computer.php'); ?>
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

mysql_select_db($database_computer, $computer);
$query_showbook = "SELECT * FROM books WHERE books.id";
$showbook = mysql_query($query_showbook, $computer) or die(mysql_error());
$row_showbook = mysql_fetch_assoc($showbook);
$totalRows_showbook = mysql_num_rows($showbook);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>devbanban.com</title>
<?php include('bootstrap_h.php');?>
 
</head>
<body>
 
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        
      <?php include('menu.php');?>
 
      </div> <!-- close col-->
  </div> <!-- close row-->
</div>    <!-- close container-->
 
 
 
<!-- start show product detail -->
<div class="container">
  <div class="row" align="center">
  <h3 align="center">รายละเอียดสินค้า</h3>
    <div class="col-xs-12 col-sm-4 col-md-3">
      <!-- show product img -->
    </div>
    
    <div class="col-xs-12 col-sm-8 col-md-9">
      <!-- show product detail -->
    </div>
 
    
  </div>
</div>
<!-- end show product detail -->
 
 
<!-- start footer-->
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <?php include('footer.php');?>
    </div>
  </div>
</div>
<!-- end footer-->
 
<?php include('script.php');?>
  
</body>
</html>
<?php
mysql_free_result($showbook);
?>
