<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("sql.php");
if (isset($_POST['userpk']))
{
    updateUser((int)$_POST['userpk'], $_POST['userpassword'], $_POST['email'], $_POST['phone']);
    header('Refresh: 2; URL=home.php');
    echo '<h2>Your information was updated.  You will now be redirected to the home page.<h2>';
    die();
    
}

header("Location: loginform.php");
exit;