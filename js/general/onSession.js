/*
Import Note: This script file should be use to hold data of the current user that is login 
*/
//Getting the user information form the browser localStorage
const onsessionAdmin = JSON.parse(localStorage.getItem('gateguard-admin'));
//Check if this user is real or else redirect to login
const checkAdmin = () => {
    //Redirect if not true
    !onsessionAdmin ?  location.replace('../login.html') : null;
}
checkAdmin();
//Get the user info through object destructuring
console.log(onsessionAdmin)
const {token, user} = onsessionAdmin;


