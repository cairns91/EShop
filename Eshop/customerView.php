<html>
    <?php
session_start();
if(!isset($_SESSION['customer'])){
        if ($_SESSION['customer'] !== True){
            header("location:index.php");
        }    
    }
?>
    <head>
        <title>Sweet Treats</title>
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
        
        <div><p>Where customer can update their personal details</p></div>
        
        <div><p>Orders</p></div>
        
        
        
    </body>
</html>