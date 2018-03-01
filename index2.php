<!DOCTYPE html>
<html lang="en">
<head>
<script>
$(document).ready(function(){
	$(".proceed").keypress(function(event){
		
	
	}
}); 
</script>

<style>
.check { position: absolute; top: 10px; right: 180px; }
</style>
</head>
<?php
	include('header1.php');
	
		$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookrent";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "connected";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
	
}
?>
<body>

       <div id="all">

        <div id="content">

            <div class="container">
                <div class="col-md-12">
                    <div id="main-slider">
                        <div class="item">
                            <img class="img-responsive" src="img/slide-books4.jpg" alt="E-BookStore2">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/slide-books3.jpg" alt="E-BookStore3">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/slide-books1.jpg" alt="E-BookStore4">
                        </div>
                    </div>
                    <!-- /#main-slider -->
                </div>
            </div>

            <!-- *** ADVANTAGES HOMEPAGE ***
 _________________________________________________________ -->
            <div id="advantages">

                <div class="container">
                    <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height">
                                <div class="icon"><i class="fa fa-heart"></i>
                                </div>

                                <h3 style="color: #4fbfa8">We love our <br>customers</h3>
                                <p>We are known to provide best possible services.</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height">
                                <div class="icon"><i class="fa fa-tags"></i>
                                </div>

                                <h3 style="color: #4fbfa8">We offer you with <br> discounted prices</h3>
                                <p>The provided services will be worth.</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height">
                                <div class="icon"><i class="fa fa-thumbs-up"></i>
                                </div>

                                <h3 style="color: #4fbfa8">100% satisfaction guaranteed</h3>
                                <p>Free returns on everything for 3 months.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /#advantages -->

            <!-- *** ADVANTAGES END *** -->

            <!-- *** HOT PRODUCT SLIDESHOW ***
 _________________________________________________________ -->
            <div id="hot">

                <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2>Hot this week</h2>
                        </div>
                    </div>
                </div>



		<form action="cart.php" method="post">
               <div class='container'>

                    <div class='product-slider'>
				 
				 			   <?php
//--------- Display in main Page --------------------------//
	//$qry="SELECT * FROM booktbl";
	//$stmt=$conn->query($qry);
	$stmt=$conn->prepare('select * from booktbl');
	$stmt->execute();
	//$imgfile=$_FILES[
	if($stmt->rowCount() > 0){
//echo "hhh";
        while($row = $stmt->fetch()){
                    echo "    <div class='item'>";
                        echo "    <div class='product'>";
						
                             // echo "   <div class='flip-container'>";
                                   // echo " <div class='flipper''>";
                                     // echo "   <div class='front'>";
									 
                                          echo "   <a href='detail.html'>";
                                               //<img src='img/product1.jpg' alt="" class=img-responsive'>
											    echo "   <img src=new/".$row['image']." alt='yyy' class='img-responsive'>";
                                            echo " </a>";
											echo "<input type='checkbox' name='book[]' value='$row[bid]' class='check'>";
                                        // echo "</div>";//  <!-- /.front -->
                                        // echo "<div class='back'>";
                                           // echo " <a href='detail.html'>";
                                                //<img src="img/product1_2.jpg" alt="" class="img-responsive">
												// echo "   <img src=new/".$row['image']." alt='xxx' class='img-responsive'>";
                                           // echo " </a>";
                                        // echo "</div> "; // <!-- /.back -->
                                   // echo " </div> "; // <!-- /.flipper -->
                                // echo "</div> "; // <!-- /.flip-container -->
                                // echo "<a href='detail.html' class='invisible'>";
                                  // <img src="img/product1.jpg" alt="" class="img-responsive">
								   // echo "   <img src=new/".$row['image']." alt='xxx' class='img-responsive'>";
                                // echo "</a>";
                                echo "<div class='text'>";
                                    echo "<h3><a href='detail.html'>".$row['book_name']."</a></h3>";
                                    echo "<p class='price'>₹".$row['price']."</p>";
									echo "<p class=''><i class='fa fa-shopping-cart'></i><a href='cart.php?id=$row[bid]'>Add To Cart</a></p>";
                                echo "</div> "; // <!-- /.text -->
                                
                            echo "</div>"; //  <!-- /.product -->
                            
                        echo "</div>" ;//  <!-- /.item -->

                        

                        

                        
   }
}
?>
                        

                        

                        
                        

                    </div>   <!-- /.product-slider -->
				   
				
                   <center><a href="cart.php"><i class="fa fa-shopping-cart"><input type="submit" value="Proceed" name="proceed" class="btn btn-primary submitBtn" align="center" id="proceed"></a></i></center> 
                </div>  <!-- /.container -->
               </form>
		
            </div>  <!-- /#hot -->
            

            <!-- *** HOT END *** -->

            <!-- *** GET INSPIRED ***
 _________________________________________________________ -->
            <div class="container" data-animate="fadeInUpBig">
                <div class="col-md-12">
                    <div class="box slideshow">
                        <h3>Get Inspired</h3>
                        <p class="lead">Get the inspiration from our world class designers</p>
                        <div id="get-inspired" class="owl-carousel owl-theme">
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired1.jpg" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired2.jpg" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired3.jpg" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *** GET INSPIRED END *** -->

            <!-- *** BLOG HOMEPAGE ***
 _________________________________________________________ -->

            <div class="box text-center" data-animate="fadeInUp">
                <div class="container">
                    <div class="col-md-12">
                        <h3 class="text-uppercase">From our blog</h3>

                        <p class="lead">What's new in the world of fashion? <a href="blog.html">Check our blog!</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="container">

                <div class="col-md-12" data-animate="fadeInUp">

                    <div id="blog-homepage" class="row">
                        <div class="col-sm-6">
                            <div class="post">
                                <h4><a href="post.html">Fashion now</a></h4>
                                <p class="author-category">By <a href="#">John Slim</a> in <a href="">Fashion and style</a>
                                </p>
                                <hr>
                                <p class="intro">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean
                                    ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                                <p class="read-more"><a href="post.html" class="btn btn-primary">Continue reading</a>
                                </p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="post">
                                <h4><a href="post.html">Who is who - example blog post</a></h4>
                                <p class="author-category">By <a href="#">John Slim</a> in <a href="">About Minimal</a>
                                </p>
                                <hr>
                                <p class="intro">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean
                                    ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                                <p class="read-more"><a href="post.html" class="btn btn-primary">Continue reading</a>
                                </p>
                            </div>

                        </div>

                    </div>
                    <!-- /#blog-homepage -->
                </div>
            </div>
            <!-- /.container -->

            <!-- *** BLOG HOMEPAGE END *** -->


        </div>
        <!-- /#content -->

        <!-- *** FOOTER ***
 _________________________________________________________ -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>Pages</h4>

                        <ul>
                            <li><a href="text.html">About us</a>
                            </li>
                            <li><a href="text.html">Terms and conditions</a>
                            </li>
                            <li><a href="faq.html">FAQ</a>
                            </li>
                            <li><a href="contact.html">Contact us</a>
                            </li>
                        </ul>

                        <hr>

                        <h4>User section</h4>

                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                            </li>
                            <li><a href="register.html">Regiter</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Top categories</h4>

                        <h5>Men</h5>

                        <ul>
                            <li><a href="category.html">T-shirts</a>
                            </li>
                            <li><a href="category.html">Shirts</a>
                            </li>
                            <li><a href="category.html">Accessories</a>
                            </li>
                        </ul>

                        <h5>Ladies</h5>
                        <ul>
                            <li><a href="category.html">T-shirts</a>
                            </li>
                            <li><a href="category.html">Skirts</a>
                            </li>
                            <li><a href="category.html">Pants</a>
                            </li>
                            <li><a href="category.html">Accessories</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Where to find us</h4>

                        <p><strong>Obaju Ltd.</strong>
                            <br>13/25 New Avenue
                            <br>New Heaven
                            <br>45Y 73J
                            <br>England
                            <br>
                            <strong>Great Britain</strong>
                        </p>

                        <a href="contact.html">Go to contact page</a>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                        <h4>Get the news</h4>

                        <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control">

                                <span class="input-group-btn">

			    <button class="btn btn-default" type="button">Subscribe!</button>

			</span>

                            </div>
                            <!-- /input-group -->
                        </form>

                        <hr>

                        <h4>Stay in touch</h4>

                        <p class="social">
                            <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                        </p>


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2015 Your name goes here.</p>

                </div>
                <div class="col-md-6">
                    <p class="pull-right">Template by <a href="https://bootstrapious.com/e-commerce-templates">Bootstrapious</a> & <a href="https://fity.cz">Fity</a>
                         <!-- Not removing these links is part of the license conditions of the template. Thanks for understanding :) If you want to use the template without the attribution links, you can do so after supporting further themes development at https://bootstrapious.com/donate  -->
                    </p>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->



    </div>
    <!-- /#all -->


    

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>


</body>

</html>