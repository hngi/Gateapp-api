/*
Import Note: The base_url.js hold every every third party base url origin and api's path for the application to work
    for example: the api origin or any api origin
    this url can been use in the application as a variable
*/
// const api_origin = 'http://52.40.191.249/';
const api_origin = 'https://gateappapi.herokuapp.com/';

//Authentication Paths
const signin                        =    'api/v1/login/admin';
//Dashboard Statistic
//Weeekly
const weeklyEstate                  =    'api/v1/statistics/weeklyEstate';
const weeklyServiceProvider         =    'api/v1/statistics/weeklyService';
const weeklyServiceVisits         =    'api/v1/statistics/weeklyVisits';
//Monthly
const monthlyEstate                 =    'api/v1/statistics/monthlyEstate';
const monthlyServiceProvider        =    'api/v1/statistics/monthlyService';
const monthlyServiceVisits        =    'api/v1/statistics/monthlyVisits';

//Newsletter SUbscribe
const newsletter = 'api/v1/newsletter';

//Service Providers Submit Request on Website
