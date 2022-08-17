<?php 

include "function.php";
//to prevent fromm back to login page if logged in
if(isset($_SESSION['IS_LOGGED_IN'] )){
	if($_SESSION['level'] == "admin"){
		echo '<script>alert("You already logged in as Admin!");window.location="index_admin.php"</script>';
	exit();
	}else{
		echo '<script>alert("You already logged in as Guest!");window.location="dashboard.php"</script>';
	exit();
	}
 }

if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	if (empty($email)) {
		header("Location: index.php?error=Email is required");
	    exit();
	}else if(empty($password)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		// hashing the password
        $password = md5($password);
        
		$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);



            if ($row['email'] === $email && $row['password'] === $password) {
				

				if($row['level'] == "admin"){
					// Taking now logged in time.
					$_SESSION['login_time'] = time(); 
					// Ending a session in 30 minutes from the starting time.
					
					$_SESSION['IS_LOGGED_IN'] = true;
					//store session 
					$_SESSION['level'] = $row['level'];
					$_SESSION['username'] = $row['username'];
					header("Location:dashboard.php");
					exit();
				}else{
					// Taking now logged in time.
					$_SESSION['login_time'] = time(); 
					
					$_SESSION['IS_LOGGED_IN'] = true;

					$_SESSION['username'] = $row['username'];
					$_SESSION['level'] = $row['level'];
					header("Location:dashboard.php");
					exit();
				}
            	
            }else{
				header("Location: login.php?error=Incorect Email or password");
		        exit();
			}
		}else{	
			header("Location: login.php?error=Incorect Email or password");
	        exit();
		}
	}
	
}//note : you can access admin account with email: admin@email.com , pass :admin1
?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="login.php" method="post">
     	<h2>LOGIN</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Email</label>
     	<input type="text" name="email" placeholder="Email" required><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password" required><br>

     	<button name ="login"type="submit">Login</button>
          <a href="register.php" class="ca">Create an account</a>
     </form>
	 <footer>
		<div class="main-content">
			<div class="left box">
				<h2>Inventory Management</h2>
				<div class="content">
					<div class="social">
					</div>
				</div>
			</div>
			
	</footer>
</body>
</html>