const rout = new Routes();
const spForm = document.querySelector('#spForm');
const addUrl = `${rout.api_origin}${rout.serviceProviderSubmit}`;
console.log(addUrl);
const spSubmitApi = (event) => {  
    event.preventDefault();
    const name = document.querySelector('#fullname').value;
    console.log(name);
    const phone = document.querySelector('#phone').value;
    console.log(phone);
    const description = document.querySelector('#bizname').value;
    console.log(description);
    const estate_id = document.querySelector('#estate-dropdown').value;
    console.log(estate_id);
    const category_id = document.querySelector('#category-dropdown').value;
    console.log(category_id);
    const data = {
        name,
        phone,
        description,
        estate_id,
        category_id
    };
    console.log(data);
    
     // catch error status code
     const errorHandling = (response) => {
        status = response.status;
        console.log(status)
        return response.json();
    }
    const getResponse = (resp) => {
        let title;
        let result;
       const flashAlert = (title, result) => {
            Swal.fire({
                title: `${title}`,
                html: `<p style="color:tomato; font-size:17px;">${result}</p>`,
                confirmButtonText: 'Close'
            })
        }
        switch(resp.status) {
            case 404:
                title  = 'Registration Failed';
                result = 'Unable to register successfully';
                flashAlert(title,result);
            break;
            case true:
                title = 'Registered Successfully';
                result = `<p style="color:green; font-size:20px;">Service Provider Request Created Successfully!</p>`
                ;
                flashAlert(title, result);
            break;
        }
    }
    //fetch request
            fetch(addUrl, {
                method: "POST",
                mode: "cors",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
             })
            // .then(response => errorHandling(response))
            .then(response => errorHandling(response)) 
            .then(resp => {
                if(resp){  
                    console.log(resp);
                    getResponse(resp);  
                }
        })
        .catch(err => {
            Swal.fire({
                title: 'Unexpected Error',
                html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection, Thank you!</p>`,
                confirmButtonText: 'Close'
            })
            console.log(err);
        })
    }
spForm.addEventListener('submit', spSubmitApi);