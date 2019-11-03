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

$colname_type = "-1";
if (isset($_GET['type_id'])) {
  $colname_type = $_GET['type_id'];
}
mysql_select_db($database_computer, $computer);
$query_type = sprintf("SELECT * FROM type WHERE type_id = %s", GetSQLValueString($colname_type, "int"));
$type = mysql_query($query_type, $computer) or die(mysql_error());
$row_type = mysql_fetch_assoc($type);
$totalRows_type = mysql_num_rows($type);

$colname_pro = "-1";
if (isset($_GET['type_id'])) {
  $colname_pro = $_GET['type_id'];
}
mysql_select_db($database_computer, $computer);
$query_pro = sprintf("SELECT * FROM books WHERE type_id = %s ORDER BY id DESC", GetSQLValueString($colname_pro, "int"));
$pro = mysql_query($query_pro, $computer) or die(mysql_error());
$row_pro = mysql_fetch_assoc($pro);
$totalRows_pro = mysql_num_rows($pro);
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
<form id="form1" name="form1" method="post" action="">
	<hr>
  <input name="type_id" type="hidden" id="type_id" value="<?php echo $row_type['type_id']; ?>" />
  <?php echo $row_type['type_name']; ?> | <a href="admin_page.php">ย้อนกลับ</a>

<p>&nbsp;</p>
<table width="46%" border="1" align="center">
  <tr>
    <td width="68%" align="center">รายละเอียดสินค้า</td>
    <td width="32%" align="center">รูปภาพ</td>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center"><p><?php echo $row_pro['b_name']; ?></p>
        <p>ราคา :<?php echo $row_pro['b_price']; ?></p>
        <p><a href="update.php?id=<?php echo $row_pro['id']; ?>">แก้ไข</a> | <a href="delete.php?id=<?php echo $row_pro['id']; ?>">ลบ</a></p></td>
      <td align="center"><img src="./img-books/<?php echo $row_pro['b_img']; ?>" width="132" height="152" /></td>
    </tr>
    <?php } while ($row_pro = mysql_fetch_assoc($pro)); ?>
</table>
</form>
	</div>
<p>&nbsp;</p>
<?php include('script.php')?>
</body>
</html>
<?php
?>
<?php } ?>
