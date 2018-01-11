<?php

//database connection
$db_name = "id2038151_shopping_db";
$mysql_username = "id2038151_shopping_db";
$mysql_password = "ashish123";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);

$query = "select * from products;";
$result = mysqli_query($conn, $query);
$response = array();

while($row=mysqli_fetch_array($result)){
       array_push($response,array("name"=>$row["name"],"qty"=>$row["qty"],"price"=>$row["price"],"image"=>$row["image"],"max"=>$row["max"]));
}
echo json_encode($response);

mysqli_close($conn);

?>