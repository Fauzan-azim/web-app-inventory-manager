<?php
$conn = mysqli_connect('localhost','root','','invmanager');

?>
<html>
<head>
  <title>Stock Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h4>Inventory</h4>
				<div class="data-tables datatable-dark">
                <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Stock</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                         $getAllData = mysqli_query($conn, 'SELECT *FROM `inventories` ');
                                         $i =1;
                                         while ($data = mysqli_fetch_array($getAllData)) {
                                             
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
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $msg;?></td>
                                            <td><?php echo $itemName;?></td>
                                            <td><?php echo $desc;?></td>
                                            <td><?php echo $stock;?></td>
                                        
                                        </tr>
                                         
                                        
                                        <?php
                                        

                                        }
                                        ?>
                                    </tbody>
                                </table>
					
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>
<?php
mysqli_close($conn);
?>