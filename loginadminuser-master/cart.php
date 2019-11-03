<?php 

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
<title>BOOK CART</title>
	<?php include('bootstrap_h.php');?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("th").click(function(){
    alert("คุณต้องการสั่งซื้อสินค้า");
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
                            <h2>BOOK CART </h2>
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


  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-7">
      <form id="frmcart" name="frmcart" method="post" action="">
        <table width="100%" border="0" align="center" class="table table-hover">
        <tr>
          <td height="40" colspan="7" align="center" bgcolor="#CCCCCC"><strong><b>ตะกร้าสินค้า</span></strong></td>
        </tr>
        <tr>
          <td align="center" bgcolor="#EAEAEA"><strong>No.</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>image</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>สินค้า</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>ราคา</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>จำนวน</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>รวม/รายการ</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>ลบ</strong></td>
        </tr>
        <?php

if(!empty($_SESSION['shopping_cart']))
{
require_once('../Connections/computer.php');
	foreach($_SESSION['shopping_cart'] as $p_id=>$p_qty)
	{
		$sql = "select * from books where id=$p_id";
		$query = mysql_db_query($database_computer, $sql);
		while($row = mysql_fetch_array($query))
		{
		 
		$sum = $row['b_price'] * $p_qty;
		$total += $sum;
		echo "<tr>";
		echo "<td>";
        echo $i += 1;
        echo ".";
		echo "</td>";
		echo "<td width='100'>"."<img src='./img-books/$row[b_img]'  width='50'/>"."</td>";
		echo "<td width='334'>"." " . $row["b_name"] . "</td>";
		echo "<td width='100' align='right'>" . number_format($row["b_price"],2) . "</td>";
		
		echo "<td width='57' align='right'>";  
		echo "<input type='text' name='amount[$p_id]' value='$p_qty' size='2'/></td>";
		
		echo "<td width='100' align='right'>" .number_format($sum,2)."</td>";
		echo "<td width='100' align='center'><a href='cart.php?id=$p_id&act=remove' class='btn btn-danger btn-xs'>ลบ</a></td>";
		
		echo "</tr>";
		}
 
	}
	echo "<tr>";
  	echo "<td colspan='5' bgcolor='#CEE7FF' align='right'>Total</td>";
  	echo "<td align='right' bgcolor='#CEE7FF'>";
  	echo "<b>";
  	echo  number_format($total,2);
  	echo "</b>";
  	echo "</td>";
  	echo "<td align='left' bgcolor='#CEE7FF'></td>";
	echo "</tr>";
}
?>
        <tr>
          <td></td>
          <td colspan="5" align="right">
          
          <a href="cart.php?act=Cancel-Cart" class="btn btn-danger">ยกเลิกตระกร้าสินค้า </a>
          
          <button type="submit" name="button" id="button" class="btn btn-warning"> คำนวณราคาใหม่ </button>
            <th><button type="button" name="Submit2"  onclick="window.location='confirm.php';" class="btn btn-primary"> 
            <span class="glyphicon glyphicon-shopping-cart"> </span> สั่งซื้อ </button></th>
            </td>
        </tr>
      </form>
      <p align="center"> <a href="user_page.php" class="btn btn-primary">กลับไปเลือกสินค้า</a> </p>
		  <br />
    </div>
  </div>
 

<?php include('script.php');?>
	

</body>

</html>
	<?php } ?>