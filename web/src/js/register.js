/**
 * Summary. Read Register's page form, email and passwords fields 
 *          and check if they are equal each other before post
 *          to server
 * 
 * @return {type} Return false if they do not much each other
 */
function validateForm() {
    
    var email1 = document.forms["register-form"]["register-email1"].value;
    var email2 = document.forms["register-form"]["register-email2"].value;

    var pass1 = document.forms["register-form"]["register-pwd1"].value;
    var pass2 = document.forms["register-form"]["register-pwd2"].value;

    if (email1 !== email2) {
        alert("Emails must match");
        return false;
    }

    if (pass1 !== pass2) {
        alert("Passwords must match");
        return false;
    }

    return true;
  } 