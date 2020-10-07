<?php

if(isset($_SESSION['login']) && isset($_SESSION['type']) == "resturant"){
$servername = "localhost";
$username = "root";
$password = "";
$db = "foodshala";
$port=3306;


$conn =  mysqli_connect($servername, $username, $password,$db,$port);



if (!$conn) {
  die("Connection failed: " . $conn->connect_error);
}

$company = $_SESSION['Name'];



$mysql = "SELECT * FROM `orders` where `company_name` = '$company'";


$res = $conn->query($mysql);

$conn->close();
}else{
    header('location:login.php');
}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>


<body>



            <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th scope="col">Customer Name</th>
                <th scope="col">Food Name</th>
                
                <th scope="col">Price</th>
                <th scope="col">Type</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Receive Order</th>
            </tr>
             </thead>
              <tbody>

   

            <?php

                if($res){
                if($res->num_rows > 0){
                   
                    while($row = $res->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row["customer"]; ?></td>
                            <td><?php echo $row["food_name"]; ?></td>
                            <td> Rs <?php echo $row["price"]; ?></td>
                            <td> <?php echo $row["type"]; ?></td>
                            <td> <?php echo $row["qty"]; ?></td>
                            <td>
                                 <?php echo number_format($row["qty"] * $row["price"], 2); ?></td>
                            <td><button class="alert alert-primary">Receive Order</button>

                        </tr>
                        <?php
                        
                    }
                }else{
                    echo "<h3>Nothing Match Or No Order Receive Yet</h3>";
                }
            }else{
                    ?>
                    <h1>No Order Receive yet </h1>

                    <?php
                }
                ?>
                        
                      
                </tbody>
            </table>
           
        

</body>
</html>