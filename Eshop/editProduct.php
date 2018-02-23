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
        <title>Edit</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css.css"/>

        
        <script>
            function check(){
                var title=document.forms["addProduct"]["title"].value;
                var descr=document.forms["addProduct"]["description"].value;
                var price=document.forms["addProduct"]["price"].value;
	        	var image=document.forms["addProduct"]["image"].value;
				var errs="";

			if (title==null || title==""){
				errs += " *Title is required\n";	
			}
			if (descr==null || descr==""){
				errs += " *Description is required\n";
			}
			if (price==null || price==0){
				errs += " *Price is required\n";
			}
			if (image!==null){
				errs += " *Image is required\n";
			}
			if (errs!=""){
				alert (errs);
			}
			return (errs=="");
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
            <br><h3>Add a product</h3>
            <?php
            include 'dbconn.php';
            global $conn;
            $id=$_POST['id'];
            $sql = "SELECT * FROM `Products` WHERE id='$id'";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $title=$row['Title'];
            $description=$row['Description'];
            $price=$row['Price'];
            $image=$row['Image'];
            
            echo "<p>"
                ."<form action='edit.php' name='edit' method='post' enctype='multipart/form-data'>"
                ."Product name<br>"
                ."<input name='title' type='text' value='$title'/><br>"
                ."Product description<br>"
                ."<input name='description' size='30' type='text' value='$description'/><br>"
                ."Price<br>"
                ."<input name='price' type='number' step='0.01' value='$price'/>"
                ."<br>Add an image<br>"
                ."<input name='image' type='file' value'$image'/>"
                ."<input name='id', type='hidden' value='$id'></input>"
                ."<button type='submit'>Add a product</button>"
                ."</form>"
            ?>
        </div>
             
    </body>
</html>
