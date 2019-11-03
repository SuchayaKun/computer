<?php 

    session_start();

    if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ALL PRODUCT</title>
    	
 
      <link rel="stylesheet" href="style.css">
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
		
  		<?php include('menu.php')?>
     	<!-- breadcrumb start-->
     <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>ALL BOOK</h2>
                            <p>Home <span>//</span>About</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->
    
<br /><br />

														 
    </div> <!-- close col-->
  </div> <!-- close row-->
</div>    <!-- close container-->


<!-- start show product -->
<div class="container">
  <div class="row">
    
		
      	<?php include('showproduct_userpage.php');?>
		
    
  </div>
</div>
<!-- end show product -->


<!-- start footer-->

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
		
   	<?php include('footer.php') ?>
		
    </div>
  </div>

<!-- end footer-->

<?php include('script.php')?>
    
  </body>
</html>
<?php } ?>