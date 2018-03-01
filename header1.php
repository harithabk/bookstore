<?php 
session_start();
// if(isset($_SESSION['tblusers']))
// {
	// $cid=$_SESSION['tblusers'];
	// $f_name=$_SESSION['name'];
	// $customername="logout (" . $f_name . ")";
// }
 // $_SESSION['login_username'];
 	error_reporting(0);
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
$mail=$_SESSION['login_username'];
 $qry1=$conn->prepare('select uid from tblusers where email=:mail');
 $qry1->execute(["mail"=>$mail]);
 if($qry1->rowCount()>0){
 while($row=$qry1->fetch(PDO::FETCH_ASSOC)){
	$uid=$row['uid'];
 }
 }
?>

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Book Store Rental system">
    <!-- <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz"> -->
    <meta name="keywords" content="Book store, Rent books">

    <title>
        Book Rental : Book Store
    </title>

    <meta name="keywords" content="Book store, Rent books">

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

    <script src="js/jquery.min.js"></script>
</head>

<body>
 <!-- *** TOPBAR ***
 __________
 _______________________________________________ -->
    <div id="top">
        <div class="container">
            <!-- <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  <a href="#">Get flat 35% off on orders over $50!</a>
            </div> -->
            <div style="text-align: right;" data-animate="fadeInDown">
                <ul class="menu" style="font-size: 15px;">
                    <!-- <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a> </li>-->
                    <li><a href="index.php"><i class="fa fa-user"></i>  <?php echo $_SESSION['login_username']?> </a></li>
                  
                    </li>
                    <li><a href="contact.html">Contact</a>
                    </li>
                    <!--<li><a href="#">Recently viewed</a>-->
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

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <!-- <img src="img/logo.png" alt="Obaju logo" class="hidden-xs">
                    <img src="img/logo-small.png" alt="Obaju logo" class="visible-xs"><span class="sr-only">Obaju - go to homep age</span> -->
                    <h3 style="font-family: cursive;">E~<span style="color: #4fbfa8">Book</span>Rental</h3>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                    <a class="btn btn-default navbar-toggle" href="cart1.php">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">3 items in cart</span>
                    </a>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="index.php">Home</a>
                    </li>
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Category <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                           <!-- <h5>10th class</h5>-->
                                            <ul>
                                                <li><a href="category.html">10th Class</a>
                                                </li>
                                                <li><a href="category.html">12th Class(Pre-University)</a>
                                                </li>
                                                <li><a href="category.html">Under Graduates</a>
                                                </li>
                                                <li><a href="category.html">Post Graduates</a>
                                                </li>
												<li><a href="category.html">Other Books...</a>
                                                </li>
                                            </ul>
                                        </div>
                                       <!-- <div class="col-sm-3">
                                            <h5>12th class(Pre-University)</h5>
                                            <ul>
                                                <li><a href="category.html">CSBA</a>
                                                </li>
                                                <li><a href="category.html">SEBA</a>
                                                </li>
                                                <li><a href="category.html">PCMC</a>
                                                </li>
                                                <li><a href="category.html">PCMB</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Under Graduate</h5>
                                            <ul>
                                                <li><a href="category.html">BCA</a>
                                                </li>
                                                <li><a href="category.html">BBM</a>
                                                </li>
                                                <li><a href="category.html">BCom</a>
                                                </li>
                                                <li><a href="category.html">BSC</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Post Graduate</h5>
                                            <ul>
                                                <li><a href="category.html">MCA</a>
                                                </li>
                                                <li><a href="category.html">MSc</a>
                                                </li>
                                                <li><a href="category.html">MBA</a>
                                                </li>
                                                <li><a href="category.html">MCom</a>
                                                </li>
                                            </ul>
                                        </div>-->
                                        
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>

                    
            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">

                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="cart1.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">
					<?php 
							$numOfRecrd = $conn->query("select count(cartid) from  tblcart where uid=".$uid)->fetchColumn();
							//$numOfRecrd->execute(["uid"=>$uid]);
							$numOfRecrd=$numOfRecrd;
							
							echo "".$numOfRecrd . " items in cart" ;?></span></a>
					
					
                </div>
                <!--/.nav-collapse -->

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>

            <div class="collapse clearfix" id="search">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn"><button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button></span>
                    </div>
                </form>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

</body>