<?php 


if(isset($_POST['email'])){
$servername = "localhost";
$username = "root";
$password = "";
$port=3306;


$conn =  mysqli_connect($servername, $username, $password,"",$port);

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


$sql = "CREATE table if not EXISTS registerCust ( name VARCHAR (255) , email varchar(30) PRIMARY KEY, phone VARCHAR (12),password VARCHAR (255))";



if($conn->query($sql)){
  echo "table created successfully";
}else{
  echo   "table not created successfully";
  die();
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pwd = $_POST['password'];

$sql = "INSERT INTO `registerCust`(`name`,`email`, `phone`, `password`) VALUES ('$name','$email','$phone','$pwd')";

if ($conn->query($sql) === TRUE) {
  header('Location:login.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
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

/* Add a blue text color to links */
/* .login {
  color: dodgerblue;
} */

/* Set a grey background color and center the text of the "sign in" section */
.login {
  background-color: lightblue;
  color:black;
  text-align: center;
}
</style>
</head>
<body>

<form action="registrationCusto.php" method="post">
  <div class="container">
    <h1>Register as Customer</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="name"><b>Full Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" required

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="phone"><b>Phone Number</b></label>
    <input type="text" placeholder="Enter Phone Number" name="phone" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    
    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" class="registerbtn">Register</button>
  </div>
  
  <div class="container signin">
    <button class="registerbtn login" onclick="onclickRedirect()"><span>Already have an account?</span> LogIn</button>
  </div>
</form>
<script>
 function onclickRedirect(){
          window.location.href = "login.php";
    }
</script>
</body>
</html>

