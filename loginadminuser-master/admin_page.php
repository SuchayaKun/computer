<?php require_once('../Connections/computer.php'); ?>
<?php include("dw-upload.php"); ?>
<?php 

    session_start();

    if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {

?>
<?php
mysql_query("SET NAMES UTF8");
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO type (type_name) VALUES (%s)",
                       GetSQLValueString($_POST['type_name'], "text"));

  mysql_select_db($database_computer, $computer);
  $Result1 = mysql_query($insertSQL, $computer) or die(mysql_error());

  $insertGoTo = "admin_page.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO books (b_name, b_author, b_year, b_amount, type_id, b_price, b_img) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['bName'], "text"),
                       GetSQLValueString($_POST['bAuthor'], "text"),
					   GetSQLValueString($_POST['bYear'], "text"),
					   GetSQLValueString($_POST['bAmount'], "text"),
					   GetSQLValueString($_POST['btn'], "text"),
					   GetSQLValueString($_POST['bPrice'], "text"),
                       GetSQLValueString(dwUpload($_FILES['img']), "text"));
  mysql_select_db($database_computer, $computer);
  $Result1 = mysql_query($insertSQL, $computer) or die(mysql_error());

  $insertGoTo = "search.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_computer, $computer);
$query_Recordset1 = "SELECT * FROM books";
$Recordset1 = mysql_query($query_Recordset1, $computer) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_computer, $computer);
$query_Recordset2 = "SELECT * FROM type";
$Recordset2 = mysql_query($query_Recordset2, $computer) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

session_start();

    if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {

?>

<!DOCTYPE html>
<html lang="en">
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
  $("p").click(function(){
    alert("คุณต้องการออกจากระบบ");
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
			
  <form  action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1"><hr>
  <h1 align="center">เพิ่มข้อมูลหนังสือ| <a href="search.php">ค้นหาหนังสือ</a></di>
  </h1>
	  
      <table width="353" height="210" border="2" cellpadding="2" cellspacing="0">
        <tbody>
          <tr>
            <th scope="row">ชื่อหนังสือ :</th>
            <td><input type="text" name="bName" id="bName2"></td>
          </tr>
          <tr>
            <th scope="row">ชื่อผู้แต่ง :</th>
            <td><input type="text" name="bAuthor" id="bAuthor"></td>
          </tr>
          <tr>
            <th scope="row">ปีที่พิมพ์:</th>
            <td><input type="text" name="bYear" id="bYear"></td>
          </tr>
          <tr>
            <th scope="row">ประเภทหนังสือ :</th>
            <td><select name="btn" id="btn">
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset2['type_id']?>"<?php if (!(strcmp($row_Recordset2['type_id'], $row_Recordset2['type_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset2['type_name']?></option>
<?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
            </select></td>
          </tr>
          <tr>
            <th scope="row">จำนวน :</th>
            <td><input type="text" name="bAmount" id="bAmount"></td>
          </tr>
          <tr>
            <th scope="row">ราคา :</th>
            <td><input type="text" name="bPrice" id="bPrice"></td>
          </tr>
          <tr>
            <th scope="row">รูปหนังสือ :</th>
            <td><input type="file" name="img" id="img"></td>
          </tr>
        </tbody>
      </table>
<br>
    <td><input type="submit" name="btnSave" id="btnSave" value="เพิ่มหนังสือ"><br>
    <input type="hidden" name="MM_insert" value="form1">  <br>  </td>
  </form>
  
  <form name="form" action="<?php echo $editFormAction; ?>" method="POST" >
    <table width="272" border="2" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="2">เพิ่มประเภทหนังสือ</td>
        </tr>
      <tr>
        <td>ประเภท</td>
        <td><label for="type_name"></label>
          <input type="text" name="type_name" id="type_name"></td>
      </tr>
      <tr>
        <td width="127">&nbsp;</td>
        <td width="129"><input type="submit" name="button" id="button" value="Submit"></td>
      </tr>
    </table>
    <br>
    <table width="346" border="2" cellspacing="0" cellpadding="2">
      <tr>
        <td>รหัส</td>
        <td>ประเภทหนังสือ</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset2['type_id']; ?></td>
        <td><a href="show-pro.php?type_id=<?php echo $row_Recordset2['type_id']; ?>"><?php echo $row_Recordset2['type_name']; ?></a></td>
        <td><a href="update_type.php?type_id=<?php echo $row_Recordset2['type_id']; ?>">แก้ไข</a></td>
        <td><a href="delete2.php?type_id=<?php echo $row_Recordset2['type_id']; ?>">ลบ</a></td>
      </tr>
      <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
    </table>
<br>
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
<br>
    <input type="hidden" name="MM_insert" value="form">
  
  </form>
 <p>&nbsp;</p>
</center>
</div>
<?php include('script.php')?>
</body></html>
        
        <?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

} ?>
<?php } ?>