<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "inventorymanagement");
$column = array("products.id", "products.productid","products.productname","products.totalquantity","products.priceperunit","products.vendorname");
$query = "
 SELECT * FROM products
";
$query .= " WHERE ";
if(isset($_POST["is_productname"]))
{
 $query .= "products.productname = '".$_POST["is_productname"]."' AND ";
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(products.id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR products.productid LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR products.productname LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR products.totalquantity LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR products.priceperunit LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR products.vendorname LIKE "%'.$_POST["search"]["value"].'%") ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY products.id DESC ';
}

$query1 = '';

if($_POST["length"] != 1)
{
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$r=mysqli_query($connect, $query);
if($r)
$number_filter_row = mysqli_num_rows($r);
else
	echo"s";
$result = mysqli_query($connect, $query . $query1);
$data = array();
while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["id"];
 $sub_array[] = $row["productid"];
 $sub_array[] = $row["productname"];
 $sub_array[] = $row["totalquantity"];
 $sub_array[] = $row["priceperunit"];
 $sub_array[] = $row["vendorname"];
 $data[] = $sub_array;
}
function get_all_data($connect)
{
 $query = "SELECT * FROM products";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>

