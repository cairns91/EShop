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
        <title>Sweet Treats</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type = "text/javascript">
    function accept(ID){
        $.ajax( { type : 'POST',
          data : {vl : ID },
          url  : 'accept.php',              
          success: function ( data ) {
            alert(data);
          },
          error: function ( xhr ) {
            alert( "error" );
          }
        });
    }
</script>
        
        <script>
            function check(){
                return true;
            }
        </script>
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
            <div class="formContainer">
                <form class="inputForm" method="post">
            
                    <table border="1px solid black" width="500px">
                        <th><label class="tableHeader">Order No.</label></th>
                        <th><label class="tableHeader">Customer Name</label></th>
                        <th><label class="tableHeader">Quantity</label></th>
                        <th><label class="tableHeader">Total</label></th>
                        <th></th>

                        <?php
                            include 'dbconn.php';
                            global $conn;
                            $sql="SELECT * FROM `Orders` WHERE status='paid'";
                            $result=$conn->query($sql);
                            echo $conn->error;

                            if ($result->num_rows >0) {

                                while($row=$result->fetch_assoc()){

                                    $orderId = $row['orderID'];
                                    $custId = $row['customerID'];

                                    $sqlCustName = "SELECT `name` FROM `Customer` WHERE `custId` = $custId";
                                    $sqlQuantityItems = "SELECT SUM(amount) Amount FROM `OrderItem` WHERE `orderID` = $orderId";
                                    $sqlTotal = "SELECT `productID`, `orderID`, `amount` FROM `OrderItem` WHERE orderID = $orderId";

                                    $resultCustName = $conn->query($sqlCustName);
                                    $resultQuantityItems = $conn->query($sqlQuantityItems);
                                    $resultTotal = $conn->query($sqlTotal);

                                    $customerName;
                                    $quantityItems;
                                    $total = 0;

                                    if ($resultCustName){
                                        if ($resultCustName->num_rows > 0){
                                            $row = $resultCustName->fetch_assoc();
                                            $customerName = $row['name'];
                                        }
                                    }
                                    if ($resultQuantityItems){
                                        if ($resultQuantityItems->num_rows > 0){
                                            $row = $resultQuantityItems->fetch_assoc();
                                            $quantityItems = $row['Amount'];
                                        }
                                    }
                                    if ($resultTotal){
                                        if ($resultTotal->num_rows > 0){
                                            while($row = $resultTotal->fetch_assoc()){

                                                $sql3 = "SELECT `Title`,`Price` FROM `Products` WHERE id = ".$row['productID'];
                                                $result3 = $conn->query($sql3);
                                                $row2 = $result3->fetch_assoc();

                                                $total = $total + ($row["amount"]*$row2['Price']);
                                            }
                                        }
                                    }

                                    echo "<tr><td>$orderId</td>";
                                    echo "<td>$customerName</td>";
                                    echo "<td>$quantityItems</td>";
                                    echo "<td>£$total</td>";
                                    echo "<td><a style='color: blue;' href='viewOrder.php?id=".$orderId."'>VIEW</a></td></tr>";
                                }
                            }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>

