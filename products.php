<?php
require"config.php";
session_start();
?>

<?php
$q="select * from products order by id desc limit 1";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_array($r);
$lastid=$row['productid'];
if($lastid==" ")
	$id="PRO1";
else
{
	$id=substr($lastid,3);
	$id=intval($id);
	$id="PRO".($id+1);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  <a href="#" class="active">Products</a>
  <a href="sales.php">Sales</a>
  <a href="inventorytracking.php">Inventory Tracking</a>
  <a href="salestracking.php">Sales Tracking</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>
  <h1><i><b>Product Details</b></i></h1>
  <form method="post">
    <div class="row">
      <div class="col-25">
        <label>Product Name</label>
      </div>
      <div class="col-75">
        <input type="text" name="productname" placeholder="Enter the product name here" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Product Serial No</label>
      </div>
      <div class="col-75">
        <input type="text" name="productid" style="color:red" value="<?php echo $id; ?>" readonly>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Quantity Received</label>
      </div>
      <div class="col-75">
        <input type="number" name="quantity" placeholder="Enter No. of units" required>
      </div>
    </div>
	<div class="row">
      <div class="col-25">
        <label>Price per unit</label>
      </div>
      <div class="col-75">
        <input type="number" name="price" placeholder="Enter price of each unit in Rs." required>
      </div>
    </div>
	<div class="row">
      <div class="col-25">
        <label>Vendor Name</label>
      </div>
      <div class="col-75">
        <input type="text" name="vendor" placeholder="Enter Vendor Name" required>
      </div>
    </div>
    <div class="row">
	<br>
      <input type="submit" value="Submit" name="submit">
    </div>
  </form>
  </center>
</div>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
	$productname=$_POST['productname'];
	$productid=$_POST['productid'];
	$quantity=$_POST['quantity'];
	$priceperunit=$_POST['price'];
	$vendorname=$_POST['vendor'];
	/*echo $productname."<br>";
	echo $productid."<br>";
	echo $quantity."<br>";
	echo $priceperunit."<br>";
	echo $vendorname."<br>";*/
	$q="insert into products(productname,productid,totalquantity,priceperunit,vendorname) values('$productname','$productid','$quantity','$priceperunit','$vendorname')";
	$r=mysqli_query($con,$q);
	if($r)
	{
		echo '<script>alert("Product added successfully");';
		echo 'window.location.href="index.php";</script>';
	}
	else
		echo '<script>alert("Error Occured.Please try again");</script>';
}
?>
