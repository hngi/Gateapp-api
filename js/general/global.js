/*
Import Note: The global.js hold every general data that needs that is to run in the app
for example: If the app needs to redirect to login after session has expires
             or another example where token or user data ae destroyed from the broswer
*/
const logout = document.querySelector('[data-admin-logout]');

const logoutAdmin = () => {
    localStorage.removeItem('gateguard-admin');
    location.replace('../login.html');
}


logout.addEventListener('click', logoutAdmin);