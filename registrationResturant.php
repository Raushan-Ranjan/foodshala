<?php 

$error = false;
$sucess = "";
if(isset($_POST['name'])){
$servername = "localhost";
$username = "root";
$password = "";
$port = 3306;



$conn =  mysqli_connect($servername, $username, $password, "" ,$port);

if (!$conn) {
  die("Connection failed: " . $conn->connect_error);
}else{

  $sql = "CREATE DATABASE if not EXISTS foodshala";
  if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";

  } else {
    echo "Error creating database: " . $conn->error;
  }
}

mysqli_select_db($conn, "foodshala");


$sql = "CREATE table if not EXISTS resturant ( name VARCHAR (40) , email varchar(30) PRIMARY KEY, phone VARCHAR (12),street VARCHAR (255),zip_code VARCHAR (10),city VARCHAR (30),state VARCHAR (30),password VARCHAR (255))";



if($conn->query($sql)){
  echo "table created successfully";
}else{
  echo   "table not created successfully";
  die();
}
              

$name = $_POST['name'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pwd = $_POST['password'];
$zip = $_POST['zip'];

$sql = "INSERT INTO `resturant`(`name`, `email`, `phone`,`street`,`zip_code`,`city`,`state`,`password`) VALUES ('$name','$email','$phone','$street','$zip','$city','$state','$pwd')";

if ($conn->query($sql) === TRUE) {
  // echo '<script>alert("Welcome to Geeks for Geeks")</script>';
  header('Location:index.php');

  //  echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
  
} else {
  $error = true;
}

$conn->close();
}

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: rgba(201, 201, 181, 0.466);
 
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus, input[type=email]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

button.new{
    background-color: gray;
}
h3{
  color:red;
}
</style>
</head>
<body>

<form action="registrationResturant.php" method="post">
  <div class="container">
    <h1>Register as Resturant</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <?php
    
        if($error){
          echo "<h3>Wrong Input Format Inserted Or Email-Id is already Register</h3>";
        }
    ?>
    
    <label for="name"><b>Resturant Name</b></label>
    <input type="name" placeholder="Enter Resturant Name" name="name"required>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="phone"><b>Phone Number</b></label>
    <input type="text" placeholder="Enter Phone Number" name="phone" required>

    <label for="street"><b>Street Name</b></label>
    <input type="text" placeholder="Enter Street Name" name="street" required>

    <label for="zip"><b>Zip Code</b></label>
    <input type="text" placeholder="Enter Zip Code" name="zip" required>

    <label for="city"><b>City Name</b></label>
    <input type="text" placeholder="Enter City Name" name="city" required>

    <label for="state"><b>State Name</b></label>
    <input type="text" placeholder="Enter State Name" name="state" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    
    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" class="registerbtn">Register</button>

    

    <button class="registerbtn new" onclick="toResturant()">Already a member ? Login here</button>
  </div>
 
</form>

<script>
function toResturant(){
          window.location.href = "index.php";
    }
</script>

</body>
</html>

