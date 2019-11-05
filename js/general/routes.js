/*
Import Note: The base_url.js hold every every third party base url origin and api's path for the application to work
    for example: the api origin or any api origin
    this url can been use in the application as a variable
*/
//const api_origin = 'http://127.0.0.1:8000/';
// const api_origin = 'http://52.40.191.249/';
// const api_origin = 'https://gateappapi.herokuapp.com/';


class Routes {

    get api_origin() {
        return 'https://gateappapi.herokuapp.com/';
    }
    //Authentication Paths
    get signin() {
        return 'api/v1/login/admin';
    }
    //Super Admin - Admin Page 
    //Weeekly
    get weeklyEstate() {
        return 'api/v1/statistics/weeklyEstate';
    }
    get weeklyServiceProvider() {
        return 'api/v1/statistics/weeklyService';
    }
    get weeklyServiceVisits() {
        return 'api/v1/statistics/weeklyVisits';
    }
    //Monthly
    get monthlyEstate() {
        return 'api/v1/statistics/monthlyEstate';
    }
    get monthlyServiceProvider() {
        return `api/v1/statistics/monthlyService`;
    }
    get monthlyServiceVisits() {
        return `api/v1/statistics/monthlyVisits`;
    }
    //Monthly
    get allEstate() {
        return 'api/v1/statistics/estate';
    }
    get allServiceProvider() {
        return 'api/v1/statistics/service';
    }
    get allVisits() {
        return 'api/v1/statistics/visits';
    }
    // Get All Estate Admin Information 
    get fetchAllEstateAdmin() {
        return 'api/v1/admin';
    }
    // Get All Estate Admin Information 
    revokeEstateAdminAccess(id) {
        return `api/v1/revokeadminaccess/${id}`;
    }
    resetEstateAdminPassword(id) {
        return `api/v1/unrevokeadminaccess/${id}`;
    }
    //Visitor Banned
    get allBannedVisitor(){
        return `api/v1/visitors/banned/all`;
    }
    removeBannedVisitor(visitor_id) {
        return `api/v1/visitor/${visitor_id}/remove-ban`;
    }
    //Estates
    get addEstate() {
        return `api/v1/estate`;
    }
    editEstate(estate_id) {
        return `api/v1/estate/${estate_id}`;
    }
    //Newsletter Subscribe
    get newsletter() {
        return `api/v1/newsletter`;
    }
    //Service Providers Submit Request on Website
    get serviceProviderSubmit() {
        return `api/v1/service_provider/create_request`;
    }
}

// //Authentication Paths
// const signin = 'api/v1/login/admin';
// //Dashboard Statistic

// //Super Admin - Admin Page 
// //Weeekly
// const weeklyEstate = `api/v1/statistics/weeklyEstate`;
// const weeklyServiceProvider = `api/v1/statistics/weeklyService`;
// const weeklyServiceVisits = `api/v1/statistics/weeklyVisits`;
// //Monthly
// const monthlyEstate = `api/v1/statistics/monthlyEstate`;
// const monthlyServiceProvider = `api/v1/statistics/monthlyService`;
// const monthlyServiceVisits = `api/v1/statistics/monthlyVisits`;
// //All 
// const allEstate = `api/v1/statistics/estate`;
// const allServiceProvider = `api/v1/statistics/service`;
// const allVisits = `api/v1/statistics/visits`;
// // Get All Estate Admin Information 
// const fetchAllEstateAdmin = `api/v1/admin`;

// const revokeEstateAdminAccess = `api/v1/revokeadminaccess`;
// const resetEstateAdminPassword = `api/v1/unrevokeadminaccess`;

// //Estates
// const addEstate = `api/v1/estate`;
// const editEstate = `api/v1/estate/${estate_id}`;//if you want to create something like this declare the variblea globaly at placeholder.js script file and pass whatwver data to it 

// //Newsletter Subscribe
// const newsletter = `api/v1/newsletter`;
// //Service Providers Submit Request on Website
// const serviceProviderSubmit = `api/v1/service_provider/create_request`;
