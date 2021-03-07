<?php

require_once ('shopCart.php');
session_start();
if (isset($_POST['productpk'])){
    if (!isset($_SESSION['aCart']))
    {
        $_SESSION['aCart'] = new shopCart();
            
    }
    if (isset($_POST['productQty']))
    {

        $_SESSION['aCart']->updateCartItem($_POST['productpk'],$_POST['productQty']);

    }
    else
    {
        // call the addCartItem method
        $_SESSION['aCart']->addCartItem($_POST['productpk']);

    }
}

header('location:cart.php');
exit();
?>

