<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function displayPageHeader($pageTitle)
{
   $output = <<<ABC
        <!DOCTYPE html>
        <html>
           <head>
              <meta charset="UTF-8" />
              <title>$pageTitle</title>
              <link rel="stylesheet" href="styles.css" type="text/css" />
           </head>

           <body>
              <header>
                <div id="header"><a href="home.php"><img src="../Images/header.jpg" alt="Online Shoppng" /></a></div>
                <h2>CLOTH SHOPPING - $pageTitle</h2>
                <div class="contain-link">
                <ul id="navCircle">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="product.php">Products</a></li>
ABC; 
   
    if(!(isset($_SESSION['userInfo']))){
        $output .= <<<ABC
                    <li><a href="loginform.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
         ABC;
    
    }
    elseif ((isset($_SESSION['userInfo']))){
        $output .= <<<ABC
                    <li><a href="logout.php">Logout</a></li>
         ABC;
        if($_SESSION['userInfo']['role'] == "Admin"){
            $output .= <<<ABC
                    <li><a href="admin.php">Admin</a></li>
            ABC;
        }
        else{
            $output .= <<<ABC
                     <li><a href="userinformation.php?userpk={$_SESSION['userInfo']['userpk']}">Profile</a></li>
            ABC;
        }  
    }
        $output .= <<<ABC
                    <li><a href="search.php">Search</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                   <li><a href="cart.php">View Cart</a></li>
                </ul>
                </div>
              </header>
ABC;
   echo $output;
}
   
function displayPageFooter()
{
   $year = date('Y');
   $output = <<<ABC
   <footer>
      <address>
         &copy; $year Online Cloth Shopping| Design by team 103
      </address>
   </footer>   
 </body>
</html>
ABC;
   echo $output;
}
?>
