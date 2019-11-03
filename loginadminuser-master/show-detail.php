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
$query_Recordset1 = "SELECT * FROM tb_order ORDER BY order_id ASC";
$Recordset1 = mysql_query($query_Recordset1, $computer) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_computer, $computer);
$query_Recordset2 = "SELECT * FROM tb_order_detail ORDER BY d_id ASC";
$Recordset2 = mysql_query($query_Recordset2, $computer) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

session_start();

    if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {

?>
<?php
    error_reporting( error_reporting() & ~E_NOTICE );
    session_start(); 
    $p_id = $_REQUEST['id']; 
	$act = $_REQUEST['act'];

	if($act=='add' && !empty($p_id))
	{
		if(!isset($_SESSION['shopping_cart']))
		{
			 
			$_SESSION['shopping_cart']=array();
		}else{
		 
		}
		if(isset($_SESSION['shopping_cart'][$p_id]))
		{
			$_SESSION['shopping_cart'][$p_id]++;
		}
		else
		{
			$_SESSION['shopping_cart'][$p_id]=1;
		}
	}

	if($act=='remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['shopping_cart'][$p_id]);
	}

	if($act=='update')
	{
		$amount_array = $_POST['amount'];
		foreach($amount_array as $p_id=>$amount)
		{
			$_SESSION['shopping_cart'][$p_id]=$amount;
		}
	}
	
	//ยกเลิกตระกร้าสินค้า
	if($act=='Cancel-Cart'){
		unset($_SESSION['shopping_cart']);	
	}
	?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>ORDER DETAIL</title>
	<?php include('bootstrap_h.php');?>
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
                            <h2>ORDER DETAIL</h2>
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
	
<br>



    
  
 

<p>
  <?php include('script.php');?>
</p>
  <div class="container" align="center">
<h4>ตารางการสั่งซื้อ</h4>

<div class="row">
<div class="col-md">
<?php do { ?>
  <table width="368" border="1">
    <tr>
      <td align="center">Order ID :</td>
      <td><?php echo $row_Recordset1['order_id']; ?></td>
      </tr>
    <tr>
      <td align="center">ชื่อ :</td>
      <td><?php echo $row_Recordset1['name']; ?></td>
      </tr>
    <tr>
      <td align="center">ที่อยู่ :</td>
      <td><?php echo $row_Recordset1['address']; ?></td>
      </tr>
    <tr>
      <td align="center">Email :</td>
      <td><?php echo $row_Recordset1['email']; ?></td>
      </tr>
    <tr>
      <td align="center">เบอร์ :</td>
      <td><?php echo $row_Recordset1['phone']; ?></td>
      </tr>
    <tr>
      <td align="center">วันที่สั่งซื้อ :</td>
      <td><?php echo $row_Recordset1['order_date']; ?></td>
      </tr>
    
    <br>
  </table>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </div>
<br>
<div class="col-md">


  <?php do { ?>
    <table width="368" border="1">
      <tr>
        <td width="87" align="center"><p>รหัสสินค้า</p>
          <p><?php echo $row_Recordset2['order_id']; ?></p></td>
        
        <td width="265"><p>ID : <?php echo $row_Recordset2['p_id']; ?></p>
          <p>ราคารวม : <?php echo $row_Recordset2['total']; ?></p></td>
        <br>
        
      </tr>
      </table>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
     </div>
</div>


<p>&nbsp;</p>
<br><br><br><br><br>
</div>
</body>

</html>
	<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

} ?>