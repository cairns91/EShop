<!DOCTYPE html>
<html>
    <?php
    session_start();
    ?>
    <head>
        <link rel="shortcut icon" href="images/cupcake.ico" >
        <title>Sweet Treats</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css.css"/>
        
    </head>
    <body>
        <div id='nav'>
            <a href='index.php'><img src="images/Logo.png" id="logo" alt=""/></a>
                <?php
                    if (isset($_SESSION["customer"])){

                        echo '<ul class="navigation">';
                        echo '<li class="dropdown">';
                        echo '<a class="tab" href="customerView.php">Account</a>';
                        echo '<div class="dropdown-content">';
                        echo '<a href="basket.php">Basket</a>';
                        echo '<a href="logout.php">Log out</a>';
                        echo '</div></li></ul>';

                    } else if (isset($_SESSION["admin"])){
                        echo "<ul class='navigation'>";
                        echo "<li class='dropdown'>";
                        echo "<a href='admin.php'>Admin</a>";
                        echo "<div class='dropdown-content'>";
                        echo "<a href='acceptOrders.php'>Orders</a>";
                        echo "<a href='addProduct.php'>Products</a>";
                        echo "<a href='logout.php'>Log out</a></div</li></ul>";

                    } else {
                        echo "<ul class='navigation'><li class='navigation-Login'><a href='login.php'>Login</a></li></ul>";
                    }
                ?>
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
            <form method='post'>
            <?php
            include 'dbconn.php';
            global $conn;
            //This should loop through all elements of products
            //and generate page from that data

            $sql = "SELECT * FROM `Products` WHERE `type` LIKE 'pastry'";

            $result = $conn->query($sql);
            
            echo "<table><tr>";
$a=array();
            
            while ($row = $result->fetch_assoc()) {
                
                echo "<td>";
                
                echo "<table>";
                echo '<tr><td><a href="product.php?id=' . $row['id'] . '"><img class="pImage" src="' . $row['Image'] . '" alt=""></a></td></tr>';
                echo '<tr><td><a href="product.php?id=' . $row['id'] . '">' . $row['Title'] . '</a></td></tr>';
               
                if (isset($_SESSION["customer"])){
                   
                    $quantName = "quantity".$row['id'];
                    
                    array_push($a,$quantName);
                    
                echo '<tr><td><input type="number" name='.$quantName.' style="font-size:8pt;height:20px;width:100px; background-color: #ffcbb5;" min="1" max="100"></input></td></tr>';
                echo '<tr><td><button type="submit" name="addToBasket" >Add To Basket</button></td></tr>';
                }
                echo '</table>';
                
                echo "</td>";
                
            }
            echo "</tr></table>";
            
            
            if (isset($_POST["addToBasket"])){
                
$arrlength = count($a);

$basketID = null;

if (isset($_SESSION['basketID'])){
    $basketID = $_SESSION['basketID'];
}


for($x = 0; $x < $arrlength; $x++) {
                
                $quant = $_POST[$a[$x]];
                                
                    if ($quant != 0 && $quant != null){
                        
                        $int = intval(preg_replace('/[^0-9]+/', '', $a[$x]), 10);
                        
                        if (isset($_SESSION['basketID'])){
                            $basketID = $_SESSION['basketID'];
                            }
                            else{
                        
                                // Check if user has a previous basket and add the id to the session
                                
                        $sql2 = "INSERT INTO `Orders`(`customerID`, `status`) VALUES (".$_SESSION['customer'].",'Basket')";
                        $result = $conn->query($sql2);
                        
                        $sqlGetDatId = 'SELECT `orderID`, `customerID`, `status` FROM `Orders` WHERE customerID = '.$_SESSION['customer'].' and status = "basket";';
                        $resultGetDatId = $conn->query($sqlGetDatId);
                        
                        if ($resultGetDatId->num_rows > 0){
    
                            while($rowGetDatId = $resultGetDatId->fetch_assoc()){
                                $_SESSION['basketID'] = $rowGetDatId['orderID'];
                            }
}
                        
                            }
                        
                        
                        $sql3 = "INSERT INTO `OrderItem`(`productID`, `orderID`, `amount`) VALUES (".$int.",".$_SESSION['basketID'].",".$quant.")";
                        $result3 = $conn->query($sql3);
                        
                    }
                }
                
            }
            
            ?>       

            </form>
        </div>
    </body>
</html>