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

mysql_select_db($database_computer, $computer);
$query_Recordset1 = "SELECT * FROM books";
$Recordset1 = mysql_query($query_Recordset1, $computer) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
<script>
$(document).ready(function(){
  $("input").click(function(){
    alert("คุณต้องการค้นหาหนังสือ");
  });
});
</script>

</head>

<body>
		
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
		
  		<?php include('menu2.php')?>
	</div>    	
</div>
<div class="container">
<center>
<form id="form1" name="form1" method="post" action="show-search.php">
  <hr>
	  <label for="search">ค้นหาสินค้า :</label>
	  <input type="text" name="search" id="search" />
      <input type="submit" name="btnSearch" id="btnSearch" value="ค้าหา" />
      <br>

  <p>&nbsp;</p>
  <table width="800" border="2" cellspacing="0" cellpadding="2">
      <tr>
        <td width="90" align="center"><h4>รหัสหนังสือ</h4></td>
        <td width="250" align="center"><h4>ชื่อหนังสือ</h4></td>
        <td width="157" align="center"><h4>ชื่อผู้แต่ง</h4></td>
        <td width="157" align="center"><h4>ปีที่พิมพ์</h4></td>
        <td width="157" align="center"><h4>จำนวน</h4></td>
        <td width="157" align="center"><h4>ประเภทหนังสือ</h4></td>
        <td width="157" align="center"><h4>ราคา</h4></td>
        <td width="205" align="center"><h4>รูปภาพ</h4></td>
      </tr>
      <?php do { ?>
      <tr>
        <td align="center"><?php echo $row_Recordset1['id']; ?></td>
        <td align="center"><?php echo $row_Recordset1['b_name']; ?></td>
        <td align="center"><?php echo $row_Recordset1['b_author']; ?></td>
        <td align="center"><?php echo $row_Recordset1['b_year']; ?></td>
        <td align="center"><?php echo $row_Recordset1['b_amount']; ?></td>
        <td align="center"><?php echo $row_Recordset1['type_id']; ?></td>
        <td align="center"><?php echo $row_Recordset1['b_price']; ?></td>
        <td align="center"><img src="./img-books/<?php echo $row_Recordset1['b_img']; ?>" alt="" width="150"></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </table>
  <p>&nbsp;</p>
</form></center>
<p align="center">&nbsp;</p>
<p>&nbsp;</p>
</div>
<?php include('script.php')?>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
<?php } ?>
