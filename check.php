<?php

//database connection
$db_name = "id2038151_shopping_db";
$mysql_username = "id2038151_shopping_db";
$mysql_password = "ashish123";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);

$username = $_POST["username"];
$productName = $_POST["productName"];
$qtySelected = $_POST["qtySelected"];
$totalPrice = $_POST["totalPrice"];
$max = $_POST["max"];


mysqli_query($conn, "LOCK TABLES *");
$query1 = "select amount from info where username = '$username';";
$result1 = mysqli_query($conn, $query1);

$query2 = "select qty from products where name = '$productName';";
$result2 = mysqli_query($conn, $query2);

$query6 = "select sum(total_qty) as tot_qty from bill where p_name = '$productName' and u_name = '$username';";
$result6 = mysqli_query($conn, $query6);

$response1 = array();
$response2 = array();

$temp = 0;
    
while($row1=mysqli_fetch_array($result1)){
    $response1["amount"] = $row1["amount"];
    if($response1["amount"] < $totalPrice){
        $temp = 1;
    }
}


while($row2=mysqli_fetch_array($result2)){
    $response2["qty"] = $row2["qty"];
    if($response2["qty"] == 0 || $response2["qty"] < $qtySelected){
        if($temp == 0){
            $temp = -1;   
        }
    }
}


if($temp == 0){
    while($row6 = mysqli_fetch_array($result6)){
         if($row6["tot_qty"] + $qtySelected > $max){
            $temp = 2;
        }
    }
}
    
if($temp == 0){
     $newAmt = $response1["amount"] - $totalPrice;
     $newQty = $response2["qty"] - $qtySelected;
	 $query3 = "update products set qty = '$newQty' where name = '$productName';";
	 $result3 = mysqli_query($conn, $query3);
	 $query4 = "update info set amount = '$newAmt' where username = '$username';";
	 $result4 = mysqli_query($conn, $query4);
	 $query5 = "insert into bill values('$username','$productName','$qtySelected','$totalPrice')";
	 $result5 = mysqli_query($conn, $query5);  
	 echo "Congratulations.!\nTransaction Success.\nCheck you Bill";
} else if($temp == 1){
    echo "Low Balance.";
}else if($temp == -1){
    echo "Not Enough Item/s Available.";
}else if($temp == 2){
    echo "You Have Already Reached Max Limit for $productName";
}
		
//mysqli_query($conn, "UNLOCK TABLES");
?>