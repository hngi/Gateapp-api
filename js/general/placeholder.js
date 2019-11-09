/*
Import Note: The placeholder.js hold every repeated data that needs to be appllied to more than 3 pages 
for example-> The website title or name should be place in the placholder

*/
//Website Title Placeholder
const website_title = 'GateGuard';
//insert into DOM
const title = document.querySelector('[data-title]');

title.innerHTML = `${website_title} | ${title.innerHTML}`

//Wesite Logo 
const website_logo = '';
//Api status code placeholder
let status;
//This permit placeholder is use to allow a button to work after the validation has been met
let permit = false;
