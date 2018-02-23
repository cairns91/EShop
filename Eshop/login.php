<!DOCTYPE html>
<?php
session_start();
?>

<html>
        
    <head>
        <script>
            function check(){
                var email=document.forms["loginForm"]["email"].value;
                var pass=document.forms["loginForm"]["password"].value;
                var errs="";

                if (email==null || email==""){
                    errs += " *Email is required\n";
                }
                if (pass==null || pass==""){
                    errs += " *Password is required\n";
                }
                if (errs!=""){
                    alert (errs);
                }
                return (errs=="");
            }
        </script>
        <link rel="shortcut icon" href="images/cupcake.ico" >
        <title>Log in</title>
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
                    //drop down menu here for customer to access customer account and log out
                } else if (isset($_SESSION["admin"])){
                   echo "<li class='dropdown'>";
                   echo "<a href='admin.php'>Admin</a>";
                   echo "<div class='dropdown-content'>";
                   echo "<a href='acceptOrders.php'>Orders</a>";
                   echo "<a href='addProduct.php'>Add Products</a>";
                   echo "<a href='logout.php'>Log out</a>";
                   echo "</div>";
                   echo "</li>";
                } else {
                    echo "<li class='navigation-Login'><a href='login.php'>Login</a></li>";
                }
                ?>
            </ul>
        </div>
          <?php
            
            include 'dbconn.php';
            global $conn;
             //setting the username,password variables
            
            $email=isset($_POST["email"])? $conn-> real_escape_string($_POST["email"]) : "" ;
            $password=isset($_POST["password"])? $conn-> real_escape_string($_POST["password"]) : "" ;
            
            $sql="SELECT * FROM `Customer`";
            $result= $conn->query($sql);
            
            if ($result->num_rows >0){
                while($row=$result->fetch_assoc()){
                    if ($row["email"]==$email){
                        if (password_verify($password, $row['password'])) {
                            $_SESSION['customer'] = $row['custId'];
                            header("Location: index.php");
                            die();
                        }
                    }                    
                }      
            }
            
            $sql="SELECT * FROM `Admin`";
            $result= $conn->query($sql);
            
            if ($result->num_rows >0){
                while($row=$result->fetch_assoc()){
                    if ($row["name"]==$email){
                        if (password_verify($password, $row['password'])) {
                            $_SESSION['admin'] = True;
                            header("Location: index.php");
                            die();
                        }
                    }                    
                }      
            }     
        ?>
       
        <div class="formContainer">
            <form name="loginForm" class='inputForm' onsubmit="return check();" method="post">
                <div class="titleDiv">
                    <label class="inputLabel">Login</label>
                </div>
                <table> 
                    <tr>
                        <td><label class='inputLabel'>Email:</label></td>
                        <td><input class='' type="email" name="email" value="<?php echo $email?>"></td>
                    </tr>
                    <tr>
                        <td><label class='inputLabel'>Password:</label></td>
                        <td><input class='' type="password" name="password" value="<?php echo $password?>"></td>
                    </tr>
                </table>
                <button class='formSubmit' type="submit">Login</button>
                <?php if ($email!=""&&$password!=""){
                    echo "<br><label style='color: #ff0000;'>Wrong details</label>";
                }?>
            </form>
            <div class="centerDiv">
                <label class="inputLabel">Haven't got an account?</label>
                <button class="createButtton" onclick="location.href='createAccount.php'">Create account</button>
            </div>
        </div>
    </body>
</html>

