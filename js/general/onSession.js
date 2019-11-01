/*
Import Note: This script file should be use to hold data of the currentb user that is login 
*/
//Get the user infor form the browser localStorage
const onsession_admin = JSON.parse(localStorage.getItem('gateguard-admin'));
console.log(onsession_admin);
Swal.fire(
    `logged in`
) 