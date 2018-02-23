<?php
session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <link rel="shortcut icon" href="images/cupcake.ico" >
        <title>Sweet Treats</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css.css"/>

    </head>
    <body class='container'>
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
            <p>Here you can find all our fresh products.<br><br>
            Try the best homemade cakes, cupcakes and cookies in town!<br><br>
            Order today and have your fresh goodies next day at your<br>
            doorstep.</p>
        </div>
             
    </body>
</html>
