// JS Fetch to get all admin users
const routes = new Routes();
const url = `${routes.api_origin}${routes.fetchAllEstateAdmin}`;

//Get Dom Elements 
const table = document.querySelector('[data-admin-view]');
const singlemodal = document.querySelector('#singleEstateModal');
const revokeButton = document.querySelector('#revoke');
const restoreButton = document.querySelector("#restore");
const resetButton = document.querySelector("#resetPassword");
const profileImage = document.querySelector('#profileImage');
const spinner = document.querySelector('[data-preloader]');




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
        table.innerHTML = "";
        spinner.style.display = 'none';
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
                adminAdded = row.insertCell(),
                moreDetails = row.insertCell();

            //Insert Response into table
            adminName.innerHTML = admin.name ? `${admin.name}` : '---  --- ---';
            adminEstate.innerHTML = `${estate.estate_name}`;
            adminEmail.innerHTML = `${admin.email}`;
            adminAdded.innerHTML = `${admin.created_at}`;
            
            
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
                resetButton.setAttribute('data-id', `${admin.id}`);
                let revokeId = revokeButton.getAttribute('data-id');
                console.log(revokeId)

                
                //revokeButton.addEventListener('click',revoke());
                
                
             })
             
             
        })
        
      }).catch(err => {
        if (err) {
            spinner.style.display = 'none';
            console.log(err);
            Swal.fire({
                title: 'Unexpected Error',
                html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or referesh to try again, Thank you!</p>`,
                confirmButtonText: 'Close'
            })
        }
      })

      

    


      