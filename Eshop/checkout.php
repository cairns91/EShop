<?php
session_start();
if(!isset($_SESSION['customer'])){
        if ($_SESSION['customer'] !== True){
            header("location:index.php");
        }    
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
        <script>
            function check(){
                var cardNumber=document.forms["paymentForm"]["cardNumber"].value;
                var cardName=document.forms["paymentForm"]["cardName"].value;
                var ccv=document.forms["paymentForm"]["ccv"].value;
                var month=document.forms["paymentForm"]["month"].value;
                var year=document.forms["paymentForm"]["year"].value;
                var errs="";

                if (cardNumber===null || cardNumber===""){
                    errs += " *Card Number is required\n";
                }
                
                if (cardNumber.length!==16){
                    errs += " *Card Number is wrong\n";
                }
                
                if (cardName===null || cardName===""){
                    errs += " *Name is required\n";
                }
                
                if (ccv===null || ccv==="" || ccv.length!==3){
                    errs += " *CCV is wrong\n";
                }
                
                if (month===null || month===""){
                    errs += " *Month is required\n";
                }
                
                if (year===null || year===""){
                    errs += " *Year is required\n";
                }
        
                if (errs!=""){
                    alert (errs);
                }
                return (errs=="");
            }
        </script>
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
            <?php
        
            include 'dbconn.php';
            global $conn;
            
            $customer = $conn-> real_escape_string($_SESSION['customer']);
            $custsql = "SELECT * FROM `Customer` WHERE custId = '$customer'";
            $custRes = $conn->query($custsql);
            echo "<table style = 'float:center; padding-right:10em;padding-top:5em; padding-left: 10em;'>";
            if ($custRes->num_rows > 0){
                
                while ($custRow = $custRes->fetch_assoc()){
                    echo "<tr><td>Name </td><td>".$custRow['name']."</td></tr>";
                    echo "<tr><td>Address </td><td>".$custRow['address']."</td></tr>";
                    echo "<tr><td>Phone Number </td><td>".$custRow['phoneNo']."</td></tr>";
                    echo "<tr><td>Email </td><td>".$custRow['email']."</td></tr>";
                    echo "</table>";
                }
            }

            
            echo "<table style = 'float:center; padding-right:10em;padding-top:5em; padding-left: 10em;'>";

            $basketID = null;
            $totalPrice = 0;

            $sqlGetBasketId = "SELECT `orderID`, `customerID`, `status` FROM `Orders` WHERE customerID = " . $_SESSION['customer'] . " and status = 'basket'";
            $resultGetBasketId = $conn->query($sqlGetBasketId);

            if ($resultGetBasketId->num_rows > 0) {
                $rowGetBasketId = $resultGetBasketId->fetch_assoc();
                $basketID = $rowGetBasketId['orderID'];
                $_SESSION['basketID'] = $basketID;
            }


            $sql2 = "SELECT `productID`, `orderID`, `amount` FROM `OrderItem` WHERE orderID = " . $basketID;
            $result2 = $conn->query($sql2);

            if ($result2) {

                if ($result2->num_rows > 0) {

                    while ($row2 = $result2->fetch_assoc()) {

                        $sql3 = "SELECT `Title`,`Price` FROM `Products` WHERE id = " . $row2['productID'];
                        $result3 = $conn->query($sql3);
                        $row3 = $result3->fetch_assoc();

                        echo "<tr><td>Name - " . $row3["Title"] . "</td><td>  x" . $row2["amount"] . "</td><td>  Price - £" . ($row2["amount"] * $row3['Price']) . "</td></tr>";
                        $totalPrice = $totalPrice + ($row2["amount"] * $row3['Price']);
                    }
                }
            } else
                echo 'There is nothing here yet';


            echo "<tr> The Total Price for this order is: £" . $totalPrice . "</tr>";


//PlaceHolder for the Purchase page, just add a redirect + set the price session variable

            echo "</table>";
            
            echo "<table style = 'float:center; padding-right:10em;padding-top:5em; padding-left: 10em;'>";
            echo "<form name='paymentForm' action='payment.php', onsubmit='return check()', method='post'";
            echo "<tr><td>Credit card number</td><td><input type='number' name='cardNumber'></td></tr>";
            echo "<tr><td>Cardholder name</td><td><input type='text' name='cardName'></td></tr>";
            echo "<tr><td>CCV</td><td><input type='number' name='ccv'></td></tr>";
            echo "<tr><td>Expiry date</td><td><input type='number' name='month' min='1' max='12'>";
            echo "/<input type='number' name='year' min='2016' max='3000'></td></tr>";
            echo "<tr><td><input type='submit' value='Confirm'></td></tr>";
            echo "</table>";
            ?>
            
        </div>
    </body>
</html>
