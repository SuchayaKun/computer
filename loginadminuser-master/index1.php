<?php 

    session_start();

    if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {

?>


<!DOCTYPE html>
<?php 
$con=mysqli_connect("localhost","root","12345678","loginadminuser");
$sql="select * from books";
$result=mysqli_query($con,$sql);
		
if(isset($_POST["aad_product"])){
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
			'item_id'			=>			$_GET["id"],
			'item_b_name'		=>	$_POST["hidden_name"],
			'item_b_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("สินค้าถูกเพิ่มเรียนร้อยแล้ว")</script>';
			echo '<script>window.location="user_page.php"</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>			$_GET["id"],
			'item_b_name'		=>	$_POST["hidden_name"],
			'item_b_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}
		
if(isset($_GET['action'])){
		if($_GET['action']=="delete"){
		foreach ($_SESSION['shopping_cart'] as $key => $value){
			if($value['item_id']==$_GET['id']){
			unset($_SESSION['shopping_cart'][$key]);
			echo '<script>alert("ลบเรียบร้อย")</script>';
			echo '<script>window.location="user_page.php"</script>';
		}
		}
	}
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Page</title>
	
<style> 
/*ปรับรูปภาพ*/
.img {
    width: 230px;
    height: 250px;    
  
}

</style>
	
	<?php include('u_bootstrap.php');?>
 
    <link rel="stylesheet" href="style.css">

</head>
<body>

<h1>You are Member</h1>
<h3>Hi, <?php echo $_SESSION['user']; ?></h3>
        <p><a href="logout.php">Logout</a></p>
		
<div class="container" style="width: 900px">
	<?php
	while($row=mysqli_fetch_array($result)){
	?>	
		
	
	<div class="col-md-4" >
	<form method="post" action="user_page.php?action=add&id=<?php echo $row['id'];?>"><br>
		<div class="border" style="border: 1px solid #333;background-color: white;border-radius: 13px;padding: 1px;margin: 1px; width:250px;"><br>
			
			<img class="img" src="./img-books/<?php echo $row['b_img'];?>" class="img-responsive" />
			<h5 class="text-info">สินค้า : <?php echo $row['b_name'];?></h4>
			<h4 class="text-danger">ราคา : <?php echo number_format($row['b_price'],2);?> บาท</h4>
			
			<input style="text"  name="quantity" class="form-control" value="1"/>
			<input type="hidden" name="hidden_name" value="<?php echo $row['b_name'];?>"/>
			<input type="hidden" name="hidden_price" value="<?php echo $row['b_price'];?>"/>
			
			<input type="submit" name="aad_product" style="margin-top: 5px;" class="btn btn-success" value="เพิ่มลงตระกร้า" />
		</div>
	</form>	
	</div>
	
	<?php } ?>
	
	<br>
  <div style="clear:both;">
	  <p>&nbsp;</p>
	</div>
	<h3 align="left">การสั่งซื้อสินค้า</h3>
  <div class="table-responsive">
	<table class="table table-bordered">
				<tr>
				<th>สินค้า</th>
				<th>จำนวน</th>
				<th>ราคา</th>
				<th>รวม</th>
				<th>การดำเนินการ</th>
				</tr>
				<?php
				if(!empty($_SESSION["shopping_cart"])){
					$total=0;
					foreach ($_SESSION['shopping_cart'] as $key => $value) { ?>
				<tr>
					<td><?php echo $value['item_b_name'];?></td>
					<td><?php echo $value['item_quantity'];?></td>
					<td><?php echo number_format($value['item_b_price'],2);?></td>
					<td><?php echo number_format($value['item_b_price']*$value['item_quantity'],2);?></td>
					<td><a href="user_page.php?action=delete&id=<?php echo $value['item_id'];?>">ลบสินค้า</td>					
				</tr>
				<?php
				$total=$total+($value['item_b_price']*$value['item_quantity']);						   }
				?>
				<tr>
					<td colspan="3" align="right">ราคารวม</td>
					<td align="right">฿ <?php echo number_format($total, 2); ?></td>
					<td></td>
				</tr>
				<?php
				}
				?>
	</table>
    <form name="form1" method="post" action="save.php">
  <table width="304" border="2" align="right">
    <tr>
      <td width="71">Name</td>
      <td width="217"><input type="text" name="txtName"></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><textarea name="txtAddress"></textarea></td>
    </tr>
    <tr>
      <td>Tel</td>
      <td><input type="text" name="txtTel"></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input type="text" name="txtEmail"></td>
    </tr>
	 
  </table>
     <p></p> 
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
    <p align="right"><input type="submit" name="Submit" value="Submit"></p>
    <p>&nbsp;</p>
    <p>
     
    </p>
</form>
	  <br><br>
  </div>
	
	<!--<?php echo '<pre>' .print_r($_SESSION, TRUE). '</pre>';?>-->
</div>

	
	
</body>
</html>


<?php } ?>