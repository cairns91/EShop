<?php
session_start();
if(!isset($_SESSION['customer'])){
        if ($_SESSION['customer'] !== True){
            header("location:index.php");
        }    
    }
?>
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
<?php
        
            include 'dbconn.php';
            global $conn;

$sql = "DELETE FROM `Orders` WHERE `Orders`.`orderID`= ". $basketID;


                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
                ?>
