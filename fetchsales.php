<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "inventorymanagement");
$column = array("sales.id","sales.invoice", "sales.productid","products.productname", "sales.date", "sales.quantity","sales.price","sales.totalprice");
$query = "
 SELECT * FROM sales 
 INNER JOIN products 
 ON products.productid = sales.productid 
";
$query .= " WHERE ";
if(isset($_POST["is_date"]))
{
 $query .= "sales.date = '".$_POST["is_date"]."' AND ";
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(sales.id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR sales.invoice LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR sales.productid LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR products.productname LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR sales.date LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR sales.quantity LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR sales.price LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR sales.totalprice LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY sales.id DESC ';
}

$query1 = '';

if($_POST["length"] != 1)
{
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["id"];
 $sub_array[] = $row["invoice"];
 $sub_array[] = $row["productid"];
 $sub_array[] = $row["productname"];
 $sub_array[] = $row["date"];
 $sub_array[] = $row["quantity"];
 $sub_array[] = $row["price"];
 $sub_array[] = $row["totalprice"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM sales";
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

