const routes = new Routes();

const addEstateApi = (event, addEstateForm) => {
    event.preventDefault();
    const  submitBtn = event.target[5];
    console.log(submitBtn)
    const url = `${routes.api_origin}${routes.addEstate}`;

    if(permit == true) {//Condition that check if validation is true
          submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span> Processing...'
         //Convert form to formData
         const formData = new FormData(addEstateForm);

         //Catch error status code
         const errorHandling = (response) => {
            status = response.status;
            console.log(status)
            return response.json();
         }
         
        const getResponse = (data) => {
            let title;
            let result;
            
            const flashAlert = (title, result) => {
                 submitBtn.innerHTML = 'Submit';
                Swal.fire({
                    title: `${title}`,
                    html:  `<p style="color:tomato; font-size:17px;">${result}</p>`,
                    confirmButtonText: 'Close'
                })       
            }
            switch(status) {
                case 422:
                    title = 'Add Estate failed';
                    result = JSON.stringify(data.errors).split('"').join('').split('{').join('').split('}').join('');
                    flashAlert(title,result);
                break;
                case 404:
                    title  = 'Add Estate error';
                    result = 'Invalid credentials';
                    flashAlert(title,result);
                break;
                case 401:
                        title = 'Token Invalid';
                        result = 'Token is invalid or have expired';
                        flashAlert(title,result);
                        setTimeout(() => {
                            location.replace('../login.html');
                        }, 3000)
                    break;
                case 201:
                    Swal.fire({
                        title: `Successfull`,
                        html:  `<p style="color:#49a347; font-size:17px;">Estate added successfully</p>`,
                        confirmButtonText: 'Close'
                    }) 
                break;
                default:

            }
         }
         fetch(url, {
            method: "POST",
            mode: "cors",
            headers: {
                "Accept": "application/json",
                "Authorization": token
            },
            body: formData
         })
         .then(response => errorHandling(response))
         .then(data => {
             if(data) {
                 submitBtn.innerHTML = 'Submit';
                 console.log(data);
                 getResponse(data);
             }
         })
         .catch(err => {
             if(err) {
                 submitBtn.innerHTML = 'Submit';
                Swal.fire({
                    title: 'Unexpected Error',
                    html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or contact website owner, Thank you!</p>`,
                    confirmButtonText: 'Close'            
                })
             }
             console.error(err);
         })
    }

}

addEstateForm.addEventListener('submit', (event) => addEstateApi(event, addEstateForm))