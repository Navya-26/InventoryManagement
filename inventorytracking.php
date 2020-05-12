<?php 
$connect = mysqli_connect("localhost", "root", "", "inventorymanagement");
$query = "SELECT * FROM products";
$result = mysqli_query($connect, $query);
?>
<html>
 <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
* {
  box-sizing: border-box;
}

input[type=text],input[type=number], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #24a0ed;
  color: white;
  padding: 12px 20px;
  margin-top: 2%;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
  margin-top: 2%;
}
.header{
background-image: url(ex.jpg); 
}
.navbar{
background-color: grey;
}
.container {
	width: 100%;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}
.col-middle{
  margin-top:6px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}
.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.active {
  background-color: #5050ff;
  color: white;
}

.topnav .icon {
  display: none;
}

.topnav a:hover {
  background-color: #555;
  color: white;
  font-size: 25px;
}

#invid{
	color: red;
	font-size: 25px;
	font-family: verdana;
	text-align: center;
}
#print{
	font-size: 25px;
	
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}

@media screen and (max-width: 600px) {
  .col-25, .col-75, .header,.col-middle,input[type=submit] ,img{
    width: 100%;
    margin-top: 0;
  }
}
</style>
 </head>
 <body>
 <div class="container">
<center>
  <div class="row">
  <div class="header"><img src="inventorymgt.png" width=450 height=75 alt="Header"></div>
  </div>
  <div class="topnav" id="myTopnav">
  <a href="index.php">Home</a>
  <a href="products.php">Products</a>
  <a href="sales.php">Sales</a>
  <a href="#" class="active">Inventory Tracking</a>
  <a href="salestracking.php">Sales Tracking</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div><h1><b><i>Inventory Tracking</i></b></h1></center>
 <br>
   <div class="table-responsive">
   <div class="table-responsive">
    <table id="products_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Id</th>
       <th>Product Id</th>
       <th>
        <select name="productname" id="productname" class="form-control">
         <option value="">Product Name</option>
         <?php 
         while($row = mysqli_fetch_array($result))
         {
          echo '<option value="'.$row["productname"].'">'.$row["productname"].'</option>';
         }
         ?>
        </select>
       </th>
	   <th>Quantity available</th>
       <th>Price per unit</th>
	   <th>Vendor Name</th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
  </div>
 </body>
</html>



<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_productname)
 {
  var dataTable = $('#products_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"fetchinventory.php",
    type:"POST",
    data:{is_productname:is_productname}
   },
   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#productname', function(){
  var productname = $(this).val();
  $('#products_data').DataTable().destroy();
  if(productname != '')
  {
   load_data(productname);
  }
  else
  {
   load_data();
  }
 });
});
</script>
