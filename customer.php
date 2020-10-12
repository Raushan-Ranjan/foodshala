<?php 

session_start();

include "config.php";

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


   if(isset($_POST['type_option'])){
    
    $filter = $_POST['type_option'] ;
      if($filter == "Veg"){
      $sql = "SELECT * FROM `foodItem` WHERE `type` = '$filter' ORDER BY `company_name`";
      }elseif($filter == "Non-Veg"){
        $sql = "SELECT * FROM `foodItem` WHERE `type` = '$filter' ORDER BY `company_name`";
        }else{
          $sql = "SELECT * FROM `foodItem` ORDER BY `company_name`";
        }
      }else{
          $sql = "SELECT * FROM `foodItem` ORDER BY `company_name`";
        }
  
        
        $result = $conn->query($sql);

       
        $_SESSION['proceed'] = false;

        if($result){
      
        if ($result->num_rows > 0) {
          
          
       
          if (isset($_POST["hidden_type"])){
            if (isset($_SESSION["cart"])){
              
                $item_array_id = array_column($_SESSION["cart"],"food_name");
                if (!in_array($_POST["hidden_fname"],$item_array_id)){
                    $count = count($_SESSION["cart"]);
                    $_SESSION['len']++;
                    
                    $item_array = array(
                        'company_name' => $_POST['hidden_cname'],
                        'food_name' => $_POST["hidden_fname"],
                        'type' => $_POST["hidden_type"],
                        'price' => $_POST["hidden_price"],
                        'qty' => $_POST["quantity"],
                    );
                    $_SESSION["cart"][$count] = $item_array;
                    
                    
                }else{
                    echo '<script>alert("Product is already Added to Cart")</script>';
                   
                }
            }else{
                $item_array = array(
                  'company_name' => $_POST['hidden_cname'],
                  'food_name' => $_POST["hidden_fname"],
                  'type' => $_POST["hidden_type"],
                  'price' => $_POST["hidden_price"],
                  'qty' => $_POST["quantity"],
                );
                $_SESSION["cart"][0] = $item_array;
                $_SESSION['len'] = 1;
                
            }
        }
     

          
        } else {
          echo "0 results";
        }
      }else{
          echo "<h1>No Food Item To Show</h1>";
        }

        if (isset($_GET["action"])){
          if ($_GET["action"] == "delete"){
              foreach ($_SESSION["cart"] as $keys => $value){
                  if ($value["food_name"] == $_GET["id"]){
                      unset($_SESSION["cart"][$keys]);
                      $_SESSION['len']--;
                      
                  }
              }
          }
        }
    
    $conn->close();
    

?>



<!DOCTYPE html>
<html>
    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style>

button.nav-link {
  background-color: #f8f9fa;
  color: white;
  border: none;
  cursor: pointer;
  width: 100%;
}
.section{
    width:65%;
}

.container{
/* display:inline; */
  width:65%;
  float:left;
}

.container-fluid{
width:30%;
float:right;
}

aside{
    width:30%;
}
/* section,aside{
   display:inline;
} */

button:hover {
  opacity: 0.8;
}

.cart{
  width:100%;
}
input[type=text]{
  width:100px;
}

hr{
  border:3px solid green;
}


        </style>

    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <a class="navbar-brand" href="#">FoodShala  welcome  </a>
            <h5 style="color: blue;">
            <?php
                      
            if(!isset($_SESSION['type'])){
              echo ",Hi User    Login to Buy Food Item";
            } else{
             if($_SESSION['type'] === "customer"){
              echo $_SESSION['Customer'] ;
             }
            }
            ?>
            </h5>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               
                
            <form class="ml-auto mr-5" action="customer.php" method="post">
                <select name="type_option">
                
                <option value="Veg">Veg</option>
                <option value="Non-Veg">Non-Veg</option>
                <option value="Both">Both</option>
                
                </select>
                <input type="submit" name="button" value="Filter"/>
                </form>

                
                <ul class="navbar-nav ml-4">      
                    <li class="nav-item">

                    <?php
                    if(isset($_SESSION['type']) == "customer"){
                      ?>
                      <button class="nav-link" id="exit">LogOut</button>
                      <?php
                      } else{
                        ?>
                        <button class="nav-link" id="enter">LogIN</button>

                        <script>
                         var btn = document.getElementById('enter');
                         btn.addEventListener('click', function() {
                          document.location.href = 'login.php';
                        });
                        </script>

                        <?php
                       }
                  ?>
                        
                    </li>
                   
                </ul>
            </div>
        </nav>
    
    

<div class="container-fluid">

  <div class="row">

    <div class="col-md-4 col-lg-10 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">

        <span class="text-muted mt-4">Your have added <?php 

        if(isset($_SESSION['len']) === false){
        echo "0"; 
        }else{
          echo $_SESSION['len'];
        }
        ?> 
        Item to Cart</span>
        
       
      </h4>
      <hr>
      <ul class="list-group mb-3">

       <?php
                if(!empty($_SESSION["cart"])){
                  
                    
                    foreach ($_SESSION["cart"] as $key => $value) {
                        ?>
                        
                        <div class="cart">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                             <h6 class="my-0"><?php echo $value["food_name"]; ?></h6>
                             <small class="text-muted"><?php echo $value["price"]; ?> | <?php echo $value["type"]; ?> | <?php echo $value["company_name"]; ?></small>
                             </div>
                            
                             <span class="text-muted"><?php echo number_format($value["qty"] * $value["price"], 2); ?></span>
                             <a href="customer.php?action=delete&id=<?php echo $value["food_name"]; ?>"><span
                                        class="nav-link">Remove</span></a>
                             </li>
      
                             </div>
                             
                         
                        <?php
                    }
                  }
                ?> 
</ul>

                   <input type="button" id="proceed" value="Proceed" 
                   <?php 
                   if(!isset($_SESSION['len']))
                   { ?> disabled <?php   
                  }elseif($_SESSION['len'] <= 0 ){
                    ?> disabled <?php 
                  }else{
                    echo "";
                  }


                   ?>/>
                      </div>
                     </div>
                 </div>

  

            <div class="container">
              <div class="row">
             
                <?php
           
           if($result){
            if($result->num_rows > 0) {
              

                while ($row = $result->fetch_assoc()) {

                    ?>
                    <div class="col-md-4 mt-4 pl-3">

                        <form method="post" action="customer.php">

                            <div class="product">
                              
                                <h3 class="text-info"><?php echo $row["food_name"]; ?></h3>
                                <h5 class="text-danger"><span>Rs <?php echo $row["price"]; ?></span> | <?php echo $row["type"]; ?></h5>
                                <small class="text-dark">Resturant : <?php echo $row["company_name"]; ?></small>
                               
                                <input type="text" name="quantity" class="form-control" value="1">
                                <input type="hidden" name="hidden_cname" value="<?php echo $row["company_name"]; ?>">
                                <input type="hidden" name="hidden_fname" value="<?php echo $row["food_name"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                                <input type="hidden" name="hidden_type" value="<?php echo $row["type"]; ?>">

                              

                                
                                <input type="submit" name="add" id="addToCart" <?php if(!isset($_SESSION['addToCart'])){ ?> disabled <?php   } ?> style="margin-top: 5px;" class="btn btn-success"
                                       value="Add to Cart">

                               
                                    
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
          }
        ?>                
              </div>
            </div>   

            <script>
            

            
           

            var btn = document.getElementById('exit');
            btn.addEventListener('click', function() {
             document.location.href = 'logOut.php';
            });

           

          
           
            
            var btn = document.getElementById('proceed');
            btn.addEventListener('click', function() {

             <?php
                $_SESSION['proceed'] = true;
             ?>

             document.location.href = 'proceed.php';
    });
            </script>

    </body>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>