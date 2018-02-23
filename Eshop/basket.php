<?php
session_start();
if(!isset($_SESSION['customer'])){
        header("location:index.php");   
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="shortcut icon" href="images/cupcake.ico" >
        <title>Added to Basket</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css.css"/>
    </head>
    <body>
        <div id='nav'>
            <a href='index.php'><img src="images/Logo.png" id="logo" alt=""/></a>
            <ul class="navigation">
                <li class="dropdown">
                    <a class="tab" href="customerView.php">Account</a>
                    <div class="dropdown-content">
                        <a href="basket.php">Basket</a>
                        <a href="logout.php">Log out</a>
                    </div>
                </li>
            </ul>
            <ul class='navigation'>
                <li class='dropdown'>
                    <a class="tab">Bakery</a>
                    <div class='dropdown-content'>
                        <a href='productsCakes.php'>Cakes</a>
                        <a href='productsPastries.php'>Pastries</a>
                        <a href='productsTreats.php'>Treats</a>
                    </div>
                </li>
                <li class='navigation-Contact'><a class="tab" href='contact.php'>Contact</a></li>
            </ul>
        </div>
        <br><h3>Shopping Basket</h3>
        <div>
            <form method='post'>
            <?php
        
                include 'dbconn.php';
                global $conn;

                echo "<table style = 'float:center; padding-right:10em;padding-top:5em; padding-left: 10em;'>";

                $basketID = null;
                $totalPrice = 0;

                $sqlGetBasketId = "SELECT `orderID`, `customerID`, `status` FROM `Orders` WHERE customerID = ".$_SESSION['customer']." and status = 'basket'";
                $resultGetBasketId = $conn->query($sqlGetBasketId);

                if ($resultGetBasketId->num_rows > 0){
                    $rowGetBasketId = $resultGetBasketId->fetch_assoc();
                    $basketID = $rowGetBasketId['orderID'];
                    $_SESSION['basketID'] = $basketID;
                }


                $sql2 = "SELECT `productID`, `orderID`, `amount` FROM `OrderItem` WHERE orderID = ".$basketID;
                $result2 = $conn->query($sql2);

                if ($result2){

                    if ($result2->num_rows > 0){

                        while($row2 = $result2->fetch_assoc()){

                        $sql3 = "SELECT `Title`,`Price` FROM `Products` WHERE id = ".$row2['productID'];
                        $result3 = $conn->query($sql3);
                        $row3 = $result3->fetch_assoc();

                        echo "<tr><td>Name - ".$row3["Title"]."</td><td>  x".$row2["amount"]."</td><td>  Price - £".($row2["amount"]*$row3['Price'])."</td></tr>";
                        $totalPrice = $totalPrice + ($row2["amount"]*$row3['Price']);
                    }
                }
            } else echo 'There is nothing here yet';


        echo "<tr> The Total Price for this order is: £".$totalPrice."</tr>";


        //PlaceHolder for the Purchase page, just add a redirect + set the price session variable

        echo "</table>";
        
        
        echo '<button type="submit" name="emptyBasket" >Empty Basket</button>';
        
        if (isset($_POST["emptyBasket"])){
            
            $sql1 = "DELETE FROM `Order` WHERE orderID =".$_SESSION['basketID'];
            $sql2 = "DELETE FROM `OrderItem` WHERE orderID =".$_SESSION['basketID'];
            
            $result1 = $conn->query($sql1);
            $result2 = $conn->query($sql2);
            
            unset($_SESSION['basketID']);
            
            header("Refresh:0");
            
        }

        
        ?>
            

            </form>
            
            <button onclick="window.location.href='checkout.php'">Checkout</button>

        </div>
    </body>
</html>
