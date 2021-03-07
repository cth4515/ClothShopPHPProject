<html style="height:89%;">
<link href="styles.css" rel="stylesheet" type="text/css"/>
<?php

require_once ('shopCart.php');
session_start();
if (!isset($_SESSION['aCart']) || count($_SESSION['aCart']->getCartItems()) === 0)
{
    header('Refresh: 4; URL=product.php');
    echo '<h2>You shopping cart is empty <br /> You will be redirected to our store in 4 seconds.</h2>';
    echo '<h2>If you are not redirected, please <a href="product.php">Click here to visit our Store</a>.</h2>';
    die();
}

require_once ('Sql.php');
require_once ("site.php");
$productIDs = join(array_keys($_SESSION['aCart']->getCartItems()), ',');
$cartList = getProductInCart($productIDs);
$cartItems = count($cartList);
displayPageHeader("View Cart");
$output = <<<HTML
<section>
<h2 style="text-align: center">You have $cartItems product(s) in your cart</h2>

<table>
    <tr>
        <th>Product Name</th>
        <th>Product Quantity</th>
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
        <td>
            <form action="updatecart.php" method="post">
                <input type="hidden" name="productpk" value="$productpk" />
                <input type="number" name="productQty" value="$productQty" size="3" maxlength="3" required="required" min="0" max="500" />
                <input type="submit" name="submit" value="Update Quantity" />
            </form>
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
        <td colspan="2" style="text-align: center">
            <b>Your order total is: $$formattedTotalPrice</b>
        </td>
        <td colspan="2" style="text-align: center">
        <form action="checkout.php" method="post">
            <input type="submit" name="submit" id="proceed" value = "Checkout" />
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
</html>
