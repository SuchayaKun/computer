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
  <title>User Page</title>
	<style> 
		body{
		position: relative;
			}

		h1, h2, h3, h4, h5, h6{
    	font-family: "Lato", serif !important;
		}

		p, span, a{
   		 font-family: "Raleway", sans-serif !important;
		}

		.button{
    padding: 12px;
    border: 2px solid;
    border-radius: 3px;
    text-transform: uppercase;
    -webkit-transition: all .3s;
    transition: all .3s;
    font-size: 16px;
}

/* Scrollbar */

    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #11ABB0;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #159296;
    }




@media (max-width: 576px){

	#header{
        background-size: initial !important;
        background-position: top !important;
	}

	#header h1{
        font-size: 40px !important;
    }

    #header h4{
        font-size: 16px !important;
    }

	#portfolio h2{font-size: 25px !important;}
}




/* H E A D E R */


#header{
	min-height: 100vh;
	background-image: url(./images/1212.jpg);
    background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    -webkit-background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.menu-overlay{
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.09);
    z-index: 1;
}

.menu{
    position: fixed;
    top: 20px;
    left: 10px;
    z-index: 1;
}


.nav-content{
	position: relative;
    display: none;
    padding: 0;
    background: rgba(0, 0, 0, .8);
}

.nav-content > li{
    list-style: none;
    padding: 5px 20px;
}

.nav-content > li > a{
    display: block;
    text-decoration: none;
    line-height: 32px;
    color: #F5F5F5;
    -webkit-transition: .3s;
    transition: .3s;
    letter-spacing: 1px;
    font-size: 14px;
    padding: 0 !important;
}

.nav-content > li > a:hover, .active{
    color: #11ABB0 !important;
}

.toggler{
    padding: 10px 15px;
    background: rgba(0, 0, 0, .8);
    display: block;
    cursor: pointer;
    width: min-content;
    width: -webkit-min-content;
    width: -moz-min-content;
    width: -ms-min-content;
    width: -o-min-content;
}

.bar1, .bar2, .bar3 {
    width: 25px;
    height: 3px;
    background-color: #F5F5F5;
    margin: 6px 0;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

.change .bar1 {
    -webkit-transform: rotate(-45deg) translate(-9px, 6px);
    transform: rotate(-45deg) translate(-5px, 5px);
}

.change .bar2 {opacity: 0;}

.change .bar3 {
    -webkit-transform: rotate(45deg) translate(-8px, -8px);
    transform: rotate(45deg) translate(-8px, -8px);
}
		
.nav-content #dropdown-menu{
	display: none;
	background: rgba(0, 0, 0, .8);
	position: absolute;
	top: 0;
	left: 100%;
	border-left: 1px solid rgba(0,0,0,.3);
	padding: 10px 0;
}

.nav-content #dropdown-menu ul{
	list-style-type: none;
	padding: 0;
}

.nav-content #dropdown-menu ul li a{
	color: #F5F5F5;
}

#dropdown{
	position: relative;
}

#header .dropdown-item:hover, #header .dropdown-item.active{
	color: #11ABB0;
	background: transparent !important;
}


#header > .row{
	min-height: 100vh;
	width: 100vw;
}

#header h1{
	font-size: 80px;
	color: #F5F5F5;
}

#header hr{
	width: 200px;
	border-color: #F5F5F5;
}

#header h4{
	font-size: 20px;
	font-weight: normal;
	color: #F5F5F5;
}





/* A B O U T */




#about{
	padding-top: 80px;
	padding-bottom: 80px;
	background: ;
}

#about h2{
	margin-bottom: 30px;
	color: #F5F5F5;
}

#about p{
	color: #999;
}

#about img{
	width: 180px;
}

@media (max-width: 992px){
	.picture{display: none;}
}



/* C V */



#cv{
	padding-top: 80px;
	padding-bottom: 80px;
	background: #F7F7F7;
}

#cv  hr{
    height: 1px;
    border: none;
    background: #DDD;
    margin: 50px auto;
}

#cv .row h3{
	border-bottom: 3px solid #11ABB0;
	font-size: 24px;
	padding-bottom: 5px;
    width: min-content;
    width: -webkit-min-content;
    width: -moz-min-content;
    width: -ms-min-content;
    width: -o-min-content;
	margin-bottom: 50px;
}

#cv .row{
	margin-bottom: 80px;
}

.skills + .skills{
    margin-top: 60px;

}

.skills > h4{
    color: #11ABB0;
    margin-bottom: 40px;
}

#cv .skill-item + .skill-item{
	margin-top: 30px;
}

#cv .skill-item > h4{
	font-size: 16px;
	color: #222;
}

#cv .skill-item > .progress{
	height: 40px;
	background: #DDD;
}

#cv .skill-item .progress-bar{
	background: #222;
}

.exp + .exp{
    margin-top: 60px;

}

.exp > h4{
    color: #11ABB0;
    margin-bottom: 40px;
}

#cv .box + .box{
    margin-top: 50px;
}

#cv .box h4{
	font-size: 20px;
	color: #222;
}

#cv .box h6{
	color: #11ABB0;
}

#cv .box p{
	color: #888;
}




/* P O R T F O L I O */


#portfolio{
	padding: 80px 0;
    background: #EBEEEE;
}


#portfolio h2{
    padding: 0;
    margin: auto;
    margin-bottom: 50px;
    text-align: center;
    text-transform: uppercase;
    font-size: 30px;
    color: #666;
}

#portfolio img{
	max-width: 100%;
}

#portfolio .row > div{
	margin-bottom: 1.5rem;
    position: relative;
}



#portfolio .row div .overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: calc(100% - 30px);
    transform: scale(0);
    margin: auto;
    opacity: 0;
    -webkit-transition: all .5s ease;
    transition: all .5s ease;
    background: rgba(0, 0, 0, .55);
    border-radius: 20%;
}

#portfolio .row div:hover .overlay {
    opacity: 1;
    transform: scale(1);
    height: 100%;
    border-radius: 0;
}

#portfolio .row div .overlay h3{
    color: #f7f7f7;
    font-size: 20px;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -200%);
            transform: translate(-50%, -200%);
    -ms-transform: translate(-50%, -200%);
    letter-spacing: .05em;
}

.overlay h3.project-title{
    -webkit-transform: translate(-50%, -50%) !important;
            transform: translate(-50%, -50%) !important;
    -ms-transform: translate(-50%, -50%) !important;
}






/*  C O N T A C T */



#contact{
    background: #191919;
    color: #F3F3F3;
    text-align: center;
    padding: 80px 0 100px 0;
}

#contact div.left > span{
    font-size: 80px;
    color: #11ABB0;
    line-height: 0;
}

#contact h4{
    display: inline-block;
    padding-bottom: 5px;
    border-bottom: 2px solid #11ABB0;
    text-align: left;
    text-transform: uppercase;
    color: #F5F5F5;
    font-size: 25px;
}

#form{
    width: 100%;
    margin: auto;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
        -ms-flex-direction: row;
            flex-direction: row;
    -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
}

#form > div {
    position: relative;
    margin-top: 30px;
}

.firstname, .lastname, .email, .tel{
    width: 45%;
}

.subject, .msg{
    width: 100%;
}

.btn-div{
	min-width: 30%;
    max-width: 50%;
    padding: 0;
}

#contact input, textarea{
    text-align: left;
    background: transparent !important;
    border-width: 0 0 1px 0 !important;
    border-color: #DDD;
    display: block;
    width: 100%;
    padding: 0 12px 6px 0;
    font-size: 14px;
    color: #F3F3F3;
    margin-top: 20px !important;
    height: 35px;
    font-family: "Raleway", sans-serif !important;
}

#contact input:focus, #contact textarea:focus{
    outline: none;
}

.focus-border{
    position: absolute;
    display: block;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: #11ABB0;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

input:focus ~ .focus-border, textarea:focus ~ .focus-border{
    width: 100%;
}

#contact textarea{
    resize: vertical;
    overflow-y: auto;
    min-height: 100px;
    max-height: 200px;
}

#contact .btn-send{
    width: 100%;
    cursor: pointer;
    margin-top: 20px;
    background: transparent;
    border-color: #F3F3F3;
    color: #F3F3F3;
    text-transform: uppercase;
    letter-spacing: 1px;
}

#contact .btn-send:hover, #contact .btn-send:focus{
    color: #333;
    background:#F3F3F3;
}

#contact .btn-send:focus{
    outline: none;
}

#contact .btn-send .fa{
    margin-right: 10px;
}

.label{
    -webkit-transition: .4s ease all;
    transition: .4s ease all;
    position: absolute;
    top: 25px !important;
    color: #AAA;
    text-align: left;
    font-size: 16px;
    display: block;
    cursor: text;
    font-family: "Raleway", sans-serif;
}

input:focus ~ .label, textarea:focus ~ .label[for=message], input.has-value ~ .label, textarea.has-value ~ .label[for=message]{
    font-size: 12px !important;
    top: 0px !important;
    color: #11ABB0 !important;
}


.input-info{
    width: 100%;
    color: #11ABB0;
    text-align: left;
}

@media (max-width: 768px){

    #contact .left{
        display: none;
    }

    #contact .row{
    	margin: auto;
    	width: 90%;
    }

    #form{
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
            -ms-flex-direction: column;
                flex-direction: column;
    }

    .firstname, .lastname, .email, .tel, .btn-div{
        width: 100%;
    }

}






/*  F O O T E R  */

footer{
    background: #0F0F0F;
    position: relative;
    padding: 80px;
}

.footer-content{
    text-align: center;
    max-width: 85%;
    margin: auto;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
        -ms-flex-direction: row;
            flex-direction: row;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
}

.footer-content p{
    color: #565656;
}

.footer-content a{
    display: inline-block;
    text-decoration: none;
    font-size: 20px;
    color: #565656;
    -webkit-transition: .3s;
    transition: .3s;
}

.footer-content a:hover{
    color: #FFF;
}

.footer-content a + a{
    margin-left: 30px;
}

footer h4{
    color: #DDD;
    text-transform: uppercase;
    text-align: center;
    margin-bottom: 30px;
    font-size: 18px;
}


@media (max-width: 768px){
	footer{
        padding: 80px 0;
    }

    .footer-content{
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
            -ms-flex-direction: column;
                flex-direction: column;
    }

    .footer-content > div{
        width: 100% !important;
        margin-bottom: 45px;
    }

    .footer-content h4{
        margin-bottom: 20px;
    }

    .footer-content a + a{
        margin-left: 18px;
    }
}

	</style>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">

	<style> 
/*ปรับรูปภาพ*/
.img {
    
    height: 270px;    
  
}

</style>
	
	<?php include('u_bootstrap.php');?>
 
    <link rel="stylesheet" href="style.css">
	
</head>

<body id="body" data-spy="scroll" data-target="#navigation" data-offset="30">

  <div id="header" class="container-fluid d-flex">

    <div class="menu-overlay"></div>

    <div class="menu">
      <div class="toggler">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
      </div>

      <ul class="nav-content" id="navigation">
        <li><a class="nav-link" href="#header">Home</a></li>
		
        <li class="dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop">Books</a>
          <div id="dropdown-menu">
            <ul>
              <li><a class="dropdown-item" href="#knowledge">Knowledge book</a></li>
              <li><a class="dropdown-item" href="#fiction">Fiction book</a></li>
              
            </ul>
          </div>
        </li>
		  
		<li><a class="nav-link" href="#ordering" >Ordering</a></li>
		<li><a class="nav-link" href="#deliverys" >Delivery</a></li>
        <li><a class="nav-link" href="#portfolio">Picture</a></li>
        <li><a class="nav-link" href="#contact">Contact</a></li>
		
      </ul>
    </div>

    <div class="row align-items-center justify-content-center text-center">
      <div>
        <h1>You are Member</h1>
		<h3>Hi, <?php echo $_SESSION['user']; ?></h3>
        <p><a href="logout.php">Logout</a></p>
        
      </div>
    </div>

  </div>

  

  <div class="container-fluid" id="knowledge">
    <div class="container" style="width: 900px">
	<?php
	while($row=mysqli_fetch_array($result)){
	?>	
		
	<div class="col-md-4" >
	<form method="post" action="user_page.php?action=add&id=<?php echo $row['id'];?>"><br>
		
		<br>
			
			
			<img class="img"  src="./img-books/<?php echo $row['b_img'];?>" class="img-responsive" />
			<h5 class="text-info">สินค้า : <?php echo $row['b_name'];?></h4>
			<h4 class="text-danger">ราคา : <?php echo number_format($row['b_price'],2);?> บาท</h4>
			
			<input style="text-align-last: center"  name="quantity" class="form-control" value="1"/>
			<input type="hidden" name="hidden_name" value="<?php echo $row['b_name'];?>"/>
			<input type="hidden" name="hidden_price" value="<?php echo $row['b_price'];?>"/>
			
			<input type="submit" name="aad_product" style="margin-top: 5px;" class="btn btn-success" value="เพิ่มลงตระกร้า" /><br>
		
	</form>	
	</div>
	
	<?php } ?>
	
	
	
	<!--<?php echo '<pre>' .print_r($_SESSION, TRUE). '</pre>';?>-->
</div>
      

     
      <hr id="fiction">

      <div class="row">
        <div class="col-md-2 col-sm-12">
          <h3>Fiction Book</h3>
        </div>
        <h1>กำลังทำ....</h1>
		  
      </div>
		
	  
	  <hr id="ordering">
		<div class="row">
        <div class="col-md-2 col-sm-12">
          <h3>Ordering</h3>
        </div>
		  
		
        <div class="col">

          <br>
  <div style="clear:both;">
	  <p>&nbsp;</p>
	</div>
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
  </div>

        </div>

      </div>
 
		
		<hr id="deliverys">

      <div class="row">
        <div class="col-md-2 col-sm-12">
          <h3>Delivery</h3>
        </div>
        <div class="col-md-9 col-sm-12 offset-md-1">
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
          </form>
        </div>
      </div>
		
    </div>
  </div>

  <div class="container-fluid" id="portfolio">
    <h2>Picture</h2>

    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-xs-12">
          <img src="img-books/9.jpg" width="350" height="400">
          <div class="overlay">
            <h3 class="project-title">คอมมือใหม่</h3>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-xs-12">
          <img src="img-books/5.jpg" width="350" height="400">
          <div class="overlay">
            <h3 class="project-title">Bangtan Boy</h3>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-xs-12">
           <img src="img-books/2.gif" width="350" height="400">
          <div class="overlay">
            <h3 class="project-title"> รักวุ่นๆ เล่ม2 </h3>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-xs-12">
           <img src="img-books/6.gif" width="350" height="400">
          <div class="overlay">
            <h3 class="project-title"> รักวุ่นๆ เล่ม1 </h3>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-xs-12">
          <img src="img-books/10.jpg" width="350" height="400">
          <div class="overlay">
            <h3 class="project-title">ระบบปฎิบัติการเบื้องต้น</h3>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-xs-12">
          <img src="img-books/7.png" width="350" height="400">
          <div class="overlay">
            <h3 class="project-title">วิธีฝึกสมอง</h3>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="container-fluid" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 left">
          <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
        </div>

        <div class="col-lg-8 offset-lg-1">
          <h4>Let's get in touch</h4>

          <form id="form" autocomplete="off" method="post" action="">
            <div class="firstname">
              <input id="firstname" type="text" name="firstname">
              <span class="focus-border"></span>
              <label class="label" for="firstname">Firstname *</label>

            </div>

            <div class="lastname">
              <input id="lastname" type="text" name="lastname">
              <span class="focus-border"></span>
              <label class="label" for="name">Lastname *</label>

            </div>

            <div class="email">
              <input id="email" type="email" name="email">
              <span class="focus-border"></span>
              <label class="label" for="email">Email *</label>

            </div>

            <div class="tel">
              <input id="phone" type="tel" name="phone">
              <span class="focus-border"></span>
              <label class="label" for="phone">Phone</label>

            </div>

            <div class="subject">
              <input id="subject" type="text" name="subject">
              <span class="focus-border"></span>
              <label class="label" for="subject">Subject *</label>

            </div>

            <div class="msg">
              <textarea id="message" name="message"></textarea>
              <span class="focus-border"></span>
              <label class="label" for="message">Message *</label>

            </div>

            <div class="input-info">* required field</div>

            <div class="btn-div">
              <button type="submit" class="button btn-send">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                Send
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>

  <footer>

    <div class="footer-content">

      <div>
        <h4>Location</h4>
        <p>Somewhere</p>
      </div>

      <div>
        <h4>Email</h4>
        <p>example@gmail.com</p>
      </div>

      <div>
        <h4>Phone</h4>
        <p>01 23 45 67 89</p>
      </div>

      <div>
        <h4>Social</h4>

        <a href="https://www.linkedin.com/in/jules-grenier/" target="_blank">
          <i class="fab fa-linkedin-in"></i>
        </a>
        <a href="https://twitter.com/JulesGrenier_" target="_blank">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="https://github.com/JulesGrenier" target="_blank">
          <i class="fab fa-github"></i>
        </a>
        <a href="https://codepen.io/Jules_Grenier/#" target="_blank">
          <i class="fab fa-codepen"></i>
        </a>
      </div>
    </div>

  </footer>


  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script>
  <script>
	$('#navigation a').on('click', function(e) {
  e.preventDefault();
  var hash = this.hash;
  $('html, body').animate({
    scrollTop: $(this.hash).offset().top
  }, 1000);
});


$('.toggler, .nav-content a:not(#dropdown-link)').on('click', function(){
  $('.toggler').toggleClass('change');
  $('.nav-content').slideToggle();
  $('#dropdown-menu').slideUp();
  $('.menu-overlay').toggle();
});

$('.nav-content .dropdown').on('click', function(){
  $('#dropdown-menu').slideToggle();
});

$('.menu-overlay').on('click', function(){
  $('.toggler').removeClass('change');
  $('.nav-content').slideUp();
  $('#dropdown-menu').slideUp();
  $('.menu-overlay').hide();
});

$("#contact input, #contact textarea").on('focusout', function(){

  var text_val = $(this).val();
  if (text_val === "") {
    $(this).removeClass('has-value');
  } else {
    $(this).addClass('has-value');
  }

});
	
  </script>
</body>
</html>
<?php } ?>