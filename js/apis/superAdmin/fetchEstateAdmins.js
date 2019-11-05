// JS Fetch to get all admin users
const routes = new Routes();
const url = `${routes.api_origin}${routes.fetchAllEstateAdmin}`;


//Get Dom Elements 
const table = document.querySelector('#myTable');
const singlemodal = document.querySelector('#singleEstateModal');
const revokeButton = document.querySelector('#revoke');
const restoreButton = document.querySelector("#restore");
const profileImage = document.querySelector('#profileImage');




// Access the API using the authorization token and url
    fetch(url, {
        method: "GET",
        mode: "cors",
        headers: {
            "Accept": "aplication/json",
            "Authorization": token
        },
        
    })
    
   //\\ .then(response => errorHandling(response))
   
    .then(resp => resp.json())
    .then(data => {
        
        let admins = data.admins;
        console.log(admins);
        
        return admins.map((admin)=>{
            let {access, created_at, device_id, duty_time, email, home} = admin;
            console.log(home);
            let { estate} = home;
            console.log(estate);
            
            // Create Entries placeholders on table 
            let row = table.insertRow(),
                adminName = row.insertCell(),
                adminEstate = row.insertCell(),
                adminEmail = row.insertCell(),
                moreDetails = row.insertCell();
            
            //Insert Response into table
            adminName.innerHTML = `${admin.name}`;
            adminEstate.innerHTML = `${estate.estate_name}`;
            adminEmail.innerHTML = `${admin.email}`;
            
            
            const myImage = `https://res.cloudinary.com/getfiledata/image/upload/w_200,c_fill,ar_1:1,g_auto,r_max/`+`${admin.image}`;
            moreDetails.innerHTML = '<td><a href="img" data-toggle="modal" data-target="#singleEstateModal" class="green">View Details</a>';
            
            moreDetails.addEventListener('click',()=>{
                modalName.innerHTML = `${admin.name}`;
                modalEmail.innerHTML = `${admin.email}`;
                modalPhone.innerHTML = `${admin.phone}`;
                modalEstate.innerHTML = `${estate.estate_name}`;
                modalAddress.innerHTML = `${estate.city} , ${estate.country}`;
                
                
               
                profileImage.setAttribute("src", myImage);
                revokeButton.setAttribute('data-id', `${admin.id}`);
                restoreButton.setAttribute('data-id', `${admin.id}`);
        
             })
             
        })
        
      })

      

    


      