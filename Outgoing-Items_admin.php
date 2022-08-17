<?php 
require "function.php";
require "check.php";
if(isset($_SESSION['IS_LOGGED_IN'] )){
	if($_SESSION['level'] != "admin"){
		echo '<script>alert("You dont have access to this Page!");window.location="dashboard.php"</script>';
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

        <title>Outgoing Item - 
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
            <a class="navbar-brand ps-3" href="index_admin.php">Inventory Management</a>
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
                            <a class="nav-link" href="index_admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Stock
                            </a>
                            <a class="nav-link" href="Incoming-Items_admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
                                Incoming Records
                            </a>
                            <a class="nav-link" href="Outgoing-Items_admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
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
                        <h1 class="mt-4">Outgoing Records</h1>
                       
                        
                        <div class="card mb-4">
                            <div class="card-header">
                              <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Add Borrowed-Item
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Borrower</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                         $getAllData = mysqli_query($conn, 'SELECT *FROM `item-out` m, `inventories` s where s.`id-item` = m.`id-item` ');
                                         while ($data = mysqli_fetch_array($getAllData)) {
                                            $id = $data['id-item'];
                                            $idout = $data['id-out'];
                                            $date = $data['date'];
                                            $itemName = $data['Name'];
                                            $qty = $data['qty'];
                                             $Recv = $data['Receiver'];
                                             
                                         //check image exist or no
                                         $image = $data['image'];
                                         if($image == null){
                                             $msg = 'No photo';
                                         }else{
                                             $msg = '<img style = "width:100px;" src="assets/img/itemImg/'.$image.'">';
                                         }
                                        ?>
                                        <tr>
                                            <td><?=$date;?></td>
                                            <td><?=$msg;?></td>
                                            <td><?=$itemName;?></td>
                                            <td><?=$Recv;?></td>
                                            <td><?=$qty;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idout;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idout;?>">
                                                    Delete
                                                </button>
                                            </td>
                                        
                                        </tr>
                                             <!-- Edit Modal -->
                                             <div class="modal fade" id="edit<?=$idout;?>">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                              
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Edit Item</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Modal body -->
                                                <form method="post">
                                                    <div class="modal-body">
                                                    <input type="text" name="Receiver" value="<?=$Recv;?>" class="form-control" required>
                                                    <br>
                                                    <input type="number" name="qty" value="<?=$qty;?>" class="form-control" required>
                                                    <br>
                                                    <input type="hidden" name="ids" value="<?=$id;?>">
                                                    <input type="hidden" name="idout" value="<?=$idout;?>">
                                                    <button type="submit" name="UpdateoutgoingItem" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                                
                                              </div>
                                            </div>
                                        </div>

                                            <!-- Delete Modal -->
                                          <div class="modal fade" id="delete<?=$idout;?>">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                              
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Delete Item</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Modal body -->
                                                <form method="post">
                                                    <div class="modal-body">
                                                    
                                                    Are you sure you want to delete <?=$itemName;?>?
                                                    <input type="hidden" name="idDs" value="<?=$id;?>">
                                                    <input type="hidden" name="dQty" value="<?=$qty;?>">
                                                    <input type="hidden" name="idout" value="<?=$idout;?>">
                                                    <br>
                                                    <br>
                                                    <button type="submit" name="DeleteoutgoingItem" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                                
                                              </div>
                                            </div>
                                          </div>


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

     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
    </body>
     <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
            <div class="modal-body">
            
            <select name="item" class="form-control">
                <?php
                    $getAllData = mysqli_query($conn, "SELECT * FROM `inventories`");
                    while($fetcharray = mysqli_fetch_array($getAllData)){
                        $itemName = $fetcharray['Name'];
                        $itemID = $fetcharray['id-item'];
                ?>
                <option value="<?=$itemID;?>"><?=$itemName;?> </option>

                <?php
                    }
                ?>
            </select>
            
            <br>
            <input type="number" name="qty" class="form-control" placeholder="Quantity" required>
            <br>
            <input type="text" name="receiver" placeholder="Receiver" class="form-control" required>
            <br>
            <button type="submit" name="item-out" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
</html>
