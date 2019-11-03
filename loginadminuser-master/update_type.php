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
  $updateSQL = sprintf("UPDATE type SET type_name=%s WHERE type_id=%s",
                       GetSQLValueString($_POST['type_name'], "text"),
                       GetSQLValueString($_POST['type_id'], "int"));

  mysql_select_db($database_computer, $computer);
  $Result1 = mysql_query($updateSQL, $computer) or die(mysql_error());

  $updateGoTo = "admin_page.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_uptype = "-1";
if (isset($_GET['type_id'])) {
  $colname_uptype = $_GET['type_id'];
}
mysql_select_db($database_computer, $computer);
$query_uptype = sprintf("SELECT * FROM type WHERE type_id = %s", GetSQLValueString($colname_uptype, "int"));
$uptype = mysql_query($query_uptype, $computer) or die(mysql_error());
$row_uptype = mysql_fetch_assoc($uptype);
$totalRows_uptype = mysql_num_rows($uptype);
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<hr>
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">รหัส :</td>
      <td><?php echo $row_uptype['type_id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ชื่อประเภท :</td>
      <td><input type="text" name="type_name" value="<?php echo htmlentities($row_uptype['type_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><br /><input type="submit" value="Update type" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="type_id" value="<?php echo $row_uptype['type_id']; ?>" />
	<br>
</form>
	</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($uptype);
?>
<?php } ?>
