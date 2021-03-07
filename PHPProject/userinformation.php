<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once ("logincheck.php");
require_once ("sql.php");
require_once ("site.php");
displayPageHeader("User Page");
if ((isset($_SESSION['userInfo']['userpk'])) && (is_numeric($_SESSION['userInfo']['userpk'])))
{
   
    $userdetails = getUserDetailsByID((int)$_SESSION['userInfo']['userpk']);
    extract($userdetails[0]);
    
    $formtitle = 'Update Your Information';
    $buttontext = 'Update';
    
}
?>
<script>
    function checkPassword(form) {
         password1 = form.userpassword.value; 
         password2 = form.repassword.value;
         if (password1 != password2){
             alert ("\nPassword did not match: Please try again...")
             return false; 
         }
         else{
             return true; 
         }
  }
</script>
<section>
   <h2>Welcome back <?php echo $_SESSION['userInfo']['firstname'] ?></h2>
   </section>
<form name ="editForm" id="editForm" action="updateUserInfor.php" method="post" onSubmit = "return checkPassword(this)">
   <?php
        echo '<input type="hidden" name="userpk" value="' . $userpk . '" />';
    ?>
   <label for="userpassword">Password:</label> 
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userpassword; ?>" class="ten" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" />
   
   <label for="repassword">Re-Password:</label> 
   <input type="password" name="repassword" id="repassword" value="<?php echo $repassword; ?>" class="ten"  maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /> 
   
   <label for="email">Email:</label>
   <input type="text" name="email" id ="email" value="<?php echo $email; ?>" maxlength="50" class="twenty" required="required" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" title="Enter a valid email" /> 
   <label for="phone">Telephone:</label>
   <input type="text" name="phone" id ="phone" value="<?php echo $phone; ?>" maxlength="12" class="ten" required="required" pattern="^(\d{3}-)?\d{3}-\d{4}$" title="Enter a valid phone number (xxx-xxx-xxxx)" />
   <p>
    <input onclick="return confirm('Do you want to update?')" type="submit" value="<?php echo $buttontext ?>" />
    <a href="product.php" onclick="return confirm('Do you want to cancel?')">Cancel</a>
   </p>
</form>
<?php

playPageFooter();
?>


