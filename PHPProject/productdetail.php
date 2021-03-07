<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$listPage = 'Product.php';

if (!isset($_GET['productpk'])|| !is_numeric($_GET['productpk']))
{
    header('Location:' . $listPage);
    exit();
}
else
{
    $productPK = (int) $_GET['productpk'];

}
require_once ('Sql.php');
require_once ("site.php");
?>

<?php
$productList = getProductDetails($productPK);
if (count($productList) != 1)
{
   header('Location:' . $listPage);
   exit();
}
extract($productList[0]);
$formattedPrice = number_format($unitprice, 2,'.',',');
displayPageHeader($productname);
$output = <<<ABC
    <div class="container">
    <form action="updatecart.php" method = "post">
        <input type="hidden" name="productpk" value ="$productpk" />
        <div class="product-images">
            <img src = "../Images/Product/$imagefile" />   
         </div>  
         <div class="products">
        <div class="product-description">
            <span>$productcategoryname</span>
            <h1>$productname</hi>
            <p>$productdescription</p>   
        </div>
        <div class="product-infor">
                <strong>Size:</strong> $size </br>
               <strong>Color:</strong> $color
        </div>
            <div class="product-price">
                <span>$$formattedPrice</span>
                <input name = "submit" type="submit" value="Add to Cart"  class="cart-btn"/>        
            </div>  
        </br>
                  
   </div>      
    </form> 
        </div>   
            <p style="text-align: center">
                    <a href="product.php">[Go Back Our Store]</a>
        </p> 
 ABC;
echo $output;
displayPageFooter();
?>