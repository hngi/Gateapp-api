const routes = new Routes();

const fetchEstates = () => {
    
    const url = `${routes.api_origin}`+'/api/v1/estates';
    fetch(url, {
        method: "GET",
        mode: "cors",
        headers: {
            "Accept": "aplication/json",
            "Authorization": token
        },

    })
        .then(resp => resp.json())
        .then(data => {
            let { estates } = data;
            console.log(estates);
            console.log(estates.length);
            populateEstate(estates);
        })

}  
fetchEstates();

const populateEstate = (estates) =>{
    estates.map((est) => {
       console.log(est)
        let option;
        option = document.createElement('option');
        option.text = `${est.estate_name}, ${est.city}, ${est.country}`;
        option.value = `${est.id}`;
        selectEstate.add(option);
       
        
        
    })

}

const addAdminApi = (event, addAdminForm) => {
    addAdminButton.innerHTML = 'Add Admin'
    const formData = new FormData(addAdminForm);    
    event.preventDefault();
    const  addButton = event.target[3];
    console.log(addButton)
    const addUrl = `${routes.api_origin}${routes.addAdmin}`;

    if(permit == true){
        
      addAdminButton.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span> Processing...'
       console.log(formData.entries())
        
            fetch(addUrl, {
                method: "POST",
                mode: "cors",
                headers: {
                    "Accept": "application/json",
                    "Authorization": token
                },
                body: formData
                
             })
            // .then(response => errorHandling(response))
             .then(data => {
                 if(data) {
                    // submitBtn.innerHTML = 'Submit';
                     console.log(data);
                    getResponse(data);
                    formData.append
                     console.log(formData.entries())
                 }
             })

    }
   

         const getResponse = (data) => {
            let title;
            let result;
            
            const flashAlert = (title, result) => {
                addAdminButton.innerHTML = "Add Admin";
                Swal.fire({
                    title: `${title}`,
                    html:  `<p style="color:tomato; font-size:17px;">${result}</p>`,
                    confirmButtonText: 'Close'
                })       
            }
            switch(data.status) {
                case 422:
                        title = 'Add Estate Admin failed';
                        result = 'An Estate Admin with that email already exists'
                        flashAlert(title,result);
                    break;
                case 404:
                    title = 'Add estate admin error';
                    result = 'Unable to add Admin user'
                    flashAlert(title,result);
                break;
                case 401:
                    title = 'Unauthorized access';
                    result = 'Unable to add Admin user'
                    flashAlert(title,result);
                break;
                case 200:
                    title = 'Estate Admin Added';
                    result = `<p style="color:green; font-size:20px;">The estate admin has been added and a password has been sent to the mail used for registration</p>`
                    flashAlert(title,result);
                break;
      
            }
         }

    

}
addAdminForm.addEventListener('submit', (event) => addAdminApi(event, addAdminForm))

   
 
