//This handles the validation of the Adding an admin user
//Get the Add Admin Form
const addAdminForm   = document.querySelector('[data-add-estate-admin-form]');
const addAdminButton = document.querySelector('[data-add-admin-btn]');
const selectEstate = document.querySelector('#selectEstate')
const firstOption = selectEstate.options[selectEstate.selectedIndex].value;

//Get the error field
let adminEmailError     = document.querySelector('#adminEmailError');
let estateError  = document.querySelector('#estateError');

const validateForm = () => {


    adminEmailError.innerHTML = " ";
    estateError.innerHTML = " ";

    adminEmailcheck = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    //Convert form to formData
    const formData = new FormData(addAdminForm);
    
    if(formData.get('email') == '') {
        adminEmailError.innerHTML = 'Estate admin email is required';
        permit = false;
        return false;
    }  
    if(!adminEmailcheck.test(formData.get('email'))) {
        adminEmailError.innerHTML = 'Enter a valid email for the admin user';
        permit = false;
        return false;
    } 
    if(selectEstate.options[selectEstate.selectedIndex].value == firstOption) {
        estateError.innerHTML = 'Select an estate to proceed';
        permit = false;
        return false;
    }
    //addAdminButton.removeAttribute('disabled')
    permit = true;


}
addAdminForm.addEventListener('change', () => validateForm(addAdminForm));