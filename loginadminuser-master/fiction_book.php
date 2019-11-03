<?php require_once('../Connections/computer.php'); ?>
<?php include("dw-upload.php"); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO fictionbook (f_name, f_author, f_year, f_amount, type_id, f_price, f_img) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fName'], "text"),
                       GetSQLValueString($_POST['fAuthor'], "text"),
                       GetSQLValueString($_POST['fYear'], "text"),
                       GetSQLValueString($_POST['fAmount'], "int"),
                       GetSQLValueString($_POST['typeId'], "int"),
                       GetSQLValueString($_POST['fPrice'], "int"),
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO fictionbook (f_name, f_author, f_year, f_amount, type_id, f_price, f_img) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fName'], "text"),
                       GetSQLValueString($_POST['fAuthor'], "text"),
                       GetSQLValueString($_POST['fYear'], "text"),
                       GetSQLValueString($_POST['fAmount'], "int"),
                       GetSQLValueString($_POST['typeId'], "int"),
                       GetSQLValueString($_POST['fPrice'], "int"),
                       GetSQLValueString($_POST['img'], "text"));

  mysql_select_db($database_computer, $computer);
  $Result1 = mysql_query($insertSQL, $computer) or die(mysql_error());

  $insertGoTo = "fiction_book.php";
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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_computer, $computer);
$query_Recordset1 = "SELECT * FROM books";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $computer) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

mysql_select_db($database_computer, $computer);
$query_Recordset2 = "SELECT * FROM type";
$Recordset2 = mysql_query($query_Recordset2, $computer) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$maxRows_Recordset3 = 10;
$pageNum_Recordset3 = 0;
if (isset($_GET['pageNum_Recordset3'])) {
  $pageNum_Recordset3 = $_GET['pageNum_Recordset3'];
}
$startRow_Recordset3 = $pageNum_Recordset3 * $maxRows_Recordset3;

mysql_select_db($database_computer, $computer);
$query_Recordset3 = "SELECT * FROM fictionbook";
$query_limit_Recordset3 = sprintf("%s LIMIT %d, %d", $query_Recordset3, $startRow_Recordset3, $maxRows_Recordset3);
$Recordset3 = mysql_query($query_limit_Recordset3, $computer) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);

if (isset($_GET['totalRows_Recordset3'])) {
  $totalRows_Recordset3 = $_GET['totalRows_Recordset3'];
} else {
  $all_Recordset3 = mysql_query($query_Recordset3);
  $totalRows_Recordset3 = mysql_num_rows($all_Recordset3);
}
$totalPages_Recordset3 = ceil($totalRows_Recordset3/$maxRows_Recordset3)-1;

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
  			table {
    		text-align: center }
	 body{background-image:url("images/12.jpg");}
	  
	form {
    width: 900px;
	background-color:#FFFFFF;
}
  </style>    

</head>
<body>
<div class="container">
<center>
  <form  action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1">
  <h1 align="center">&nbsp;</h1>
  <h1 align="center">You are Admin </h1>
        <h1 align="center">Hi, <?php echo $_SESSION['user'] ;?> | <a href="logout.php">Logout</a></h1>
        <p align="center">&nbsp;</p>
	  <h4><a href="admin_page.php">เพิ่มข้อมูลหนังสือความรู้</a> | เพิ่มหนังสือนิยาย | <a href="search.php">ค้นหาหนังสือ</a></h4>
      
	  <table width="400" border="1" cellspacing="0" cellpadding="2">
	    <tr>
	      <th scope="row">ชื่อหนังสือ :</th>
	      <td><input type="text" name="fName" id="fName2"></td>
        </tr>
	    <tr>
	      <th scope="row">ชื่อผู้แต่ง :</th>
	      <td><input type="text" name="fAuthor" id="fAuthor"></td>
        </tr>
	    <tr>
	      <th scope="row">ปีที่พิมพ์:</th>
	      <td><input type="text" name="fYear" id="fYear"></td>
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
	      <td><input type="text" name="fAmount" id="fAmount"></td>
        </tr>
	    <tr>
	      <th scope="row">ราคา :</th>
	      <td><input type="text" name="fPrice" id="fPrice"></td>
        </tr>
	    <tr>
	      <th scope="row">รูปหนังสือ :</th>
	      <td><input type="file" name="img" id="img"></td>
        </tr>
      </table>
	  <br>
	      <td><input type="submit" name="btnSave" id="btnSave" value="เพิ่มหนังสือ"></td><br><br><br><br>
	  
    <table width="800" border="1">
  <tr>
    <td width="110"><h4>รหัสหนังสือ</h4></td>
    <td width="250"><h4>ชื่อหนังสือ</h4></td>
    <td width="157"><h4>ชื่อผู้แต่ง</h4></td>
    <td width="157"><h4>ปีที่พิมพ์</h4></td>
    <td width="157"><h4>จำนวน</h4></td>
    <td width="157"><h4>ประเภทหนังสือ</h4></td>
    <td width="157"><h4>ราคา</h4></td>
    <td width="205"><h4>รูปภาพ</h4></td>
    <td width="205">&nbsp;</td>
    <td width="205">&nbsp;</td>
    
  </tr>
        <?php do { ?>
          <tr>
            <td><?php echo $row_Recordset3['id']; ?></td>
            <td><?php echo $row_Recordset3['f_name']; ?></td>
            <td><?php echo $row_Recordset3['f_author']; ?></td>
            <td><?php echo $row_Recordset3['f_year']; ?></td>
            <td><?php echo $row_Recordset3['f_amount']; ?></td>
            <td><?php echo $row_Recordset3['type_id']; ?></td>
            <td><?php echo $row_Recordset3['f_price']; ?></td>
            <td><img src="img-books/<?php echo $row_Recordset3['f_img']; ?>" width="150"></td>
            <td>แก้ไข</td>
      		<td>ลบ</td>
          </tr>
          <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
      </table>
	  <p>
        <input type="hidden" name="MM_insert" value="form1">
      <p>&nbsp;</p>
    </form>

</center>
</div>
</body></html>
        
        <?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

} ?>