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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE books SET b_name=%s, b_author=%s, b_year=%s, b_amount=%s, type_id=%s, b_price=%s, b_img=%s WHERE id=%s",
                       GetSQLValueString($_POST['b_name'], "text"),
                       GetSQLValueString($_POST['b_author'], "text"),
                       GetSQLValueString($_POST['b_year'], "text"),
                       GetSQLValueString($_POST['b_amount'], "int"),
                       GetSQLValueString($_POST['type_id'], "int"),
                       GetSQLValueString($_POST['b_price'], "int"),
                       GetSQLValueString($_POST['b_img'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_computer, $computer);
  $Result1 = mysql_query($updateSQL, $computer) or die(mysql_error());

  $updateGoTo = "search.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_computer, $computer);
$query_Recordset1 = sprintf("SELECT * FROM books WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
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
  $("th").click(function(){
    alert("แก้ไขสำเร็จ");
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
	

<center><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<hr>
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">รหัสหนังสือ:</td>
      <td><?php echo $row_Recordset1['id']; ?></td>
    </tr>
    <tr valign="baseline" >
      <td nowrap="nowrap" align="right">ชื่อหนังสือ :</td>
      <td><input type="text" name="b_name" value="<?php echo htmlentities($row_Recordset1['b_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ชื่อผู้แต่ง :</td>
      <td><input type="text" name="b_author" value="<?php echo htmlentities($row_Recordset1['b_author'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ปีที่พิมพ์ :</td>
      <td><input type="text" name="b_year" value="<?php echo htmlentities($row_Recordset1['b_year'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">จำนวน :</td>
      <td><input type="text" name="b_amount" value="<?php echo htmlentities($row_Recordset1['b_amount'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ประเภท :</td>
      <td><input type="text" name="type_id" value="<?php echo htmlentities($row_Recordset1['type_id'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ราคา :</td>
      <td><input type="text" name="b_price" value="<?php echo htmlentities($row_Recordset1['b_price'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">รูปหนังสือ :</td>
      <td><input type="text" name="b_img" value="<?php echo htmlentities($row_Recordset1['b_img'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <th><input type="submit" value="แก้ไขเรียบร้อย" /></th>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>" />
</form>
</center>
<p>&nbsp;</p>
	<?php include('script.php')?>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
<?php } ?>
