const routes = new Routes();
const spUrl = `${routes.api_origin}${routes.allServiceProviderRequests}`;

const table = document.querySelector('[data-serviceProvider-view]');
const singlemodal = document.querySelector('#singleProviderModal');
const approveButton = document.querySelector('#approveBtn');
const rejectButton = document.querySelector('#rejectBtn');
const spinner = document.querySelector('[data-preloader]');

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
            spinner.style.display = 'none';
            let {requests}  = data;
            let [services] = requests;
            table.innerHTML = "";
            console.log(requests);
            console.log(services);
            console.log(requests.length);
           updateServiceProviderTable(services);
          
        })
        .catch(err=> {
            if (err) {
                spinner.style.display = 'none';
                console.log(err);
                Swal.fire({
                    title: 'Unexpected Error',
                    html: `<p style="color:tomato; font-size:17px;">It is not you, it us, please refresh again, Thank you!</p>`,
                    confirmButtonText: 'Close'
                })
            }
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
        moreDetails.innerHTML = '<a class="green" href="" data-toggle="modal" data-target="#singleProviderModal">View Details</a>'

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

