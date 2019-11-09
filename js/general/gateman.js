	
	filterList = () => {
        let searchInput, filter, tr, i, td, txtValue;
        
        searchInput = document.getElementById('myInput');
        filter = searchInput.value.toUpperCase();
        trs = document.querySelectorAll('.js--gatemanRow');
        trs.forEach(tr => tr.style.display = [...tr.children].find(td => td.innerHTML.toUpperCase().includes(filter)) ? '' : 'none');
    };
    
 const routes = new Routes();
 let allUsersUrl = `${routes.api_origin}${routes.allUsers}`;
 rowElement = document.getElementById('gatemanTable');
 let spinner = document.querySelector("[data-preloader]");

 spinner.style.display = "block";
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
    displayGatemen(data.gatemans);
     });
 
  html = `
              <tr class="js--gatemanRow">
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
     if(results){
      spinner.style.display = "none";
     }
 
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
   alert(`Are you sure you really want to edit this man with ID = ${editGatemanBtn.dataset.id}?`);

 });

 deleteGatemanBtn.addEventListener('click', (event)=> {
   alert(`Are you sure you really want to delete this man  with ID =  ${editGatemanBtn.dataset.id}?`);
 });

