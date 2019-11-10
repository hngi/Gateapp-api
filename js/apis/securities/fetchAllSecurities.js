 const routes = new Routes();
 let allUsersUrl = `${routes.api_origin}${routes.allUsers}`;
 rowElement = document.getElementById('gatemanTable');
 let spinner = document.querySelector("[data-preloader]");

 
 fetch(allUsersUrl, {
 method: 'GET', 
 mode: 'cors', 
 redirect: 'follow',
 headers: new Headers({
     "Accept": "application/json",
     "Content-Type": "application/json",
     "Authorization": token
 })
 }).then( response => response.json())
 .then( data => {   
    if(data){
      spinner.style.display = "none";
    }  
    displayGatemen(data.gatemans);
     }).catch(error=> {
      Swal.fire({
         title: "Unexpected Error",
         html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or referesh to try again, Thank you!</p>`,
         confirmButtonText: "Close"
       });
   });
 
  html = `
              <tr class="js--gatemanRow search-row" style="font-weight:bold;">
                 <td>%SN%</td>
                 <td>%NAME%</td>
                 <td>%ESTATE%</td>
                 <td>%EMAIL%</td>
                 <td>%PHONE%</td>
                 <td>
                 <a href="#"
                 data-id='%ID%'
                 data-name='%NAME%'
                 data-estate='%ESTATE%'
                 data-email='%EMAIL%'
                 data-phone='%PHONE%'
                 data-date='%DATE%'
                 class="displayGateman green"
                 data-toggle="modal"  
                 data-target="#gatemanModal">View Details</a>
                 </td>
             </tr>
     ` ; 
 

 const displayGatemen = (results) => {
     let count = 0;
    
 
     results.forEach(el => {
    
   //  console.log(el);
      count += 1;
     //Replace the placeholder text with some actual data
     newHtml = html.replace('%SN%', count);
     newHtml = newHtml.replace(/%NAME%/g, el.name);
     if(el.home != null) {
        newHtml = newHtml.replace(/%ESTATE%/g, el.home.estate.estate_name);
     } else {
        newHtml = newHtml.replace(/%ESTATE%/g, '-');
     }
     if(el.email != null) {
        newHtml = newHtml.replace(/%EMAIL%/g, el.email);
     }else {
        newHtml = newHtml.replace(/%EMAIL%/g, '-');
     }
     newHtml = newHtml.replace(/%PHONE%/g, el.phone);
     newHtml = newHtml.replace(/%ID%/g, el.id);
     
     newHtml = newHtml.replace('%DATE%', el.created_at);

     //Insert the HTML into the DOM
     rowElement.insertAdjacentHTML('beforeend', newHtml);
     });
 }


 const editGatemanBtn = document.getElementById("editGateman");
 const deleteGatemanBtn = document.getElementById("deleteGateman");


 editGatemanBtn.addEventListener('click', (event)=> {
   let gatemanID = editGatemanBtn.dataset.id;
   let gatemanName = document.getElementById('dataName').textContent;
   let gatemanPhone = document.getElementById('dataPhone').textContent;
   let gatemanEmail = document.getElementById('dataEmail').textContent;

   // console.log(gatemanName);
   // console.log(gatemanPhone);
   // console.log(gatemanID);
   
   let editUserUrl = `${routes.api_origin}api/v1/user/edit/${editGatemanBtn.dataset.id}`;
   window.location = "/super-admin/edit-gateman.html"; 
      

 });

 deleteGatemanBtn.addEventListener('click', (event)=> {
   let deleteUserUrl = `${routes.api_origin}api/v1/user/delete/${editGatemanBtn.dataset.id}`;
   fetch(deleteUserUrl, {
      method: 'DELETE', 
      mode: 'cors', 
      redirect: 'follow',
      headers: new Headers({
          "Accept": "application/json",
          "Content-Type": "application/json",
          "Authorization": token
      })
      }).then( response => response.json())
      .then( data => {     
         Swal.fire({
            title: "Message",
            html: `<p style="color:tomato; font-size:17px;"> ${data.message} </p>`,
            confirmButtonText: "Close"
          });
          setTimeout(() => { location.reload();; }, 3000);
        
          });
 });

