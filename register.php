<?php 
require "function.php";

if(isset($_SESSION['username'])){
     echo '<script>alert("Better to logout first your account")</script>';
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div class="container">
     <form action="register.php" method="post"> 
     	<p class="fs-3 mb-3 text-center">Sign Up</p>
      
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="alert alert-danger"><strong><?php echo $_GET['error']; ?></strong></p>
     	<?php } ?>

      <?php if (isset($_GET['success'])) { ?>
           <p class="alert alert-success"><?php echo $_GET['success']; ?></p>
      <?php } ?> 
      
          <p class="fs-6">General</p>        
          <div class="row g-2 mb-3">
            <div class="col-md">
              <div class="form-floating">
                <input type="text" class="form-control " id="floatingInputGrid" name="fname" placeholder="First Name">
                <label for="floatingInputGrid" class="text-dark">First Name</label>
              </div>
            </div>
           <div class="col-md">
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGrid" name="lname"placeholder="Last Name">
                <label for="floatingInputGrid" class="text-dark">Last Name</label>
              </div>
            </div>
          </div>

          <div class="form-floating mb-3">
            
            <?php if (isset($_GET['username'])) { ?>
                  <input type="text" class="form-control" id="floatingInputGrid"
                        name="username" value="<?php echo $_GET['username']; ?>">
                  <label for="floatingInputGrid" class="text-dark">Username</label>
            <?php }else{ ?>
                 <input type="text" 
                        name="username" 
                        placeholder="Username" class="form-control" id="floatingInputGrid">
                <label for="floatingInputGrid" class="text-dark">Username</label>
          </div>
          <?php }?>
           <div class="row g-2 mb-3">
            <div class="col-md">
              <div class="form-floating">
                <input  type="password" name="password" placeholder="Password" class="form-control" id="floatingPasswordGrid" >
                <label for="floatingInputGrid" class="text-dark">Password</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating">
                <input  type="password" name="re_password" placeholder="Re-Password" class="form-control" id="floatingPasswordGrid" >
                <label for="floatingInputGrid" class="text-dark">Re-Password</label>
              </div>
            </div>
          </div>     

          <div class="form-floating mb-3">
            <?php if (isset($_GET['email'])) { ?>
                 <input type="text" 
                        name="email" 
                        placeholder="Email"
                        value="<?php echo $_GET['email']; ?>" class="form-control" id="floatingInput"><br>
                 <label for="floatingInput"  class="text-dark">Email address</label>
            <?php }else{ ?>
                 <input type="text" 
                        name="email" 
                        placeholder="Email" class="form-control" id="floatingInput"><br>
                 <label for="floatingInput"  class="text-dark">Email address</label>
          </div>
            <?php }?>
          <p class="fs-6">Company Details</p>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Company Name" name="compname">
            <label for="floatingInput" class="text-dark">Company Name</label>
          </div>
            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Company Address" name="compaddr">
            <label for="floatingInput" class="text-dark">Company Address</label>
          </div>
           <div class="row g-2 mb-3">
            <div class="col-md-2">
              <div class="form-floating">
                <input type="text" class="form-control " id="floatingInputGrid" name="zipcode" placeholder="Zipcode">
                <label for="floatingInputGrid" class="text-dark">Zipcode</label>
              </div>
            </div>
           <div class="col-md">
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGrid" name="phone"placeholder="Phone">
                <label for="floatingInputGrid" class="text-dark">Phone</label>
              </div>
            </div>
          </div>

     	<button name="submit"type="submit">Sign Up</button>
      <a href="login.php" class="ca">Already have an account?</a>
     </form>
  </div>
</body>

</html>