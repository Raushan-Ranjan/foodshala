<?php 

$error = false;
if(isset($_POST['uname'])){
$servername = "localhost";
$username = "root";
$password = "";
$db = "foodshala";
$port=3306;


session_start();

$conn =  mysqli_connect($servername, $username, $password,"",$port);

if (!$conn) {
  die("Connection failed: " . $conn->connect_error);
}else{

  $sql = "CREATE DATABASE if not EXISTS foodshala";
  if ($conn->query($sql) === TRUE) {
    
  } else {
    echo "Error creating database: " . $conn->error;
  }
}

mysqli_select_db($conn, "foodshala");

$uname = $_POST['uname'];
$type = $_POST['type'];
$pwd = $_POST['psw'];

$_SESSION['type'] = $type;


if($type=="customer"){
    $sql = "SELECT * FROM `registerCust` WHERE `email` = '$uname' AND `password` = '$pwd'";  
    $result = $conn->query($sql);
    if($result){
   if ($result->num_rows == 1) {

  $row = $result->fetch_assoc();
    $_SESSION['Customer'] = $row['name'];
    $_SESSION['login'] = true;
    $_SESSION['addToCart'] = true;
    $_SESSION['len'] = 0;
    header('location:customer.php');
  
    echo $row['phone'];
} else {
  $error = true;
 
}
    }else{
      echo "May be You haven't  Register yet | or Internal error";
    }
    
} else{
    $sql = "SELECT * FROM `resturant` WHERE `email` ='$uname' AND `password` = '$pwd'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $_SESSION['Name'] = $row['name'];
      $_SESSION['login'] = true;
    header('location:dashboard.php');
  
 } else {
   echo "Invalid Username/Password";
 }
}

$conn->close();
}

?>





<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}
button.new{
    background-color: gray;
}

.imgcontainer {
    width:20%;
  text-align: center;
  margin: auto;
}

img.avatar {
text-align:center;
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

h3{
    color: red;
  }

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
 
}
</style>
</head>
<body>

<h2>Login Form</h2>

<?php
    
        if($error){
          echo "<h3>Wrong Username/password</h3>";
        }
    ?>

<form action="login.php" method="post">
  <div class="imgcontainer">
    <img src="login.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">

  <label for="type">Login as:</label>
  <select name="type">
    <option value="customer">Customer</option>
    <option value="resturant">Resturant</option>
  </select>
  <br>
  <br>

    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Email as Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
        
    <button type="submit">Login</button>
   


    <button class="new" onclick="onclickRedirect()">New User ? Register as Customer</button>
    <button class="new" onclick="toResturant()">New User ? Register as Resturant</button>
  </div>
</form>

    <script>
       function onclickRedirect(){
          window.location.href = "registrationCusto.php";
    }

    function toResturant(){
          window.location.href = "registrationResturant.php";
    }

    </script>

</body>
</html>
