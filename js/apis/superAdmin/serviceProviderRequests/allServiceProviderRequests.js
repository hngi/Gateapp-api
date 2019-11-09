const routes = new Routes();
const spUrl = `${routes.api_origin}${routes.allServiceProviderRequests}`;

const table = document.querySelector('[data-serviceProvider-view]');
const singlemodal = document.querySelector('#singleProviderModal');
const approveButton = document.querySelector('#approveBtn');
const rejectButton = document.querySelector('#rejectBtn');

// Get Response From api 
const fetchServiceProviderRequests = () => {
    
    fetch(spUrl, {
        method: "GET",
        mode: "cors",
        headers: {
            "Accept": "aplication/json",
            "Authorization": token
        },

    })
        .then(resp => resp.json())
        .then(data => {
            let {requests}  = data;
            let [services] = requests;
            table.innerHTML = "";
            console.log(requests);
            console.log(services);
            console.log(requests.length);
           updateServiceProviderTable(services);
          
        })

}
fetchServiceProviderRequests();

const updateServiceProviderTable =  (services) => {

    
    services.map((spRequest) => {
       
        let {estate, category} = spRequest;
        let {estate_name, address, city, country} = estate;
        let {title} = category;
        let row = table.insertRow(),
        spName = row.insertCell(),
        spServiceType = row.insertCell(),
        spLocation = row.insertCell(),
        moreDetails = row.insertCell();

        spName.innerHTML = `${spRequest.name}`;
        spServiceType.innerHTML = `${category.title}`;
        spLocation.innerHTML =`${estate.estate_name}, ${estate.city}, ${estate.country} `;
        moreDetails.innerHTML = '<a href="" data-toggle="modal" data-target="#singleProviderModal">View Details</a>'

        moreDetails.addEventListener('click',()=>{
            modalName.innerHTML = `${spRequest.name}`;
            modalPhone.innerHTML = `${spRequest.phone}`;
            modalEstate.innerHTML = `${estate.estate_name}`;
            modalDate.innerHTML = `${spRequest.created_at}`;
            modalCategory.innerHTML = `${category.title}`;
            
            
            approveButton.setAttribute('data-id', `${spRequest.id}`);
            rejectButton.setAttribute('data-id', `${spRequest.id}`);
            console.log(approveButton);

            
         })


        
    })

} 

