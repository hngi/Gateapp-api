	
	filterList = () => {
        let searchInput, filter, tr, i, td, txtValue;
        
        searchInput = document.getElementById('myInput');
        filter = searchInput.value.toUpperCase();
        trs = document.querySelectorAll('.js--gatemanRow');
        trs.forEach(tr => tr.style.display = [...tr.children].find(td => td.innerHTML.toUpperCase().includes(filter)) ? '' : 'none');
    };
    

 let endpoint = `${api_origin}${allUsers}`;
 rowElement = document.getElementById('gatemanTable');

 fetch(endpoint, {
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
                 <a href="#" data-id="%ID%" data-toggle="modal" data-target="#singleEstateModal" class='btn btn-default btn-xs' title="View Details"><i class="fa fa-eye"></i></a>
                 <a href="#" data-id="%ID%" class='btn btn-default btn-xs' title="Edit"><i class="fa fa-edit"></i></a>                 
                 <a href="#" data-id="%ID%" class='btn btn-default btn-xs' title="Delete"><i class="fa fa-trash"></i></a>
                 </td>
             </tr>
     ` ; 
 
     

 const displayGatemen = (results) => {
     let count = 0;
     
 
     results.forEach(el => {
    
    // console.log(el);
      count += 1;
     //Replace the placeholder text with some actual data
     newHtml = html.replace('%SN%', count);
     newHtml = newHtml.replace('%NAME%', el.name);
     if(el.home != null) {
        newHtml = newHtml.replace('%ESTATE%', el.home.estate.estate_name);
     } else {
        newHtml = newHtml.replace('%ESTATE%', '-');
     }
     if(el.email != null) {
        newHtml = newHtml.replace('%EMAIL%', el.email);
     }else {
        newHtml = newHtml.replace('%EMAIL%', '-');
     }
     newHtml = newHtml.replace('%PHONE%', el.phone);
     newHtml = newHtml.replace(/%ID%/g, el.id);

     //Insert the HTML into the DOM
     rowElement.insertAdjacentHTML('beforeend', newHtml);
     });

 }