<?php
session_start();

if(isset($_SESSION['login'])){

    if (isset($_SESSION['Name'])){
        unset($_SESSION['Name']);
    }
unset($_SESSION['Name']);
unset($_SESSION['login']);
unset($_SESSION['len']);
unset($_SESSION['type']);
unset($_SESSION['addToCart']);

if (isset($_SESSION['Customer'])){
    unset($_SESSION['Customer']);
}

if (isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
}

header('location:index.php');
}else{
    header('location:index.php');  
}
?>