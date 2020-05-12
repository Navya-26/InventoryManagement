<?php
require"config.php";
session_start();
$i=$_SESSION['invid'];
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
	width: 100%;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  padding-bottom: 18%
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
	background-color: #24a0ed;
  color: white;
  padding: 12px 20px;
  margin-top: 2%;
  border: none;
  border-radius: 4px;
  cursor: pointer;
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
  <a href="sales.php"  class="active">Sales</a>
  <a href="inventorytracking.php">Inventory Tracking</a>
  <a href="salestracking.php">Sales Tracking</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>
  <h1><i><b>Invoice No</b></i></h1>
<form method="post">
<div class="row">
<input type="text" name="invid" id="invid" value="<?php echo $i ?>" required>
</div>
<div class="row">
<button id="print" name="submit"><a href="invoice.php" target="_blank" style="text-decoration:none;">View/Print/Download Invoice</a></button>
</div>
</form>
<?php
/*if(isset($_POST['submit']))
{
	window.open("invoice.php","_blank");
}*/
?>
