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

$street = (isset($_POST['shipstreet'])) ? trim($_POST['shipstreet']) : '';
$city = (isset($_POST['shipcity'])) ? trim($_POST['shipcity']) : '';
$state = (isset($_POST['shipstate'])) ? trim($_POST['shipstate']) : '';
$zip = (isset($_POST['shipzip'])) ? trim($_POST['shipzip']) : '';

$orderIDResult = insertOrder($_SESSION['userInfo']['userpk'],$street,$city,$state,$zip);

$newOrderID = $orderIDResult[0]['newOrderID'];

//insertOrder($_SESSION['userInfo']['userpk'],$street,$city,$state,$zip);
//$orderIDResult = getOrder();
//$newOrderID = $orderIDResult[0]['orderpk'];
foreach($_SESSION['aCart']->getCartItems() as $aKey => $aValue)
{
    insertOrderItem($newOrderID, $aKey, $aValue); 
    $_SESSION['aCart']->deleteCartItem($aKey);
}
include_once ('site.php');

displayPageHeader("Order Confirmation");

$output = <<<ABC
<section>
<h2 style="text-align: center">Thank you for your order</h2>
<p style="text-align: center">
    <a href="product.php">[Back to our store]</a>
</p>
</section>
ABC;


echo $output;

displayPageFooter();

?>
