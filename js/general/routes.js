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
    return "https://api.gateguard.co/";
  }
  //Authentication Paths
  get signin() {
    return "api/v1/login/admin";
  }
  //Super Admin - Admin Page
  //Weeekly
  get statWeeklyEstate() {
    return "api/v1/statistics/weeklyEstate";
  }
  get statWeeklyServiceProvider() {
    return "api/v1/statistics/weeklyService";
  }
  get statWeeklyServiceVisits() {
    return "api/v1/statistics/weeklyVisits";
  }
  //Monthly
  get statMonthlyEstate() {
    return "api/v1/statistics/monthlyEstate";
  }
  get statMonthlyServiceProvider() {
    return `api/v1/statistics/monthlyService`;
  }
  get statMonthlyServiceVisits() {
    return `api/v1/statistics/monthlyVisits`;
  }
  //Monthly
  get statAllEstate() {
    return "api/v1/statistics/estate";
  }
  get statAllServiceProvider() {
    return "api/v1/statistics/service";
  }
  get statAllVisits() {
    return "api/v1/statistics/visits";
  }
  //Create an Estate Admin
  get addAdmin() {
    return `api/v1/create/estate_admin`;
  }

  generalStats(id) {
    return `api/v1/statistics/estate/${id}`;
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
    //Get all estates
    get allEstates() {
        return `api/v1/public/estates`;
    }
    //Get service provider categories
    get serviceProviderCategory() {
        return `api/v1/public/sp-categories`;
    }
    path(path) {
        return path;
    }

  // Get All Estate Admin Information
  get fetchAllEstateAdmin() {
    return "api/v1/admin";
  }
  // Get All Estate Admin Information
  revokeEstateAdminAccess(id) {
    return `api/v1/revokeadminaccess/${id}`;
  }
  restoreEstateAdminAccess(id) {
    return `api/v1/unrevokeadminaccess/${id}`;
  }
  resetEstateAdminPassword(id) {
    return `api/v1/resetadminpass/reset/${id}`;
  }

  //Visitor Banned
  get allBannedVisitor() {
    return `api/v1/visitors/banned/all`;
  }
  removeBannedVisitor(visitor_id) {
    return `api/v1/visitor/${visitor_id}/remove-ban`;
  }
  //Estates
  get addEstate() {
    return `api/v1/estate`;
  }
  get fetchEstates() {
    return `api/v1/estates`;
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
  // Get all Service Providers
  get allServiceProvider() {
    return `api/v1/service_provider`;
  }
  // Suspend service provider
  suspendServiceProvider(id) {
    return `api/v1/service_provider/suspend/${id}`;
  }
  // Remove service provider
  removeServiceProvider(id) {
    return `api/v1/service_provider/delete/${id}`;
  }
  //Service Provider Requests
  // Get all Service Providers request
  get allServiceProviderRequests(){
    return `api/v1/service-provider/requests`;
  }
  // Approve Service Provider request
   approveServiceProviderRequests(id){
    return `api/v1/service-provider/approve/${id}`;
  }
  // Reject Service Providers request
   rejectServiceProviderRequests(id){
    return `api/v1/service-provider/reject/${id}`;
  }
  //Users
  get allUsers() {
    return `api/v1/user/all`;
  }
  showUser(id) {
    return `api/v1/user/${id}`;
  }
  path(path) {
    return path;
  }
  //Service Providers Request
  get updateServiceProviderTable () {
    return `api/v1/service-provider/requests`;
  }
  //All residents
  get allResidents() {
    return `api/v1/user/all`;
  }
  //All visitors
  get allVisitors() {
    return `api/v1/visitors/`;
  }
  //scheduled visits
  scheduledVisits(id) {
    return `api/v1/ScheduledVisit/${id}`;
  }
  //scheduled visits
  finishedVisits(id) {
    return `api/v1/finishedVisit/${id}`;
  }
  visitorHistory(id){
    return `api/v1/history/visitor/${id}`;
  }
  banVisitor(id){
    return `api/v1/visitor/${id}/ban`;
  }
  // Estate Admin Routes 
  get estateGuards(){
    return `api/v1/estate/`
  }
}
