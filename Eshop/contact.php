<?php
session_start()
?>
<!DOCTYPE html>
<html>
    <head>
        <script>
            function check(){
                var name=document.forms["contactForm"]["name"].value;
                var email=document.forms["contactForm"]["email"].value;
                var message=document.forms["contactForm"]["message"].value;
                var errs="";

                if (name==null || name==""){
                    errs += " *Name is required\n";
                }
                if (email==null || email==""){
                    errs += " *Email address is required\n";
                }
                if (message==null || message==""){
                    errs += " *Message can't be empty\n";
                }
                if (errs!=""){
                    alert (errs);
                }
                return (errs=="");
            }
        </script>
        <link rel="shortcut icon" href="images/cupcake.ico" >
        <title>Contact Us</title>
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
            <?php
            include 'dbconn.php';
            global $conn;
            $name=isset($_POST["name"])? $conn-> real_escape_string($_POST["name"]) : "" ;
            $email=isset($_POST["email"])? $conn-> real_escape_string($_POST["email"]) : "" ;
            ?>
            <div class='formContainer'>
                
                <form name="contactForm" class='inputForm' method="POST" onsubmit="return check();">
                    <div class="titleDiv">
                        <label class='inputLabel'>Contact us by sending an email</label>
                    </div>
                    <table>
                        <tr>
                            <td><label class='inputLabel'>Name:</label></td>
                            <td><input name="name" type="text" value="<?php echo $name?>" /></td>
                        </tr>
                        <tr>
                            <td><label class='inputLabel'>Email:</label></td>
                            <td><input name="email" type="email" value="<?php echo $email?>"/></td>
                        </tr>
                        <tr>
                            <td><label class='inputLabel'>Your message:</label></td>
                            <td><textarea name="message" rows="4"></textarea></td>
                        </tr>
                    </table>
                    <button class='formSubmit' type="submit">Send email</button>
                </form>
            
                <?php 
                    if ($name!=""&&$email!=""){
                        echo "Your message has been sent successfully.";
                    }
                ?>
                
                <div class="centerDiv">
                    <label class="inputLabel">Phone<br>+44(0)20 11111111</label>
                    <br><br><label class="inputLabel">Address<br>15 Richmond St,<br>Glasgow G15 10Q</label>
                </div>
            </div>
        </div>
    </body>
</html>

