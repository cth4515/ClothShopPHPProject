

// checks whether an input control is empty (i.e., the user failed to enter a required input)

function isEmpty(aControl)
{
    return (aControl.value.trim().length === 0) ? true : false;
}

// checks whether the value in an input control contains only digits (0-9)

function isValid(aControl)
{
   // this regular expression literal is used to check whether a string contains just the digits 0-9

   var reg = /^[\w@\.-]+$/;
   return reg.test(aControl.value);  // uses the reqular expression method - test
}

function showAlert(aControl, aMessage)
{
    alert(aMessage);
    aControl.focus(); // sets the focus on the appropriate control
}

// this function receives a form object as its argument and performs multiple validations

function checkForm(aform)
{
    if (isEmpty(aform.username))  // calls the isEmpty method
    {
        showAlert(aform.username, "Please enter your User Name");  // calls the showAlert method
        return false;  // returns false, so the submit event for the form is cancelled
    }
    else if (!isValid(aform.username))  // calls the isDigits method
    {
        showAlert(aform.username, "User Name has invalid characters");  // calls the showAlert method
        return false;  // returns false, so the submit event for the form is cancelled
    }
    else if (isEmpty(aform.userpassword))  // calls the isEmpty method
    {
        showAlert(aform.userpassword, "Please enter your Password");  // calls the showAlert method
        return false;  // returns false, so the submit event for the form is cancelled
    }
    else if (!isValid(aform.userpassword))  // calls the isDigits method
    {
        showAlert(aform.userpassword, "Password has invalid characters");  // calls the showAlert method
        return false;  // returns false, so the submit event for the form is cancelled
    }
    // the form has passed all validation tests; by returning a true value the form's submit event can proceed
    else return true;
}