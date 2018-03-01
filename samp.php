<?php
//error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookrent";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "connected";
}
	catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
	
}
if(isset($_POST['submit'])){
$name=$_POST['name'];
$auth=$_POST['auth'];
$cat=$_POST['cat'];
$price=$_POST['price'];
$copy=$_POST['copy'];


$f_name = rand(1000,100000)."-".$_FILES['img']['name'];
    $file_loc = $_FILES['img']['tmp_name'];
 // $file_size = $_FILES['file']['size'];
 // $file_type = $_FILES['file']['type'];
 $folder="new/";
 if (move_uploaded_file($file_loc,$folder.$f_name)){
	echo "added";
 }

			$stmt = $conn->prepare("INSERT INTO booktbl(bid,book_name,author,category,price,copies,image) VALUES (NULL, :name,:auth,:cat,:price,:copy,:img)");
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':auth',$auth);
			$stmt->bindParam(':cat',$cat);
            $stmt->bindParam(':price',$price);
            $stmt->bindParam(':copy',$copy);
            $stmt->bindParam(':img',$f_name);
                //echo "xxx";  
            $result = $stmt->execute();
			
			if($result>0){
				echo "Registered Successfully";
			}else{
				echo "Failed to Register";
			}
			}
		


?>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
<table>
<tr>
	<td>Book NAme</td><td><input type="text" name="name"></td><tr>
	<td>author NAme</td><td><input type="text" name="auth"></td><tr>
	<td>category</td><td><input type="text" name="cat"></td><tr>
	<td>price</td><td><input type="text" name="price"></td><tr>
	<td>copy</td><td><input type="text" name="copy"></td><tr>
	<td>Book NAme</td><td><input type="file" name="img"></td></tr>
	<input type="submit" name="submit" value="Insert">
</tr>

</table>
</form>
</body>