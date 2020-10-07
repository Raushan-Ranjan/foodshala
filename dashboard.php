<?php
session_start();
if(isset($_SESSION['type']) != "resturant" && !isset($_SESSION['login'])){
  header('location:login.php');
  die();
}

header("Refresh:60");

if(isset($_POST['name'])){
$servername = "localhost";
$username = "root";
$password = "";
$db = "foodshala";
$port=3306;


$conn =  mysqli_connect($servername, $username, $password,$db,$port);



if (!$conn) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS foodItem (\n"

    . "    company_name VARCHAR (50),\n"

    . "    food_name VARCHAR (25),\n"

    . "    price VARCHAR (4),\n"

    . "    type VARCHAR (7)\n"

    . ")";

    if($conn->query($sql)=== TRUE){
      
    }else{
      echo '<script>alert("Table not created !")</script>';
    }


$company = $_SESSION['Name'];
$name = $_POST['name'];
$price = $_POST['price'];
$type = $_POST['type'];
$resultOrder = "";



$sql = "INSERT INTO `foodItem`(`company_name`,`food_name`, `price`, `type`) VALUES ('$company','$name','$price','$type')";




if ($conn->query($sql) === TRUE) {
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}



$conn->close();
}
?>




<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         
<style>

body {font-family: Arial, Helvetica, sans-serif;}

input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #f8f9fa;
  color: white;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: 100%;
  padding: 10px 18px;
  background-color: lightblue;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4);
  padding-top: 60px;
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto;
  border: 1px solid #888;
  width: 80%;
}

.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
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
      <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a class="navbar-brand" href="#">FoodShala welcome 
        <span style="color: blue;"><?php echo $_SESSION['Name'] ?></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <!-- <a class="nav-link" href="#">Add New Food Item <span class="sr-only">(current)</span></a> -->
                    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="nav-link">Add New Food Item</button>
                </li>
              
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- <a class="nav-link" href="logOut.php">LogOut</a> -->
                    <button style="color: black; padding: 4px;" id="myBtn">LogOut</button>
                   

                </li>
               
            </ul>
        </div>
    </nav>


          <!-- <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 mx-0">
            </main> -->


            <section class="container">
              <div class="row">
                <div class="col">
                  
                </div>
              </div>
            </section>


            <!-- ********************************pop up screen    -*******************              -->
            
            <div id="id01" class="modal">
              
              <form class="modal-content animate" action="dashboard.php" method="post">
                <div class="imgcontainer">
                  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                  <h1>Add New Food Item</h1>
                 
                </div>
            
                <div class="container">
                  <label for="name"><b>Food Name</b></label>
                  <input type="text" placeholder="Enter Food Name" name="name" required><br>
            
                  <label for="price"><b>Price</b></label>
                  <input type="text" placeholder="Enter Price in Rupeess" name="price" required><br><br>

                  <label for="type">Food Type:</label>
                  <select name="type" id="type">
                  <option value="Veg">Veg</option>
                   <option value="Non-Veg">Non-Veg</option>
                 </select>
              <br>
                <br>
                    
                  <button style="background-color: green; padding: 4px;" type="submit">ADD Item</button>
                
                </div>
            
                <div class="container" style="background-color:#f1f1f1">
                  <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                   </div>
              </form>
            </div>


               <!-- *************************************Order ********************************* -->

               <?php 

               include "orders.php";

               ?>
  


            
            <script>
            // Get the modal
            var modal = document.getElementById('id01');
            
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            var btn = document.getElementById('myBtn');
            btn.addEventListener('click', function() {
             document.location.href = 'logOut.php';
});
            </script>
           


    </body>
   </html>