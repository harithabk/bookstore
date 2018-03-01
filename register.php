<?php
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

?>
<?php
try{
	if(isset($_POST['submit'])){

	$name=$_POST['txtName'];
	$addr = $_POST["txtAddress"];
    $phone = $_POST["txtPhone"];
    $psw = $_POST["txtPassword"];
	if(strlen($_POST['txtPassword']<6)){
		$err_msg="Password must be more than 6";
	}else{
		$psw=$_POST['txtPassword'];
	}
	// Checks for already registered mail
		$email = $_POST["txtEmail"];
		 $qry=$conn->prepare("select email from tblusers where email=:email ") ;
					// $_SESSION['login_username']=$email;
					 $qry->execute(["email"=>$email]);
					
					 if($qry->rowCount()==1){
						$err_msg= "Email is already registered";
					 }else{
						 $email = $_POST["txtEmail"];
						//echo "fail";
					 }
    
	
	// $mail->bindParam(':email', $email);
	// $mail->execute();
	// if($mail->rowCount() > 0){
    // $err_msg ="exists! cannot insert";
	// } else {
	// $check_mail=$pdo->prepare("SELECT email from tblusers where email=:email");
	// $check_mail->execute(["email"=>$email]);

	// if($check_mail->rowCount()==1){
		// $err_msg="Email Already Exists";
	// }else{
	
			$stmt = $conn->prepare("INSERT INTO tblusers(uid,name,phone,address,email,password) VALUES (NULL, :name,:phone,:addr,:email,:psw)");

            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':phone',$phone);
            $stmt->bindParam(':addr',$addr);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':psw',$psw);
                   
            $result = $stmt->execute();
			
			if($result>0){
				$err_msg="Registered Successfully";
			}else{
				$err_msg="Failed to Register";
			}
	}
		
	
}catch(PDOException $e) {
	echo $err_msg;
}


?>

<?php

if(isset($_POST['login'])){
			session_start();
 
					$email=$_POST['email'];
					$pswd=$_POST['pswd'];
					//try{
					 $qry=$conn->prepare("select email,password,name from tblusers where email=:email AND password=:pswd") ;
					 $_SESSION['login_username']=$email;
					 $qry->execute(["email"=>$email,"pswd"=>$pswd]);
					
					 if($qry->rowCount()==1){
						 header("Location:http://localhost/BookStore/index2.php");
						echo "success";
						echo $_SESSION['login_username'];
					 }else{
						 $error_msg= "User Name or password is incorrect";
						//echo "fail";
					 }
					}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<style>
.error {color: #FF0000;}
</style>
</head>

<body>
   <?php
    include('header.php');
?>

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>New account / Sign in</li>
                    </ul>

                </div>
	
				<!-- Successful message -->
				<div>
					
				</div>
						
                <div class="col-md-6">
                    <div class="box">
                        <h1>New account</h1>

                        <p class="lead">Not our registered customer yet?</p>
						<span class="error"><?php echo $err_msg;?></span>
                        <!-- <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p> -->

                        <hr>
						
						<!-- Validation check
					________________________________-->

	
                        <form method="post" enctype="multipart/form-data" id="FormId">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="txtName" placeholder="Name" required><span id="nameerrormsg"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Address</label>
                                <textarea name="txtAddress" id="address" class="form-control" rows="5" cols="25" required="required" placeholder="Address" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" id="Phone" name="txtPhone" maxlength="10" placeholder="Phone Number" required />
                                <span id="phoneerrormsg"></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="Email" name="txtEmail" placeholder="Email ID" required><span id="emailerrormsg" value="0"></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="txtPassword" placeholder="Password must contain atleast 6 characters" required>
								<span class="error"><?php echo $err_msgs;?></span>
                            </div>
                            <div id="formsubmitbutton" class="text-center">
                                <input type="submit" name="submit" class="btn btn-primary submitBtn"  value="Register"> 
                            </div>
                            <div id="buttonreplacement" style="display:none;">  
                                <img src="img/AjaxLoader.gif" alt="loading..." width="70" height="70" class=" pull-right"/>
                            </div>
                        </form>
                        <div id="register_alert"></div>
                    </div>
                </div>

                <!--- Login
				_________________________________________________ -->

                <div class="col-md-6">
                    <div class="box">
                        <h1>Login</h1>

                        <p class="lead">Already our customer?</p>
                        
                        <hr>

                       <!-- <form action="customer-orders.html" method="post">-->
					   
					   				
					   <span class="error"><?php echo $error_msg;?></span>
					   
						<form  method="post" action="">
						
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="pswd" required>
                            </div>
                            <div class="text-center">
                               <!-- <button type="submit" class="btn btn-primary" name="login"><i class="fa fa-sign-in"></i> Log in</button>-->
							   <input type="submit" name="login" class="btn btn-primary" value="Login"><i class="fa fa-sign-in"></i> 
                             </div>
                        </form>
                    </div>
                </div>

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
     
                <script type="text/javascript">
                // $(document).ready(function(e){
                    // $("#FormId").on('submit', function(e){
                        //alert('hello');
                        // e.preventDefault();
                        // document.getElementById("buttonreplacement").style.display = "";
                        // $.ajax({
                            // type: 'POST',
                            // url: 'reg.php',
                            // data: new FormData(this),
                            // contentType: false,
                            // cache: false,
                            // processData:false,
                            // success :function(msg){
                                // $('#register_alert').text(msg);
                            // }   
                            // beforeSend: function(){
                                // $('.submitBtn').attr("disabled","disabled");
                                // $('#fupForm').css("opacity",".5");
                            // },
                            // success: function(msg){
                                // document.getElementById("buttonreplacement").style.display = "none";
                                // if ($.trim(msg) === "ok"){
                                    // $('#register_alert').html("<div class='alert alert-success alert-dismissable fade in'><a href='register.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success..!</strong><br> <p align='center' >You are successfully registered </p></div>").delay(3000).fadeOut('slow',function() { $(this).remove(); });
                                    // $('#name').val('');
                                    // $('#Email').val('');
                                    // $('#Phone').val('');
                                    // $('#address').val('');
                                    // $('#password').val('');
                                // }else {
                                    // $('#exist_alert').html('<div class="alert alert-danger alert-dismissable fade in "><a href="register.php" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning..!</strong><br> <p align="center" >Email ID Already existing..!</p></div>').delay(3000).fadeOut('slow',function() { $(this).remove(); });
                                // }
                                // $('#fupForm').css("opacity","");
                                // $(".submitBtn").removeAttr("disabled");
                            // }
                        // });
                    // });
                // });
                
            </script>
        
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>
    <script src="js/validation.js"></script>


</body>

</html>
<!--- Login --->
<?php

?>
