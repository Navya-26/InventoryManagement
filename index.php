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
}
.header{
background-image: url(ex.jpg); 
color: white;
padding:1%
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
  <div class="header"><font style="font-size:40px"><b><i>INVENTORY MANAGEMENT</i></b></font></div>
  </div>
  <div class="topnav" id="myTopnav">
  <a href="#" class="active">Home</a>
  <a href="products.php">Products</a>
  <a href="sales.php">Sales</a>
  <a href="inventorytracking.php">Inventory Tracking</a>
  <a href="salestracking.php">Sales Tracking</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
  </div>
  <div class="bg"><br><br><br><img src="bg.jpg" width="500" height="400" alt="bg">  </center>
  
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
