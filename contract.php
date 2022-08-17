<?php 

require 'function.php';
require 'check.php';
//add new item
if(isset($_POST['addNewContract'])){
    $contractWitness = $_POST['contractWitness'];
    
    //file LoA
    $allowed_extension = array('png','jpg', 'pdf', 'doc', 'docx', 'csv');
    $fileName = $_FILES['LoA']['name'];
    $fileSize = $_FILES['LoA']['size'];
    $file_tmp = $_FILES['LoA']['tmp_name'];//get file location
    $dot = explode('.',$fileName);
    $extension = strtolower(end($dot));//get extension
    


    $file = $fileName.'.'. $extension;//combine filename with it's extension


    //validate existing item names
    $check = mysqli_query($conn,"SELECT * FROM contract WHERE `contract_witness` = '$contractWitness'");
    $countContract = mysqli_num_rows($check);


    if($countContract <1){
        
        //upload image process
        if(in_array($extension, $allowed_extension) === true){
            //validate imgsize max 15mb
            if($fileSize < 15000000){

                move_uploaded_file($file_tmp, 'assets/LoA/' .$file);

                $addtotable = mysqli_query($conn, "INSERT INTO `contract`( `contract_witness`, `LoA`) VALUES ('$contractWitness','$file')");
                if($addtotable){
                    header('location:contract.php');
                }else{
                    echo '<script>alert("Failed");</script>';
                } 
            }else{
                echo '<script>alert("File size too big");
                window.location.href="contract.php";</script>';
            }

        }else if($fileSize == 0){
            //not upload an img only add

            $addtotable = mysqli_query($conn, "INSERT INTO `contract`( `contract_witness`) VALUES ('$contractWitness')");
                if($addtotable){
                    header('location:contract.php');
                }else{
                    echo '<script>alert("Failed");</script>';
                } 
        }else{
            //if image not png/jpg
            echo '<script>alert("File must be png, jpg, pdf, doc, docx, csv ");window.location.href="contract.php";</script>';
        }

    }else{
        echo '<script>alert("Existing Contract");window.location.href="contract.php";</script>';
    }
    
}

?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>contract - 
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
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
                                Incoming Records
                            </a>
                           <?php  if($_SESSION['level'] == 'guest'){ ?>
                                <a class="nav-link" href="Outgoing-Items.php">
                            <?php } else{?>
                                <a class="nav-link" href="Outgoing-Items_admin.php">
                            <?php } ?>
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
                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <h1>Contract</h1>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" ;>
                                    Contract 
                                </button>        
                            </div>
                            <div class="card-body">
                             
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Contract Witness</th>
                                            <th>Letter of Acceptance</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                         $getAllData = mysqli_query($conn, 'SELECT * FROM `contract` ');
                                         $i =1;
                                         while ($data = mysqli_fetch_array($getAllData)) {
                                             
                                             $conWitness = $data['contract_witness'];
                                             $id = $data['contract_id'];

                                             //check image exist or no
                                            $LoA = $data['LoA'];
                                            if($LoA == null){
                                                $msg = 'No Document';
                                            }else{
                                                $msg = $LoA;
                                            }
                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$conWitness;?></td>
                                            <td><?=$msg;?></td> 
                                        
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
       <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Contract</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post" enctype="multipart/form-data">
            <div class="modal-body"> 
            
            <input type="text" name="contractWitness" placeholder="Contract Witness" class="form-control" required>
            <br>
            <input type="file" name="LoA" class="form-control">
            <br>
            <button type="submit" name="addNewContract" class="btn btn-primary">Submit</button>
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
