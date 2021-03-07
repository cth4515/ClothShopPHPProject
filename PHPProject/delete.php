<link href="styles.css" rel="stylesheet" type="text/css"/>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once ("sql.php");

if ((isset($_GET['productpk'])) && (is_numeric($_GET['productpk'])))
{
    deleteProduct((int)$_GET['productpk']);
}

header("Location: admin.php");
exit;

?>

