<!--::header part start::-->
    <header class="main_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="user_page.php">     </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
							
        					<h3>Hi, <?php echo $_SESSION['user']; ?></h3>
        					
                        <div class="collapse navbar-collapse main-menu-item justify-content-end"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="user_page.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="cart.php">CART</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="confirm.php">ORDERING</a>
                                </li>
                               
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="show-detail.php">SHOW DETAIL</a>
                                </li>
								
								<li class="nav-item">
                                    <p><a  href="logout.php">Logout</a></p>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

     

    <!--::review_part start::-->
    
<!--
        <br /><br />
          <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="section_tittle text-center">
                        <p>recent work</p>
                        <h2>Creative work for client</h2>
                    </div>
                </div>
            </div>	
        
-->
    
    <!--::blog_part end::-->