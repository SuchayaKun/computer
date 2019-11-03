<?php 

    session_start();

    if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {

?>

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

$colname_showproduct = "-1";
if (isset($_GET['id'])) {
  $colname_showproduct = $_GET['id'];
}
mysql_select_db($database_computer, $computer);
$query_showproduct = sprintf("SELECT * FROM books WHERE id = %s", GetSQLValueString($colname_showproduct, "int"));
$showproduct = mysql_query($query_showproduct, $computer) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);

//update product view
$p_id = $row_showproduct['id'];
$p_view = $row_showproduct['p_view'];
$count = $p_view + 1;

$sql= "UPDATE books SET  p_view=$count WHERE id = $p_id";
	mysql_db_query($database_computer,$sql);
//

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOK DETAILS</title>
    <?php include('bootstrap_h.php');?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("a").click(function(){
    alert("เพิ่มลงตระกร้าสินค้า");
  });
});
</script>

  </head>
  <body>


  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        
        <?php include('menu.php');?>
<!-- breadcrumb start-->
     <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>BOOK DETAILS </h2>
                            <p>Home <span>//</span>About</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->
<br />
      </div> <!-- close col-->
    </div> <!-- close row-->




<!-- start show product detail -->
<div class="container"v align="center">
  
  	<h3 align="center">รายละเอียกสินค้า </h3><br /><br />
	  <div class="row" align="center"
    <br />
    <div class="col-sm-3 col-md-6" align="right" >
      <!-- show product img -->
    	<img src="./img-books/<?php echo $row_showproduct['b_img']; ?>"  width="40%" height="310" style="padding-bottom:10px"/>
    </div>
    

    <div class="col-sm-9 col-md-6 " align="left">
      <!-- show product detail -->
      <br />
      ชื่อสินค้า : <?php echo $row_showproduct['b_name']; ?><br />
      ผู้แต่ง :   <?php echo $row_showproduct['b_author']; ?><br />
      ปีที่พิมพ์ : <?php echo $row_showproduct['b_year']; ?><br />
      จำนวนทั้งหมด : <?php echo $row_showproduct['b_amount']; ?> เล่ม <br /> 
      จำนวนการเข้าชม : <?php echo $row_showproduct['p_view']; ?> <br /> <br />   
      ราคา   : <?php echo $row_showproduct['b_price']; ?>บาท <br />
     
      <?php echo "<a href='cart.php?id=$row_showproduct[id]&act=add'><span class='glyphicon glyphicon-shopping-cart'> </span> เพิ่มลงตะกร้าสินค้า </a>"; ?>
    </div>

  </div>
</div>
<!-- end show product detail -->
<br /><br /><br /><br />

<!-- start footer-->

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <?php include('footer.php');?>
    </div>
  </div>

<!-- end footer-->

<?php include('script.php');?>
  
  </body>
</html>
<?php
mysql_free_result($showproduct);
?>
<?php } ?>
