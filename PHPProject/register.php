
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("sql.php");
require_once ("site.php");
$userName = (isset($_POST['username'])) ? trim($_POST['username']) : '';
$userPassword = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';

$repassword = (isset($_POST['repassword'])) ? trim($_POST['repassword']) : '';

$firstName = (isset($_POST['firstname'])) ? trim($_POST['firstname']) : '';
$lastName = (isset($_POST['lastname'])) ? trim($_POST['lastname']) : '';
$eMail = (isset($_POST['email'])) ? trim($_POST['email']) : '';
$phone = (isset($_POST['phone'])) ? trim($_POST['phone']) : '';

if (isset($_POST['register']))
{
    $result = findDuplicateUser($userName); 
   
    if (count($result) > 0)
    {
        $error = 'Please choose a different Username';
    }
    elseif($userPassword != $repassword){
        $error ='Passwords didn\'t match';
    }
    else
    {
        $role = "regular";
        addCustomer($userName, $userPassword, $firstName, $lastName, $role, $eMail, $phone);
        header('Refresh: 2; URL=loginform.php');
        echo '<h2>Thank you for Registering.  You will now be redirected to the login page.<h2>';
        die();
    }
}
displayPageHeader("New Member Registration");
echo "<section>";
if (!empty($error))
{
    echo '<div id="error">' . $error . '</div>';
}
?>
<form name ="addUserForm" id="addUserForm" action="register.php" method="post">
   <label for="username">Username:</label>
   <input type="text" name="username" id ="username" value="<?php echo $userName; ?>" class="ten" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" />
   <label for="userpassword">Password:</label> 
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" class="ten" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" />
   <label for="repassword">Re-Password:</label> 
   <input type="password" name="repassword" id="repassword" value="<?php echo $repassword; ?>" class="ten" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /> 
   <label for="firstname">First Name:</label>
   <input type="text" name="firstname" id ="firstname" value="<?php echo $firstName; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="First Name has invalid characters" />
   <label for="lastname">Last Name:</label>
   <input type="text" name="lastname" id ="lastname" value="<?php echo $lastName; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="Last Name has invalid characters" />
    <label for="email">Email:</label>
   <input type="text" name="email" id ="email" value="<?php echo $eMail; ?>" maxlength="50" class="twenty" required="required" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" title="Enter a valid email" /> 
   <label for="phone">Telephone:</label>
   <input type="text" name="phone" id ="phone" value="<?php echo $phone; ?>" maxlength="12" class="ten" required="required" pattern="^(\d{3}-)?\d{3}-\d{4}$" title="Enter a valid phone number (xxx-xxx-xxxx)" />
   <p>
      <input type="submit" value="Register" name="register" /> <br />
   </p>
</form>
</section>
<?php
displayPageFooter();
?>
