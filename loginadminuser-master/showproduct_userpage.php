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
$query_showproduct = "SELECT * FROM books";
$showproduct = mysql_query($query_showproduct, $computer) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);
?>
<?php do { ?>
  <div class="col-xs-12 col-sm-6 col-md-3">
  
  <img src="./img-books/<?php echo $row_showproduct['b_img']; ?>" width="90%" height="380" style="padding-bottom:20px"/> 
  <br />
  <center>
  		ชื่อสินค้า : <?php echo $row_showproduct['b_name']; ?><br />
   			<font color="#0000CC">
  		ราคา : <?php echo number_format($row_showproduct['b_price'],2); ?> บาท
 			</font>
            <br>
            <a href="product_detail.php?id=<?php echo $row_showproduct['id']; ?>" class="btn btn-success btn-xs">รายละเเอียด </a>
            
            
            
  			<br /><br />
  </center>
  </div>
  
  
  <?php } while ($row_showproduct = mysql_fetch_assoc($showproduct)); ?>
<?php
mysql_free_result($showproduct);
?>
