//This handles the validation of the login form
//Get the Login form 
const loginForm   = document.querySelector('[data-login-form]');
//Get the error field
let emailError    = document.querySelector('#emailError');
let passwordError    = document.querySelector('#passwordError');


const validateForm = (loginForm) => {
    //Clear the error field 
    emailError.innerHTML = '';
    passwordError.innerHTML = '';
    const testEmail  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    //Convert form to formData
    const formData = new FormData(loginForm);
    //Throw error if field is empty
    if(formData.get('email') == '') {
        emailError.innerHTML = 'Please email field is required';
        permit = false;
        return false;
    }
    //Throw error if field is empty
    if(formData.get('password') == '') {
        passwordError.innerHTML = 'Password field is required';
        permit = false;
        return false;
    }
    //Return error if email is invalid
    if(!testEmail.test(String(formData.get('email')).toLowerCase())) {
        emailError.innerHTML = 'Please email is invalid, check email and try again';
        permit = false;
        return false;
    }
    permit = true;
}
loginForm.addEventListener('change', () => validateForm(loginForm));
//Next the login api found 

