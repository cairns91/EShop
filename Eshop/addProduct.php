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
        <title>Add Product</title>
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
			if (image==null){
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
        
        <div class="formContainer">
            <form class="inputForm" action="upload.php" name="addProduct" onsubmit="return check();" method="post" enctype="multipart/form-data">
                <div class="titleDiv">
                    <label class="inputLabel">Add Product</label>
                </div>
                <table>
                    <tr>
                        <td><label class="inputLabel">Name:</label></td>
                        <td><input name="title" type="text"/></td>
                    </tr>
                    <tr>
                        <td><label class="inputLabel">Description:</label></td>
                        <td><input name="description" size="30" type="text"/></td>
                    </tr>
                    <tr>
                        <td><div class="widthDiv"><label class="inputPrice">Price:</label></div></td>
                        <td><input name="price" type="number" step="0.01"/></td>
                    </tr>
                    <tr>
                        <td><label class="inputLabel">Type</label></td>
                        <td>
                            <select name="type">
                                <option value="Cake">Cake</option>
                                <option value="Pastries">Pastries</option>
                                <option value="Treats">Treats</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="inputLabel">Add Image</label></td>
                        <td><input name="image" type="file"/></td>
                    </tr>
                </table>
                <button class="formSubmit" type="submit">Add a product</button>
            </form>
        </div>
    </body>
</html>
