	
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
     // console.log(data.gatemans);
     });
 
  html = `
              <tr class="js--gatemanRow">
                 <td>%SN%</td>
                 <td>%NAME%</td>
                 <td>%ESTATE%</td>
                 <td>%EMAIL%</td>
                 <td>%PHONE%</td>
                 <td><a href="#" data-toggle="modal" data-target="#singleEstateModal" class="green">View Details</a>
                 </td>
             </tr>
     ` ; 
 
     

 const displayGatemen = (results) => {
     let count = 0;
 
     results.forEach(el => {
  //   console.log(el);
      count += 1;
     //Replace the placeholder text with some actual data
     newHtml = html.replace('%SN%', count);
     newHtml = newHtml.replace('%NAME%', el.name);
     newHtml = newHtml.replace('%ESTATE%', 'Estate Here');
     newHtml = newHtml.replace('%EMAIL%', el.email);
     newHtml = newHtml.replace('%PHONE%', el.phone);

     //Insert the HTML into the DOM
     rowElement.insertAdjacentHTML('beforeend', newHtml);
     });

 }