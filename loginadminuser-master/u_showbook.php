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
$query_showbook = "SELECT * FROM books";
$showbook = mysql_query($query_showbook, $computer) or die(mysql_error());
$row_showbook = mysql_fetch_assoc($showbook);
$totalRows_showbook = mysql_num_rows($showbook);
?>
<?php do { ?>
  <div class="col-xs-5 col-sm-4 col-md-3"><img src="./img-books/<?php echo $row_showbook['b_img']; ?>" width="100%" style="padding-bottom:10px" />
  ชื่อสินค้า <?php echo $row_showbook['b_name']; ?> 
  <font color="#0000FF">
  ราคา <?php echo number_format($row_showbook['b_price'],2); ?>   บาท
  </font>
  <p>
  <a href="#" class="btn btn-success btn-xs">เพิ่มใส่ตระกร้าสินค้า</a>
  </p>
  <br/>
  </div>
  <?php } while ($row_showbook = mysql_fetch_assoc($showbook)); ?>
<?php
mysql_free_result($showbook);
?>
