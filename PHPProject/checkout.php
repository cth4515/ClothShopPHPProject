<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('shopCart.php');
session_start();
if (!isset($_SESSION['aCart']) || count($_SESSION['aCart']->getCartItems()) === 0)
{
    header('Refresh: 4; URL=product.php');
    echo '<h2>You shopping cart is empty <br /> You will be redirected to our store in 4 seconds.</h2>';
    echo '<h2>If you are not redirected, please <a href="product.php">Click here to visit our Store</a>.</h2>';
    die();
}
require_once('logincheck.php');
require_once ('sql.php');
$productIDs = join(array_keys($_SESSION['aCart']->getCartItems()),',');
$cartList = getProductInCart($productIDs);

$cartItems = count($cartList);
$contactName = $_SESSION['userInfo']['firstname'];
require_once ('site.php');
displayPageHeader("Place Order");
$output = <<<HTML
<section>
<h2 style="text-align: center">Hi $contactName, You have $cartItems product(s) in your cart</h2>
<table>
    <tr>
        <th>Item Name</th>
        <th>Item Quantity</th>
        <th>Unit Price</th>
        <th>Extended price</th>
    </tr>
HTML;
foreach ($cartList as $aItem)
{
    extract($aItem);
    $productQty = $_SESSION['aCart']->getQtyByProductID($productpk);
    $extendedPrice = $productQty * $unitprice;
    $totalPrice += $extendedPrice;
    $formattedExtendedPrice = number_format($extendedPrice, 2);
    $formattedPrice = number_format($unitprice, 2);
    $output .= <<<HTML
    <tr>
        <td>
            $productname
        </td>
        <td style="text-align: right; font-style: normal">
            $productQty
        </td>
        <td style="text-align: right">
            $$formattedPrice
        </td>
        <td style="text-align: right">
            $$formattedExtendedPrice
        </td>
    </tr>
HTML;
}
$formattedTotalPrice = number_format($totalPrice,2);
$output .= <<<HTML
    <tr>
        <td colspan="4" style="text-align: center">
            <b>Your order total is: $$formattedTotalPrice</b>
        </td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center">
        <form action="placeorder.php" method="post">
            <label for="shipstreet">Ship Street:</label>
            <input type="text" name="shipstreet" id ="shipstreet" value="shipstreet" maxlength="30" class="twenty" required="required" pattern="^[a-zA-Z0-9][\w\s\.]*[a-zA-Z0-9\.]$" title="Address has invalid characters" />      
            <label for="shipcity">Ship City:</label>
            <input type="text" name="shipcity" id ="shipcity" value="shipcity" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$" title="City has invalid characters" />
            <label for="shipstate">Ship State:</label>
            <input type="text" name="shipstate" id ="shipstate" value="shipstate" maxlength="2" required="required" pattern="^[a-zA-Z]{2}$" title="Enter a valid state" />  
            <label for="shipzip">Ship Zip:</label>
            <input type="text" name="shipzip" id ="shipzip" value="shipzip" maxlength="10" class="ten" required="required" pattern="^\d{5}(-\d{4})?$" title="Enter a valid 5 or 9 digit zip code" />    
            <p>
            <input type="submit" name="submit" value = "Place Order" />
            </p>
        </form>
        </td>
    </tr>
</table>
<p style="text-align: center">
    <a href="product.php">[Continue shopping]</a>
</p>
</section>
HTML;


echo $output;

displayPageFooter();

?>
