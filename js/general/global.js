/*
Import Note: The global.js hold every general data that needs that is to run in the app
for example: If the app needs to redirect to login after session has expires
             or another example where token or user data ae destroyed from the broswer
*/

//Logout Code
const logout = document.querySelector('[data-admin-logout]');

const logoutAdmin = () => {
    localStorage.removeItem('gateguard-admin');
    location.replace('../login.html');
}

logout.addEventListener('click', logoutAdmin);

//Resize Sidebar in mobile view

function myFunction(x) {
  if (x.matches) { // If media query matches

   const sideBar = document.querySelector('#sidebar');
   sideBar.classList.remove('active');
  } else {
    const sideBar = document.querySelector('#sidebar');
    sideBar.classList.add('active');
  }
}

var x = window.matchMedia("(max-width: 768px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes

