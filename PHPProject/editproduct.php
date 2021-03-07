<link href="styles.css" rel="stylesheet" type="text/css"/>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("sql.php");

if (isset($_POST['productpk']))
{
    updateProduct((int)$_POST['productpk'],(int)$_POST['categorypk'], $_POST['productname'], $_POST['productdescription'], $_POST['unitprice'],
             $_POST['onhand'], $_POST['imagefile'], $_POST['size'], $_POST['color']);
}
else 
{
    addProduct((int)$_POST['categorypk'], $_POST['productname'], $_POST['productdescription'], $_POST['unitprice'],
             $_POST['onhand'], $_POST['imagefile'], $_POST['size'], $_POST['color']);
}

header("Location: admin.php");
exit;

?>

