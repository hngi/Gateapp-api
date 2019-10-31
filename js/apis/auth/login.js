const loginApi = (event, loginForm) => {
    event.preventDefault();
    const sunmitBtn = event.target[2];
    const url = `${api_origin}${signin}`;

    if(permit == true) {//Condition that check if validation is true
         sunmitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span>'
         //Convert form to formData
         const formData = new FormData(loginForm);
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
                Swal.fire({
                    title: `${title}`,
                    html:  `<p style="color:tomato; font-size:17px;">${result}</p>`,
                    confirmButtonText: 'Close'
                })       
            }
            if(status == 422) {
                title = 'Login failed';
                result = JSON.stringify(data.errors).split('"').join('').split('{').join('').split('}').join('');
                flashAlert(title,result);
            }
            if(status == 404) {
                title  = 'Route not found';
                result = 'This route does not exist';
                flashAlert(title,result);
            }
            if(status == 500) {
                title  = 'Unexpected Error';
                result = 'An error occured due to broken, please try again or contact website owner!';
                flashAlert(title,result);
            }
            if(status == 501) {
                title  = 'Process not implemented';
                result = 'proceess was not implement, this could be to unavailable network coverage, please try again or contact support!!';
                flashAlert(title,result);
            }
            if(status == 200) {
                //insert the data into broswer localStorage
                localStorage.setItem('gateguard-admin', JSON.stringify(data));
                location.replace('estates-tab.html');
            }
         }
         fetch(url, {
            method: "POST",
            mode: "cors",
            headers: {
                "Accept": "aplication/json"
            },
            body: formData
         })
         .then(response => errorHandling(response))
         .then(data => {
             if(data) {
                 console.log(data);
                 getResponse(data);
             }
         })
         .catch(err => {
             if(err) {
                sunmitBtn.innerHTML = 'Login';
                Swal.fire({
                    title: 'An Unexpected error occured',
                    html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or contact website owner, Thank you!</p>`,
                    confirmButtonText: 'Close'            
                })
             }
             console.error(err);
         })
    }

}

loginForm.addEventListener('submit', (event) => loginApi(event, loginForm))