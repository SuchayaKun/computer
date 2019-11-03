<?php require_once('../../Connections/computer.php'); ?>
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
$query_RecordSearch = "SELECT * FROM books";
$RecordSearch = mysql_query($query_RecordSearch, $computer) or die(mysql_error());
$row_RecordSearch = mysql_fetch_assoc($RecordSearch);
$totalRows_RecordSearch = mysql_num_rows($RecordSearch);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>ชื่อหนังสือ : <?php echo $row_RecordSearch['b_name']; ?>
</p>
<p>ชื่อผู้แต่ง : <?php echo $row_RecordSearch['b_author']; ?></p>
<p>&nbsp;</p>
<p><img src="img-books/<?php echo $row_RecordSearch['b_img']; ?>" width="150" height="150" /></p>
<p><img src="1.jpg" width="232" height="150" /></p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($RecordSearch);
?>
