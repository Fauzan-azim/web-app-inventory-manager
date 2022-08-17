<?php 
session_start();

$conn = mysqli_connect('localhost','root','','invmanager');

if(!$conn){
	echo "<script>alert('connection-failed');</alert>";
}

	//register
	if (isset($_POST['submit'])) {

			function validateEmail($data){
				$data = $_POST['email'];
				$Val_email = filter_var($data, FILTER_VALIDATE_EMAIL);
				return $Val_email;
			}
			//remowe undefined character
			function validate($data){
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		$CompName = validate($_POST['compname']);
		$CompAddress = validate($_POST['compaddr']);
		$phone = validate($_POST['phone']);
		$zipcode = validate($_POST['zipcode']);
		$email = validateEmail($_POST['email']);
		$password = validate($_POST['password']);
		$firstname =  validate($_POST['fname']);
		$lastname = validate( $_POST['lname'] );
		$re_pass = validate($_POST['re_password']);
		$username = validate($_POST['username']);

		$fullname= $firstname. " " .$lastname;
		$user_data = 'email='. $email. '&password='. $password;
		$level = "guest";

		if(empty($password && $username && $re_pass && $email )){
			header("Location: register.php?error=All input is required");
			exit();
		}
		else if(!$fullname || empty($firstname) || empty($lastname)){
			header("Location: register.php?error=Fill your first and last name");
			exit();
		}
		else if (empty($email) || !$email) {
			header("Location: register.php?error=Email Invalid or empty");
			exit();
		}else if(empty($password)){
			header("Location: register.php?error=Password is required");
			exit();
		}else if (empty($phone)) {
			header("Location: register.php?error= Give your phone number");
			exit();
		}else if (empty($zipcode)) {
			header("Location: register.php?error= Zipcode is required");
			exit();
		}
		else if(empty($re_pass)){
			header("Location: register.php?error=Re Password is required");
			exit();
		}
		else if($password !== $re_pass){
			header("Location: register.php?error=The confirmation password  does not match");
			exit();
		}else if(empty($username)){
			header("Location: register.php?error=Username is required");
			exit();
		} 

		else{

			// hashing the password
			$password = md5($password);

			$sql = "SELECT * FROM users WHERE email='$email' ";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				header("Location: register.php?error=The email is already taken &$user_data");
				exit();
			}else {
				$sql2 = "INSERT INTO users(Fullname,CompName, CompAddress, email,phone,zipcode, password, username,level) VALUES('$fullname','$CompName','$CompAddress','$email','$phone','$zipcode', '$password', '$username', '$level')";
				$result2 = mysqli_query($conn, $sql2);
				if ($result2) {
					header("Location: register.php?success=Your account has been created successfully");
					exit();
				}else {

						header("Location: register.php?error=unknown error occurred");
						exit();
				}
			}
		}
		
	}


	//add new item
	if(isset($_POST['addNewItem'])){
		$itemName = $_POST['Name'];
		$Description = $_POST['Description'];
		$stock = $_POST['stock'];

		//image
		$allowed_extension = array('png','jpg');
		$imgName = $_FILES['image']['name'];
		$imgSize = $_FILES['image']['size'];
		$file_tmp = $_FILES['image']['tmp_name'];//get file location
		$dot = explode('.',$imgName);
		$extension = strtolower(end($dot));//get extension
		

		//image naming with encyption
		$image = md5(uniqid($imgName,true) . time()).'.'. $extension;//combine encrypted name to its extension


		//validate existing item names
		$check = mysqli_query($conn,"SELECT * FROM inventories WHERE `Name` = '$itemName'");
		$countItem = mysqli_num_rows($check);


		if($countItem <1){
			
			//upload image process
			if(in_array($extension, $allowed_extension) === true){
				//validate imgsize max 15mb
				if($imgSize < 15000000){

					move_uploaded_file($file_tmp, 'assets/img/itemImg/' .$image);

					$addtotable = mysqli_query($conn, "INSERT INTO `inventories`(`Name`, `Desc`, `stock`,`image`) VALUES ('$itemName','$Description','$stock','$image')");
					if($addtotable){
						header('location:index_admin.php');
					}else{
						echo '<script>alert("Failed");</script>';
					} 
				}else{
					echo '<script>alert("File size too big");
					window.location.href="index_admin.php";</script>';
				}

			}else if($imgSize == 0){
				//not upload an img only add

				$addtotable = mysqli_query($conn, "INSERT INTO `inventories`(`Name`, `Desc`, `stock`) VALUES ('$itemName','$Description','$stock')");
					if($addtotable){
						header('location:index_admin.php');
					}else{
						echo '<script>alert("Failed");</script>';
					} 
			}else{
				//if image not png/jpg
				echo '<script>alert("File must be png or jpg");window.location.href="index_admin.php";</script>';
			}

		}else{
			echo '<script>alert("Existing item name");window.location.href="index_admin.php";</script>';
		}
		
	}

	//Update item info
	if(isset($_POST['UpdateItem'])){
		$id = $_POST['ids'];
		$itemName = $_POST['Name'];
		$Description = $_POST['Description'];

		//image
		$allowed_extension = array('png','jpg');
		$imgName = $_FILES['image']['name'];
		$imgSize = $_FILES['image']['size'];
		$file_tmp = $_FILES['image']['tmp_name'];//get file location
		$dot = explode('.',$imgName);
		$extension = strtolower(end($dot));//get extension
		

		//image naming with encyption
		$image = md5(uniqid($imgName,true) . time()).'.'. $extension;//combine encrypted name to its extension

		if($imgSize == 0){//just edit not upload img
			$update = mysqli_query($conn, "UPDATE `inventories` SET `Name`= '$itemName',`Desc`='$Description'
			where `id-item` ='$id'");
			if ($update) {
				header('location:index_admin.php');
			} else {
				echo 'Failed';
				header('location:index_admin.php');
			}
		}else{
			//upload image process
			if(in_array($extension, $allowed_extension) === true){
				//validate imgsize max 15mb
				if($imgSize < 15000000){

					move_uploaded_file($file_tmp, 'assets/img/itemImg/' .$image);

					$addtotable = mysqli_query($conn, "UPDATE `inventories` SET `Name`= '$itemName',`Desc`='$Description',
					`image`='$image' where `id-item` ='$id'");
					if($addtotable){
						header('location:index_admin.php');
					}else{
						echo '<script>alert("Failed");</script>';
					} 
				}else{
					echo '<script>alert("File size too big");
					window.location.href="index_admin.php";</script>';
				}

			}else if($imgSize == 0){
				//not upload an img only add

				$addtotable = mysqli_query($conn, "INSERT INTO `inventories`(`Name`, `Desc`, `stock`) VALUES ('$itemName','$Description','$stock')");
					if($addtotable){
						header('location:index_admin.php');
					}else{
						echo '<script>alert("Failed");</script>';
					} 
			}else{
				//if image not png/jpg
				echo '<script>alert("File must be png or jpg");window.location.href="index_admin.php";</script>';
			}
		}
	}

	// Deleting item from stock
	if (isset($_POST['DeleteItem'])) {
		$id = $_POST['ids'];

		$query = mysqli_query($conn, "SELECT * FROM inventories Where `id-item`='$id' ");
		$getImg = mysqli_fetch_array($query);
		$img = 'assets/img/itemImg/'.$getImg['image'];
		//delete file image
		unlink($img);

		$delete = mysqli_query($conn, "DELETE FROM `inventories` where `id-item`='$id'");

		if ($delete) {
			header('location:index_admin.php');
		} else {
			echo 'Failed';
			header('location:index_admin.php');
		}
	}

	//add item-in list
	if(isset($_POST['item-in'])){
		$item = $_POST['item'];
		$receiver = $_POST['receiver'];
		$qty = $_POST['qty'];

		$checkCurrStock = mysqli_query($conn, "SELECT * FROM `inventories` where `id-item`='$item'");
		$getData = mysqli_fetch_array($checkCurrStock);

		$CurrentStock = $getData['stock'];
		$addCurStockWithQty = $CurrentStock + $qty;

		$addtoItemIn = mysqli_query($conn, "INSERT INTO `item-in`(`id-item`, `assignee`,`qty` ) VALUES ('$item','$receiver','$qty')" );
		$updateStock =  mysqli_query($conn, "UPDATE `inventories` SET `stock`= '$addCurStockWithQty' where `id-item`='$item' ");

		if($addtoItemIn && $updateStock){
			header('location:Incoming-Items_admin.php');

		}else{
			echo '<script>alert("Failed");history.go(-1);</script>';
		}
	}

	//add item-out list
	if(isset($_POST['item-out'])){
		$item = $_POST['item'];
		$receiver = $_POST['receiver'];
		$qty = $_POST['qty'];

		$checkCurrStock = mysqli_query($conn, "SELECT * FROM `inventories` where `id-item`='$item'");
		$getData = mysqli_fetch_array($checkCurrStock);

		$CurrentStock = $getData['stock'];
		$SubstCurStockWithQty = $CurrentStock - $qty;

		$addtoItemOut = mysqli_query($conn, "INSERT INTO `item-out`(`id-item`, `Receiver`,`qty` ) VALUES ('$item','$receiver','$qty')" );
		$updateStock =  mysqli_query($conn, "UPDATE `inventories` SET `stock`= '$SubstCurStockWithQty' where `id-item`='$item' ");

		if($addtoItemOut && $updateStock){
			header('location:Outgoing-Items_admin.php');

		}else{
			echo '<script>alert("Failed");history.go(-1);</script>';
		}
	}

	//Edit income item
	if (isset($_POST['UpdateIncomeItem'])) {
		$id = $_POST['ids'];
		$idin = $_POST['idin'];
		$desc = $_POST['Description'];
		$qty = $_POST['qty'];

		$viewstock = mysqli_query($conn, "SELECT * FROM `inventories` where `id-item` = '$id'");
		$stocks = mysqli_fetch_array($viewstock);
		$stockrn = $stocks['stock'];

		$rnqty = mysqli_query($conn, "SELECT * FROM `item-in` where `id-in`= '$idin'");
		$qtys = mysqli_fetch_array($rnqty);
		$rnqty = $qtys['qty'];

		if ($qty>$rnqty) {
			$deficit = $qty-$rnqty;
			$substract = $stockrn+$deficit;
			$substractstock = mysqli_query($conn, "UPDATE `inventories` SET `stock`='$substract' where `id-item` = '$id'");
			$updater = mysqli_query($conn, "UPDATE `item-in` SET `qty`='$qty', `assignee` = '$desc' where `id-in` = '$idin'");

				if ($substractstock&&$updater) {
				header('location:Incoming-Items_admin.php');
				} else {
					echo 'Failed';
					header('location:Incoming-Items_admin.php');
				}
			} else {
				$deficit = $rnqty-$qty;
				$substract = $stockrn-$deficit;
				$substractstock = mysqli_query($conn, "UPDATE `inventories` SET `stock`='$substract' where `id-item` = '$id'" );
				$updater = mysqli_query($conn, "UPDATE `item-in` SET `qty`='$qty', `assignee` = '$desc' where `id-in` = '$idin'");

				if ($substractstock&&$updater) {
					header('location:Incoming-Items_admin.php');
					} else {
						echo 'Failed';
						header('location:Incoming-Items_admin.php');
					}
			}
	}

	// deleting income item
	if (isset($_POST['DeleteIncomeItem'])) {
		$id = $_POST['idDs'];
		$qty = $_POST['dQty'];
		$idin = $_POST['idin'];

		$getdatastock = mysqli_query($conn, " SELECT * FROM `inventories` where `id-item` = '$id'");
		$data = mysqli_fetch_array($getdatastock);
		$stock = $data['stock'];

		$deficit = $stock-$qty;
		$update = mysqli_query($conn, "UPDATE `inventories` set `stock` = '$deficit' where `id-item` = '$id'");
		$deletitem = mysqli_query($conn,"DELETE FROM `item-in` where `id-in` = ' $idin '");

		if ($update&&$deletitem) {
			header('location:Incoming-Items_admin.php');
		}else {
			header('location:Incoming-Items_admin.php');
		}

	}

	//Edit outgoing item
	if (isset($_POST['UpdateoutgoingItem'])) {
		$id = $_POST['ids'];
		$idout = $_POST['idout'];
		$Recv = $_POST['Receiver'];
		$qty = $_POST['qty'];//user input

		//get RN stock
		$viewstock = mysqli_query($conn, "SELECT * FROM `inventories` where `id-item` = '$id'");
		$stocks = mysqli_fetch_array($viewstock);
		$stockrn = $stocks['stock'];

		//Qty outgoing item RN 
		$rnqty = mysqli_query($conn, "SELECT * FROM `item-out` where `id-out`= '$idout'");
		$qtys = mysqli_fetch_array($rnqty);
		$rnqty = $qtys['qty'];

		if ($qty>$rnqty) {
			$deficit = $qty-$rnqty;
			$substract = $stockrn-$deficit;
			
			//check stock rn is enough or no
			if($deficit <= $stockrn){
				$substractstock = mysqli_query($conn, "UPDATE `inventories` SET `stock`='$substract' where `id-item` = '$id'");
				$updater = mysqli_query($conn, "UPDATE `item-out` SET `qty`='$qty', `Receiver` = '$Recv' where `id-out` = '$idout'");

				if ($substractstock&&$updater) {
					header('location:Outgoing-Items_admin.php');
				} else {
					echo 'Failed';
					header('location:Outgoing-Items_admin.php');
				}
			}else{
				echo '<script>alert("Not enough stock!");</script>';
			}
			
			} else {
				$deficit = $rnqty-$qty;
				$addition = $stockrn+$deficit;
				$addtstock = mysqli_query($conn, "UPDATE `inventories` SET `stock`='$addition' where `id-item` = '$id'" );
				$updater = mysqli_query($conn, "UPDATE `item-out` SET `qty`='$qty', `Receiver` = '$Recv' where `id-out` = '$idout'");

				if ($addtstock&&$updater) {
					header('location:Outgoing-Items_admin.php');
					} else {
						echo 'Failed';
						header('location:Outgoing-Items_admin.php');
					}
			}
	}

	// deleting income item
	if (isset($_POST['DeleteoutgoingItem'])) {
		$id = $_POST['idDs'];
		$qty = $_POST['dQty'];
		$idout = $_POST['idout'];

		$getdatastock = mysqli_query($conn, " SELECT * FROM `inventories` where `id-item` = '$id'");
		$data = mysqli_fetch_array($getdatastock);
		$stock = $data['stock'];

		$deficit = $stock+$qty;
		$update = mysqli_query($conn, "UPDATE `inventories` set `stock` = '$deficit' where `id-item` = '$id'");
		$deletitem = mysqli_query($conn,"DELETE FROM `item-out` where `id-out` = ' $idout '");

		if ($update&&$deletitem) {
			header('location:Outgoing-Items_admin.php');
		}else {
			header('location:Outgoing-Items_admin.php');
		}
	}


?>

