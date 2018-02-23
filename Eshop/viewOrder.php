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
            
                    <table width="500px" border="1px solid black">
                        <th><label class="tableHeader">Item</label></th>
                        <th><label class="tableHeader">Quantity</label></th>
                        <th><label class="tableHeader">Price</label></th>
                    
                        <?php
                        include 'dbconn.php';
                        global $conn;
                        
                        $id = $conn->real_escape_string(strip_tags($_GET['id']));
                        
                        $sql = "SELECT p.`Title`, p.`Price`, o.`Amount` FROM `Products` p, `OrderItem` o WHERE p.`id` = o.`productID` AND o.`orderID` = $id";
                        
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "<tr><td>".$row['Title']."</td>";
                                echo "<td>".$row['Amount']."</td>";
                                echo "<td>£".$row['Price']."</td></tr>";
                            }
                        }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>

