<html style="height:70%;">
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once ("site.php");
displayPageHeader("Contact Page");
?>
    <h2><span style="color:#003300">Contact Us</span></h2>
    <table>
      <tr>
        <td bgcolor="#BCE0A8"><strong>Head Office</strong></td>
        <td bgcolor="#BCE0A8"><strong>Branch Office</strong></td>
      </tr>
      <tr>
        <td>OCS Mart<br/>1500 Meridian Ave &#183; Fort Collins  &#183; CO 80523</td>
        <td>OCS1 Mart<br/>50000 Meridian Ave &#183; Fort Collins  &#183; CO 80523</td>
      </tr>
      <tr>
        <td>Phone: <a href="tel:+19704916359">(970) 491-6359</a></td>
        <td>Phone: <a href="tel:+19701234567">(970) 123-4567</a></td>
      </tr>
      <tr>
        <td>E-mail: <a href="mailto:oscmart@gmail.com">oscmart@gmail.com</a></td>
        <td>E-mail: <a href="mailto:oscmart1@gmail.com">oscmart1@gmail.com</a></td>
      </tr>
    </table>
    <br/>
    <br/>
    <?php
    displayPageFooter();
    ?>
</html>