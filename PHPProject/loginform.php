

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once("sql.php");
require_once ("site.php");
displayPageHeader("Login");
$userName = (isset($_POST['username'])) ? trim($_POST['username']) : '';
$userPassword = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';
$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'product.php';

if (isset($_POST['login']))
{
    $userList = getUser($userName, $userPassword);

    if (count($userList)===1)
    {
        extract($userList[0]);
        $userInfo = array('userpk'=>$userpk, 'firstname'=>$firstname, 'role'=>$role, 'username'=>$username);
        $_SESSION['userInfo'] = $userInfo;
        header('location:' . $redirect);
                   
        die();
    }

    else 
    {
        $error = 'Invalid login credentials<br />Please try again.';
    }
}


echo "<section>";

if (isset($error))
{
    echo '<div id="error">' . $error . '</div>';
}
?>
<script src="validate.js" type="text/javascript"></script>

<form name ="loginform" id="loginform" action="loginform.php" method = "post" onsubmit="return checkForm(this)">
   <input type="hidden" name ="redirect" value ="<?php echo $redirect ?>" />
   <label for="username">Username:</label>
   <input type="text" name="username" id ="username" value="<?php echo $userName; ?>" maxlength="50" onfocus="this.select()"  autofocus="autofocus"/>
   <label for="userpassword">Password:</label> 
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" maxlength="20" onfocus="this.select()" />
      <p>
         <input type="submit" value="Login" name="login" id="btn-login"/> <br/>
         <span style="margin-left: 100px;"> New customer?  <a href="register.php">Register Here</a></span>
      </p>
</form>
</section>

<?php
displayPageFooter();
?>