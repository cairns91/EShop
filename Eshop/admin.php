<?php
session_start();
if(!isset($_SESSION['admin'])){
        if ($_SESSION['admin'] !== True){
            header("location:index.php");
        }    
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <link rel="shortcut icon" href="images/cupcake.ico" >
        <title>Admin Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css.css"/>

    </head>
    <body>
        <div id='nav'>
            <a href='index.php'><img src="images/Logo.png" id="logo" alt=""/></a>
            <ul class="navigation">
                <li class='dropdown'>
                    <a href='admin.php'>Admin</a>
                    <div class='dropdown-content'>
                        <a href='acceptOrders.php'>Orders</a>
                        <a href='addProduct.php'>Products</a>
                        <a href='logout.php'>Log out</a>
                    </div>
                </li>
            </ul>
            <ul class='navigation'>
                <li class='dropdown'>
                    <a>Bakery</a>
                    <div class='dropdown-content'>
                        <a href='productsCakes.php'>Cakes</a>
                        <a href='productsPastries.php'>Pastries</a>
                        <a href='productsTreats.php'>Treats</a>
                    </div>
                </li>
                <li class='navigation-Contact'><a href='contact.php'>Contact</a></li>
            </ul>
        </div>
        <div>       
            <br><h3>Admin website</h3>
            <p><a href="addProduct.php" >Add a product</a><br>
                <a href="acceptOrders.php" >Accept orders</a>
            </p>
        </div>
             
    </body>
</html>
