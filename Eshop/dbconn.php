
<?php
//connect to the database
            $servername="devweb2016.cis.strath.ac.uk";
            $username="cs312s";
            $password= "ohrioC4poo3i";
            $database="cs312s"; 
            $conn=new mysqli($servername,$username,$password,$database);

            if ($conn->connect_error){
                die ("Connection failed: ");
            }