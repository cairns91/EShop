<?php
    session_start();
    if (isset($_SESSION["customer"]) || isset($_SESSION["admin"])){
        header("location:index.php");       
    }
?>
<!DOCTYPE html>
<html>
        
    <head>
        <script>
            function check(){
                var email=document.forms["create_acc"]["email"].value;
                var pass=document.forms["create_acc"]["pass"].value;
                var name=document.forms["create_acc"]["name"].value;
                var address=document.forms["create_acc"]["address"].value;
                var phone=document.forms["create_acc"]["phone"].value;
                var errs="";

                if (email==null || email==""){
                    errs += " *Email is required\n";
                }
                if (pass==null || pass==""){
                    errs += " *Password is required\n";
                }
                if (name==null || name==""){
                    errs += " *Full Name is required\n";
                }
                if (address==null || address==""){
                    errs += " *Address is required\n";
                }
                if (phone==null || phone==""){
                    errs += " *Phone number is required\n";
                }
                if (errs!=""){
                    alert (errs);
                }
                return (errs=="");
            }
        </script>
        <link rel="shortcut icon" href="images/cupcake.ico" >
        <title>Create Account</title>
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
                <li class='navigation-Login'><a href='login.php'>Login</a>
                
            </ul>
        </div>
        <div class="formContainer">
            <form class="inputForm" name="create_acc" method="post" onsubmit="return check()">
                <div class="titleDiv">
                    <label class='inputLabel'>Create Account</label>
                </div>
                    
                <table>
                    <tr>
                        <td><label class='inputLabel'>Email:</label></td>
                        <td><input name="email" type="email"/></td>
                    </tr>
                    <tr>
                        <td><label class='inputLabel'>Password:</label></td>
                        <td><input name="pass" type="password"/></td>
                    </tr>
                    <tr>
                        <td><label class='inputLabel'>Full name:</label></td>
                        <td><input name="name" type="text"/></td>
                    </tr>
                    <tr>
                        <td><label class='inputLabel'>Address:</label></td>
                        <td><input name="address" type="text"/></td>
                    </tr>
                    <tr>
                        <td><label class='inputLabel'>Phone number:</label></td>
                        <td><input name="phone" type="text"/></td>
                    </tr>
                    
                </table>
                <button class='formSubmit' type="submit">Create Account</button>
            </form>
            
            <?php
                include 'dbconn.php';
                global $conn;
                 //setting the username,password variables


                $email=isset($_POST["email"])? $conn-> real_escape_string($_POST["email"]) : "" ;
                $pass=isset($_POST["pass"])? $conn-> real_escape_string($_POST["pass"]) : "" ;
                $name=isset($_POST["name"])? $conn-> real_escape_string($_POST["name"]) : "" ;
                $address=isset($_POST["address"])? $conn-> real_escape_string($_POST["address"]) : "" ;
                $phone=isset($_POST["phone"])? $conn-> real_escape_string($_POST["phone"]) : "" ;
                if (!empty($email) && !empty($pass)){
                echo "<label>Account Created</label>";
                $unique = True;

                $sql="SELECT * FROM `Customer` where email = '$email'";
                $result= $conn->query($sql);
                if ($result->num_rows > 0){
                    $unique=False;
                }

                if ($unique === True){
                    $hash = password_hash($pass, PASSWORD_BCRYPT);
                    $sql = "INSERT INTO `Customer` (`password`, `email`, `name`, `address`, `phoneNo`)"
                            . " VALUES ('$hash', '$email', '$name', '$address', '$phone')";
                    $conn->query($sql);

                }
                }
            ?>
            <div class="centerDiv">
                <button class="formSubmit" onclick="goBack()">Go Back</button>
                
            </div>
            
            <script>
                    function goBack() {
                        window.history.back();
                    }
                </script>
        
        
        </div>
    </body>
</html>

