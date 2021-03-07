<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'site.php';

$logFName = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['firstname'] : ""; 
$session = $_SESSION['userInfo'];
displayPageHeader("Home Page");
?>
<section>
<?php
   
if (!empty($logFName))
    {
        echo "<p><h2>Welcome back to online cloth shopping website, $logFName!</h2></p><br/>";
    }
    else
    {
        echo "<p><strong>Hello, and welcome to the online cloth shopping website!</strong></p><br/>";
    }
?>
   <p style="text-align:justify;">Here you can buy various cloth products, such as T-Shirts, Shirts, Jackets, of various well known brands. Customer has to just register on this website and then he or she can buy various cloth products online. You need not to go to shopping mall.</p>
   <br/>
   <p style="text-align:justify;">We provide best quality cloth material. If you have any complain regarding dispatched order feel free to send us feedback. So we can improve our services.</p>
   <br/>
   <p style="text-align:justify;"><strong>We hope you enjoy your visit. Have fun!</strong></p>
</section>

<?php
// call the displayPageFooter method in siteCommon1.php

displayPageFooter();
?>