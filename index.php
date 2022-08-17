<?php 
require "function.php";
require "check.php";
if(isset($_SESSION['IS_LOGGED_IN'] )){
	if($_SESSION['level'] == "admin"){
		echo '<script>alert("Admin Cannot Access Guest Page!");window.location="index_adminPage.php"</script>';
	exit();
	}else {
        include "session_timeout.php";
    }
	
	
 }
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Stock - 
            <?php
                echo $_SESSION['username'];
            ?>
        </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="bootstrap-css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        
        <!--bootstrap -->     
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!---///-->
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Inventory Management</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                         <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home</div>
                            <a class="nav-link" href="Dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Information</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Stock
                            </a>
                            <a class="nav-link" href="Incoming-Items.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
                                Incoming Items
                            </a>
                            <a class="nav-link" href="Outgoing-Items.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Outgoing Items
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:
                            
                        </div>
                        <?php
                            echo $_SESSION['level'];
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Stock</h1>
                        
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="export.php" class="btn btn-info">Export Data</a>
                            </div>
                           <div class="card-body">
                                
                            <?php
                            //Appear the alert while item is out of stock  
                                $getStockData = mysqli_query($conn, "SELECT* FROM inventories WHERE stock < 1");

                                while($fetch = mysqli_fetch_array($getStockData)){
                                    //create new var to store item name from db
                                    $Item = $fetch['Name'];

                                
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Notice! </strong> <?=$Item;?> is out of stock </a>.
                                </div>

                            <?php

                                }
                            ?>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                         $getAllData = mysqli_query($conn, 'SELECT *FROM `inventories` ');
                                         $i =1;
                                         while ($data = mysqli_fetch_array($getAllData)){
                                             
                                             $itemName = $data['Name'];
                                             $desc = $data['Desc'];
                                             $stock = $data['stock'];
                                             $id = $data['id-item'];

                                            //check image exist or no
                                            $image = $data['image'];
                                            if($image == null){
                                                $msg = 'No photo';
                                            }else{
                                                $msg = '<img style = "width:100px;" src="assets/img/itemImg/'.$image.'">';
                                            }

                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$msg;?></td>
                                            <td><?=$itemName;?></td>
                                            <td><?=$desc;?></td>
                                            <td><?=$stock;?></td>
                                            <td>
                                        
                                        </tr>
                                            
                                        
                                        <?php
                                        

                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                
            </div>
        </div>
        <!---script Session-->
            <script>
                function checkUserTime() {
                    $.ajax({
                        url:"session_timeout.php",
                        method:"post",
                        success:function(response)
                        {
                            if(response == 'logout'){
                                alert("Session Expired");
                                window.location="logout.php";
                                exit();

                            }
                        }
                    });
                }setInterval(function () {
                    checkUserTime();
                },2000);
            </script>
        <!----->   
        
    <!---script-->    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
       
    <!---///-->
    </body>
 
 
</html>
