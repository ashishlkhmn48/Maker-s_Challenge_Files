<?php

//database connection
$db_name = "id2038151_shopping_db";
$mysql_username = "id2038151_shopping_db";
$mysql_password = "ashish123";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);

$username = $_POST["username"];
$password = $_POST["password"];

$query = "select * from info where username = '$username' and password = '$password';";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 1){
    while($row=mysqli_fetch_array($result)){
        echo $row["amount"];    
    }
}
else
	echo "failed";

?>