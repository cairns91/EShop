<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <script>
            function check(){
                var quantity=document.forms["quantityForm"]["quantity"].value;
                errs="";
                if (quantity==null || quantity==""){
                    errs+=" *Quantity is required";
                    alert(errs);
                }
                return (errs=="");
            }
        </script>
        <link rel="shortcut icon" href="images/cupcake.ico" >
        <title>Products</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css.css"/>

    </head>
    <body>
        <div id='nav'>
            <a href='index.php'><img src="images/Logo.png" id="logo" alt=""/></a>
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
                
                <?php
                if (isset($_SESSION["customer"])){
                    echo "<li class='navigation-Basket'><a href='basket.php'>Basket</a></li>";
                    echo "<li class='navigation-Logout'><a href='logout.php'>Log out</a></li></ul>";
                    //drop down menu here for customer to access customer account and log out
                } else if (isset($_SESSION["admin"])){
                    echo "<ul class='navigation'>";
                    echo "<li class='dropdown'>";
                    echo "<a href='admin.php'>Admin</a>";
                    echo "<div class='dropdown-content'>";
                    echo "<a href='acceptOrders.php'>Orders</a>";
                    echo "<a href='addProduct.php'>Products</a>";
                    echo "<a href='logout.php'>Log out</a></div</li></ul>";

                } else {
                    echo "<li class='navigation-Login'><a href='login.php'>Login</a></li>";
                }
                ?>
            </ul>
        </div>
        <div>
          <?php
          include 'dbconn.php';
          global $conn;
          //This should loop through all elements of products
          //and generate page from that data
          $id = $conn->real_escape_string(strip_tags($_GET['id']));
          $sql = "SELECT * FROM `Products` WHERE id = '$id'";

          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          echo '<p>'.$row['Title'].'
                <br><img class="productImage" src="'.$row['Image'].'" alt="" >
                <br>'.$row['Description'].'
                <br>'.$row['Price'].' Price</p>';
          
          if (isset($_SESSION['admin'])) {
            if ($_SESSION['admin'] == True){
                echo "<form method='POST', action='editProduct.php'>"
                ."<input name='id', type='hidden', value='$id'></input>"
                . "<input id='editButton' type='submit', value='Edit'></input></form>";
            }
        }
          ?>
          <button onclick="goBack()">Back</button>
          <script>
                function goBack() {
                    window.history.back();
                }
          </script>         
        </div>
    </body>
</html>
