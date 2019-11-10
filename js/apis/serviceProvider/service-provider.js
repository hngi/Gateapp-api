// JS Fetch to get all service providers
const routes = new Routes();
const url = `${routes.api_origin}${routes.allServiceProvider}`;

// Get Dom Elements 
const table = document.querySelector('#sp-tab');
const spinner = document.querySelector('[data-serviceProvider-view]');
const suspend = document.querySelector('#suspend');
const remove = document.querySelector("#remove");
const singlemodal = document.querySelector('#singleProviderModal');

// Begin the fun stuff
fetch(url, {
        method: 'GET',
        mode: 'cors',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'aplication/json',
            'Authorization': token
        }})
  .then(response => {
    return response.json()
  })
  .then(data => {
    // Lets do somethings with our json data
    console.log(data);
   data.data.forEach(sp => {
            // This section was borrowed from junicode fetch all estate admin js file but i fixed some bugs junicode did not fix
            // Create Entries placeholders on table 
            let row = table.insertRow(),
                spName = row.insertCell(),
                spEstate = row.insertCell(),
                spPhone = row.insertCell(),
                spDetails = row.insertCell(),
                moreDetails = row.insertCell();
                spinner.innerHTML = "";
           
            //Insert Response into table
            spName.innerHTML = `${sp.name}`;
            spEstate.innerHTML = `${sp.estate}`;
            spPhone.innerHTML = `${sp.phone}`;
            spDetails.innerHTML = `${sp.description}`;
            moreDetails.innerHTML = '<td><a href="img" data-toggle="modal" data-target="#singleProviderModal" class="green">View Details</a>';
           
            moreDetails.addEventListener('click', (event) => {
                modalName.innerHTML = `${sp.name}`;
                modalPhone.innerHTML = `${sp.phone}`;
                modalEstate.innerHTML = `${sp.description}`;
                modalCat.innerHTML = `${sp.categroy}`;
                modalDesc.innerHTML = `${sp.description}`;
                
                remove.setAttribute('data-id', `${sp.id}`);
                suspend.setAttribute('data-id', `${sp.id}`);
        
       })  
    })
  })
  .catch(err => {
    console.log("An Error Occured: "+err);
  })
  
