/*
Import Note: The base_url.js hold every every third party base url origin and api's path for the application to work
    for example: the api origin or any api origin
    this url can been use in the application as a variable
*/
 //const api_origin = 'http://127.0.0.1:8000/';
// const api_origin = 'http://52.40.191.249/';
const api_origin = 'https://gateappapi.herokuapp.com/';

//Authentication Paths
const signin                        =    'api/v1/login/admin';
//Dashboard Statistic
//Weeekly
const weeklyEstate                  =    'api/v1/statistics/weeklyEstate';
const weeklyServiceProvider         =    'api/v1/statistics/weeklyService';
const weeklyServiceVisits           =    'api/v1/statistics/weeklyVisits';
//Monthly
const monthlyEstate                 =    'api/v1/statistics/monthlyEstate';
const monthlyServiceProvider        =    'api/v1/statistics/monthlyService';
const monthlyServiceVisits          =    'api/v1/statistics/monthlyVisits';
//All 
const allEstate                     =    'api/v1/statistics/estate';
const allServiceProvider            =    'api/v1/statistics/service';
const allVisits                     =    'api/v1/statistics/visits';
const allUsers                      =    'api/v1/user/all';

//Super Admin - Admin Page 
// Get All Estate Admin Information 
const fetchAllEstateAdmin                = 'api/v1/admin';
const revokeEstateAdminAccess            = 'api/v1/revokeadminaccess';
const resetEstateAdminPassword           = 'api/v1/unrevokeadminaccess';

//Newsletter SUbscribe
const newsletter = 'api/v1/newsletter';

//Service Providers Submit Request on Website
const serviceProviderSubmit = 'api/v1/service_provider/create_request';
