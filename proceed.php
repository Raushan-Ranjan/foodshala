<?php

session_start();
if(isset($_SESSION['proceed'])){
   
  include "config.php";
    
    $_SESSION['proceed'] = false;




        
    if (!$conn) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "CREATE TABLE IF NOT EXISTS orders (\n"
    
        . "    customer VARCHAR (50),\n"
    
        . "    company_name VARCHAR (50),\n"

        . "    food_name VARCHAR (30),\n"
    
        . "    price VARCHAR (4),\n"

        . "    type VARCHAR (7),\n"
    
        . "    qty VARCHAR (3),\n"

        . "    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP\n"
    
        . ")";
    
        if($conn->query($sql)=== TRUE){
          echo "table created successfully";
        }else{
          echo "Table not created successfully";
          die();
        }

        $customer = $_SESSION['Name'];



    $query = 'INSERT INTO `orders`(`customer`,`company_name`,`food_name`, `price`, `type`,`qty`) VALUES ';
   
    foreach ($_SESSION["cart"] as $key => $value){
        $query_parts[] = "('" . $customer . "','" . $value['company_name'] ."','" . $value['food_name'] ."','" . $value['price'] ."','" . $value['type'] ."','" . $value['qty'] . "')";
    }
    echo $query .= implode(',', $query_parts);

    if (mysqli_multi_query($conn, $query)) {
        echo "New records created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }


      unset ($_SESSION['cart']);
      $_SESSION[len] = 0;
   

    $conn->close();
}
header('location:customer.php');

?>