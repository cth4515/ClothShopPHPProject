<link href="styles.css" rel="stylesheet" type="text/css"/>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

if (!isset($_SESSION['userInfo']))
{
    header('location: loginform.php?redirect=' . $_SERVER['PHP_SELF']);
    die();
}
