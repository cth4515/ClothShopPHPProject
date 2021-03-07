<link href="styles.css" rel="stylesheet" type="text/css"/>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

if (isset($_COOKIE[session_name()]))
{
    setcookie(session_name(),"",time()-3600); 
}

$_SESSION = array(); 
session_destroy(); 
session_write_close();

header('Refresh: 2; URL=home.php');

echo '<h2>Thank you for Logging out.  You will now be redirected to our home page.</h2>';

die();
?>