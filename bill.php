<?php

//database connection
$db_name = "id2038151_shopping_db";
$mysql_username = "id2038151_shopping_db";
$mysql_password = "ashish123";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);

$username = $_POST["username"];

$query = "select p_name,total_qty,total_price from bill where u_name = '$username';";
$result = mysqli_query($conn, $query);
$response = array();

while($row=mysqli_fetch_array($result)){
       array_push($response,array("name"=>$row["p_name"],"qty"=>$row["total_qty"],"price"=>$row["total_price"]));
}
echo json_encode($response);


mysqli_close($conn);

?>