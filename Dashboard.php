<?php 
require "function.php";
require "check.php";
include "session_timeout.php";

?>

<!DOCTYPE html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Welcome - 
            <?php
                echo $_SESSION['username'];
            ?>
        </title>
        
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
            <?php   if($_SESSION['level'] == 'guest'){?>
                <a class="navbar-brand ps-3" href="index.php">Inventory Management</a>
            <?php } else{?>
                <a class="navbar-brand ps-3" href="index_admin.php">Inventory Management</a>
                <?php }?>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    
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
                            <?php  if($_SESSION['level'] == 'guest'){ ?>
                                <a class="nav-link" href="index.php">
                            <?php } else{?>
                                <a class="nav-link" href="index_admin.php">
                            <?php } ?>
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Stock
                            
                            <?php  if($_SESSION['level'] == 'guest'){ ?>
                                <a class="nav-link" href="Incoming-Items.php">
                            <?php } else{?>
                                <a class="nav-link" href="Incoming-Items_admin.php">
                            <?php } ?>
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Incoming Records
                            </a>
                           <?php  if($_SESSION['level'] == 'guest'){ ?>
                                <a class="nav-link" href="Outgoing-Items.php">
                            <?php } else{?>
                                <a class="nav-link" href="Outgoing-Items_admin.php">
                            <?php } ?>
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
                                Outgoing Records
                            </a>
                            <a class="nav-link" href="contract.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-signature"></i></div>
                                Contract
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Welcome to Inventory Data :&nbsp 
                                <strong> <?php
                                    echo $_SESSION['username'];
                                ?></strong>
                            </li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body"><i class="fas fa-cubes"></i> Stock</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <?php  if($_SESSION['level'] == 'guest'){ ?>
                                        <a class="small text-white stretched-link" href="index.php">View Details</a>
                                        <?php } else{?>
                                            <a class="small text-white stretched-link" href="index_admin.php">View Details</a> 
                                        <?php } ?>   
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body"><i class="fas fa-sign-in-alt"></i> Incoming Records</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?php  if($_SESSION['level'] == 'guest'){ ?>
                                        <a class="small text-white stretched-link" href="incoming-items.php">View Details</a>
                                        <?php } else{?>
                                            <a class="small text-white stretched-link" href="incoming-items_admin.php">View Details</a> 
                                        <?php } ?>   
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body"><i class="fas fa-sign-out-alt"></i> Outgoing Records</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?php  if($_SESSION['level'] == 'guest'){ ?>
                                        <a class="small text-white stretched-link" href="outgoing-items.php">View Details</a>
                                        <?php } else{?>
                                            <a class="small text-white stretched-link" href="outgoing-items_admin.php">View Details</a> 
                                        <?php } ?>   
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body"><i class="fas fa-file-signature"></i> Contract</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="contract.php">View Details</a> 
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
