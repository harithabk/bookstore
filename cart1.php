<!DOCTYPE html>
<html lang="en">

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

 $chkbox = $_POST['book'];
 $i = 0;
 While($i < sizeof($chkbox))
 {
 echo "CheckBox Selected Values = " . $chkbox[$i] . '</br>';
 $x=$chkbox[$i];
 //echo $x;
 $qry=$conn->prepare('select * from booktbl where bid=:x');
 $qry->execute(["x"=>$x]);
 if($qry->rowCount()>0){
 while($row=$qry->fetch(PDO::FETCH_ASSOC)){
	$bid=$row['bid'];
	$book_name=$row['book_name'];
	$image=$row['image'];
	$price=$row['price'];
 }
 }
 $i++;
 }
 $mail= $_SESSION['login_username'];
 echo $mail;
 $qry1=$conn->prepare('select uid from tblusers where email=:mail');
 $qry1->execute(["mail"=>$mail]);
 if($qry1->rowCount()>0){
 while($row=$qry1->fetch(PDO::FETCH_ASSOC)){
	$uid=$row['uid'];
	echo $uid."ddd: ".$mail;
 }
 }
 $quantity=1;
 $total=$price*$quantity;
//echo "total".$total;


 ?>
	
<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Book Rental : Book Store
    </title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="shortcut icon" href="favicon.png">



</head>

<body>
    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <!--<div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  <a href="#">Get flat 35% off on orders over $50!</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                    </li>
                    <li><a href="register.html">Register</a>
                    </li>
                    <li><a href="contact.html">Contact</a>
                    </li>
                    <li><a href="#">Recently viewed</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="customer-orders.html" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" placeholder="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" placeholder="password">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.html"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

  
            <!--/.nav-collapse -->

           
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index2.php">Home</a>
                        </li>
                        <li>Shopping cart</li>
                    </ul>
                </div>
				
				<!-- Inserting into table -->
				
				
                <div class="col-md-9" id="basket">

                    <div class="box">

                        <form method="post" action="checkout1.html">

                            <h1>Shopping cart</h1>
							<?php 
							$numOfRecrd = $conn->query("select count(cartid) from  tblcart where uid=".$uid)->fetchColumn();
							//$numOfRecrd->execute(["uid"=>$uid]);
							echo "You currently have ".$numOfRecrd . " items in cart" ;?></span></a>
							
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Discount</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									
						$sth = $conn->prepare("SELECT * FROM tblcart where uid=:uid");
						$sth->execute(["uid"=>$uid]);
						$sth->execute();
					 //$qry3=$conn->prepare('select * from tblcart ');
						//$qry->execute(["x"=>$x]);
						// if($qry3->rowCount()>0){
						// while($row=$qry3->fetch(PDO::FETCH_ASSOC)){
						  if($sth->rowCount()):

											while($row = $sth->fetch(PDO::FETCH_ASSOC)){ 
						//echo "xxx";
						$bid=$row['bid'];
						$book_name=$row['book_name'];
						$image=$row['image'];
						$price=$row['price'];
						//echo $price;
					
                                       echo " <tr>";
                                           echo " <td>";
                                             echo "  <a href='#'>";
                                                  // <img src='img/detailsquare.jpg' alt='White Blouse Armani'>
													echo "<img src=new/". $row['image']." alt='yyy' class='img-responsive'>";
                                                echo "</a>";
                                            echo "</td>";
                                            echo "<td><a href='#'>". $row['book_name']."</a>";
                                            echo "</td>";
                                            echo "<td>";
                                             echo " <input type='number' value='1' class='form-control'>";
                                            echo "</td>";
                                            echo "<td>".$row['price']."</td>";
                                           // <!--echo "<td>$0.00</td>
                                            //echo "<td>$246.00</td>";-->
											echo "<td>discount</td>";
											echo "<td>".$row['total']."</td>";
                                            echo "<td><a href='#'><i class='fa fa-trash-o'></i></a>
                                          </td>
                                       </tr>";
										 } 
										 endif; 
										 
										 echo "</tbody>";
										 echo "</table>";?>
										<!--//}
                                        // <tr>
                                            // <td>
                                                // <a href="#">
                                                    // <img src="img/basketsquare.jpg" alt="Black Blouse Armani">
                                                // </a>
                                            // </td>
                                            // <td><a href="#">Black Blouse Armani</a>
                                            // </td>
                                            // <td>
                                                // <input type="number" value="1" class="form-control">
                                            // </td>
                                            // <td>$200.00</td>
                                            // <td>$0.00</td>
                                            // <td>$200.00</td>
                                            // <td><a href="#"><i class="fa fa-trash-o"></i></a>
                                            // </td>
                                        // </tr>
                                    // </tbody>
                                    // <tfoot>
                                        // <tr>
                                            // <th colspan="5">Total</th>
                                            // <th colspan="2">$446.00</th>
                                        // </tr>
                                    // </tfoot>
                                // </table>

                            // </div>
                            // <!-- /.table-responsive -->

                             <div class="box-footer">
                                 <div class="pull-left">
                                     <a href="category.html" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                                 </div>
                                 <div class="pull-right">
                                     <button class="btn btn-default"><i class="fa fa-refresh"></i> Update basket</button>
                                     <button type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i>
                                     </button>
                                 </div>
                             </div>

                         </form>

                     </div>
                     <!-- /.box -->


                     <div class="row same-height-row">
                         <div class="col-md-3 col-sm-6">
                             <div class="box same-height">
                                 <h3>You may also like these products</h3>
                             </div>
                         </div>

                         <div class="col-md-3 col-sm-6">
                             <div class="product same-height">
                                 <div class="flip-container">
                                    <div class="flipper">
                                         <div class="front">
                                             <a href="detail.html">
                                                 <img src="img/product2.jpg" alt="" class="img-responsive">
                                             </a>
                                         </div>
                                         <div class="back">
                                             <a href="detail.html">
                                                 <img src="img/product2_2.jpg" alt="" class="img-responsive">
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                                 <a href="detail.html" class="invisible">
                                     <img src="img/product2.jpg" alt="" class="img-responsive">
                                </a>
                                 <div class="text">
                                     <h3>Fur coat</h3>
                                     <p class="price">$143</p>
                                 </div>
                             </div>
                             <!-- /.product -->
                        </div>

                         <div class="col-md-3 col-sm-6">
                             <div class="product same-height">
                                 <div class="flip-container">
                                     <div class="flipper">
                                        <div class="front">
                                             <a href="detail.html">
                                                 <img src="img/product1.jpg" alt="" class="img-responsive">
                                             </a>
                                        </div>
                                         <div class="back">
                                             <a href="detail.html">
                                                 <img src="img/product1_2.jpg" alt="" class="img-responsive">
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                                 <a href="detail.html" class="invisible">
                                     <img src="img/product1.jpg" alt="" class="img-responsive">
                                 </a>
                                 <div class="text">
                                     <h3>Fur coat</h3>
                                     <p class="price">$143</p>
                                 </div>
                             </div>
                             <!-- /.product -->
                         </div>


						 <div class="col-md-3 col-sm-6">
                             <div class="product same-height">
                                 <div class="flip-container">
                                     <div class="flipper">
                                        <div class="front">
                                             <a href="detail.html">
                                                 <img src="img/product3.jpg" alt="" class="img-responsive">
                                             </a>
                                         </div>
                                         <div class="back">
                                             <a href="detail.html">
                                                 <img src="img/product3_2.jpg" alt="" class="img-responsive">
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                                 <a href="detail.html" class="invisible">
                                     <img src="img/product3.jpg" alt="" class="img-responsive">
                                 </a>
                                 <div class="text">
                                     <h3>Fur coat</h3>
                                     <p class="price">$143</p>

                                 </div>
                             </div>
                             <!-- /.product -->
                         </div>

                     </div>


                 </div>
                 <!-- /.col-md-9 -->

                <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Order summary</h3>
                        </div>
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                      <!--  <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Order subtotal</td>
                                        <th>$446.00</th>
                                    </tr>
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th>$10.00</th>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <th>$0.00</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th>$456.00</th>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>

                    </div> 


                    <div class="box">
                        <div class="box-header">
                            <h4>Coupon code</h4>
                        </div>
                        <p class="text-muted">If you have a coupon code, please enter it in the box below.</p>
                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control">

                                <span class="input-group-btn">

					<button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>

				    </span>
                            </div>
                            <!-- /input-group -->
                        </form>
                    </div>

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
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