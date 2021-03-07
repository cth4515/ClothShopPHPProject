<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once ("site.php");
displayPageHeader("About Us");
?>
    <div class="aboutus">
    <h2>Hello!</h2>
    <h1>Who We Are</h2>
    <p>Team 103 is owned and operated in Colorado, with 2 retail locations. We were the #1 most-searched fashion brand on Google in 2020. We are devoted to delivering the most sought-after, head-turning, up-to-the-moment trends, to anyone, anywhere in the world!</p>
    <br/>
    <p>We believe in a world where you have total freedom to be you. To experiment. To express yourself. So we make sure everyone has an equal chance to discover all the amazing things they’re capable of – no matter who they are, where they’re from. We exist to give you the confidence to be whoever you want to be.</p>
    <br/>
    
    <table style="border: none;">
       <div class="row">
       <tr style="color: white; background-color: black;">
           <div class="column">
           <td style="border:0;width: 50%;">
               <h4>Our mission</h4>
               <p style="font-style: italic;">Team103 is a catalyst for women to feel, see, and claim their power.</p>
           </td>
           </div>
            <div class="column">
           <td style="border:0;width: 50%;">
               <h4>Our essence</h4>
               <p><strong>At our core, Team103 operates on Imagination, Individuality, Inclusivity, & Impact.</strong></p>
           </td>
       </tr>
       </div>
       <div class="column">
           <tr style="color: white; background-color: black;">
          <div class="column">
           <td style="border:0;width: 50%;">
               <h4>Our promise</h4>
               <p style="font-style: italic;">We deliver optimistic and diverse storytelling, experiences, and points of view to our audience of smart, curious, passionate women.</p>
           </td>
          <div>
          <div class="column">
           <td style="border:0;width: 50%;">
               <h4>Our vibe</h4>
               <p><strong>At Team103, we make magic. We dream it, and then do it—together—every day reinventing what's possible.</strong></p>
           </td>
       </tr>  
       </div>
   </table>
    </div>
    <?php
    displayPageFooter();
    ?>