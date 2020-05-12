<?php
require"config.php";
session_start();
?>

<?php
$q="select * from sales order by id desc limit 1";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_array($r);
$lastid=$row['custid'];
if($lastid==" ")
	$custid="CUS1";
else
{
	$custid=substr($lastid,3);
	$custid=intval($custid);
	$custid="CUS".($custid+1);
}

$q1="select * from sales order by id desc limit 1";
$r1=mysqli_query($con,$q1);
$row=mysqli_fetch_array($r1);
$lastid=$row['invoice'];
if($lastid==" ")
	$invid="INV1";
else
{
	$invid=substr($lastid,3);
	$invid=intval($invid);
	$invid="INV".($invid+1);
}
?>

<html> 
<head>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#id').change(function() {
                var sid = $("#id :selected").val();
                var data_String = 'sid=' + sid.substring(0,sid.indexOf('-'));
                $.get('search.php', data_String, function(result) {
                    $.each(result, function(){
                        $('#id').val(this.id);
                        $('#proid').val(this.productid);
                        $('#price').val(this.priceperunit);
                    });

                });
            });
        });
    </script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
* {
  box-sizing: border-box;
}

input[type=text],input[type=number],input[type=date], select, textarea {
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
body{
	margin:0;
}
.container{
	margin-left=0;
}

.active {
  background-color: #5050ff;
  color: white;
}
hr{
	color: black;
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
#proid,#price{
	color:red;
}
#invid{
	color:blue;
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
  <a href="#" class="active">Sales</a>
  <a href="inventorytracking.php">Inventory Tracking</a>
  <a href="salestracking.php">Sales Tracking</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>
  <h1><i><b>Customer Details</b></i></h1>
  <hr>
  <form method="post">
    <div class="row">
      <div class="col-25">
        <label>Customer Name</label>
      </div>
      <div class="col-75">
        <input type="text" name="custname" placeholder="Enter the customer name here" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Customer Address</label>
      </div>
      <div class="col-75">
        <textarea name="custaddr" placeholder="Enter customer address" style="height:100px"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Current Date</label>
      </div>
      <div class="col-75">
        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
      </div>
    </div>
	<h1><i><b>Sale Details</b></i></h1>
    <hr>
	<div class="row">
      <div class="col-25">
        <label>Product Name</label>
      </div>
      <div class="col-75" id="name">
        <select name="id" id="id">
			<option selected="" disabled="">Select Product</option>
			<?php
			$con=mysqli_connect("localhost","root","") or die("unable to connect");
			mysqli_select_db($con,"inventorymanagement");
			session_start();
			$q="select * from products";
			$r=mysqli_query($con,$q);
			while($row=mysqli_fetch_row($r))
			{
				echo'<option>'.$row[0].'-'.$row[1].'</option>';
			}
			?>
		</select>
      </div>
    </div>
	<div class="row">
      <div class="col-25">
        <label>Product Serial No</label>
      </div>
      <div class="col-75">
        <font color="red"><input type="text" id="proid" name="proid" placeholder="ProductId" required readonly></font>
      </div>
    </div>
	<div class="row">
      <div class="col-25">
        <label>Price</label>
      </div>
      <div class="col-75">
        <font color="red"><input type="text" id="price" name="price" placeholder="Price" required readonly></font>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Quantities</label>
      </div>
      <div class="col-75">
        <input type="number" name="quantity" id="quantity" placeholder="No. of units sold" required>
      </div>
    </div>
	<h1><i><b>Invoice Details</b></i></h1>
    <hr>
	<div class="row">
      <div class="col-25">
        <label>Invoice No</label>
      </div>
      <div class="col-75">
        <font color="blue"><input type="text" id="invid" name="invid" value="<?php echo $invid; ?>" required readonly></font>
      </div>
    </div>
    <div class="row">
	<br>
	<input type="submit" style="float:left;margin-left:2%;" name="Add another product" value="Add another product">
    <input type="submit" style="float:right;margin-right:2%;" value="Submit" name="submit">
    </div>
  </form>
  </center>
</div>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
	$custname=$_POST['custname'];
	$custaddr=$_POST['custaddr'];
	$date=$_POST['date'];
	$productid=$_POST['proid'];
	$price=$_POST['price'];
	$quantity=$_POST['quantity'];
	$totalprice=$price*$quantity;
	/*echo $custname."<br>";
	echo $custaddr."<br>";
	echo $date."<br>";
	echo $productid."<br>";
	echo $price."<br>";
	echo $quantity."<br>";
	echo $totalprice."<br>";
	echo $custid;
	echo $invid;*/
	$q2="select productname,totalquantity from products where productid='$productid'";
	$rq2=mysqli_query($con,$q2);
	$row=mysqli_fetch_array($rq2);
	$quant=$row['totalquantity'];
	$updated=$quant-$quantity;
	$q="insert into sales(custid,custname,custaddr,date,productid,price,quantity,totalprice,invoice) values('$custid','$custname','$custaddr','$date','$productid','$price','$quantity','$totalprice','$invid')";
	$r=mysqli_query($con,$q);
	if($r)
	{
		$q1="update products set totalquantity='$updated' where productid='$productid'";
		$rq=mysqli_query($con,$q1);
		if($rq)
		{
		$_SESSION['custid']=$custid;
		$_SESSION['proid']=$productid;
		$_SESSION['invid']=$invid;
		
		echo '<script>window.location.href="inv.php";</script>';
		}
		else
			echo '<script>alert("Error Occured.Please try again later");</script>';
	}
	else
		echo '<script>alert("Error Occured.Please try again");</script>';
}
?>