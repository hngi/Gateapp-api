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
                sunmitBtn.innerHTML = 'Login';
                Swal.fire({
                    title: `${title}`,
                    html:  `<p style="color:tomato; font-size:17px;">${result}</p>`,
                    confirmButtonText: 'Close'
                })       
            }
            switch(status) {
                case 422:
                    title = 'Login failed';
                    result = JSON.stringify(data.errors).split('"').join('').split('{').join('').split('}').join('');
                    flashAlert(title,result);
                break;
                case 404:
                    title  = 'Login error';
                    result = 'Invalid credentials';
                    flashAlert(title,result);
                break;
                default:
                 //insert the data into broswer localStorage
                localStorage.setItem('gateguard-admin', JSON.stringify(data));
                location.replace('default-tab.html');
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
                    title: 'Unexpected Error',
                    html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or contact website owner, Thank you!</p>`,
                    confirmButtonText: 'Close'            
                })
             }
             console.error(err);
         })
    }

}

loginForm.addEventListener('submit', (event) => loginApi(event, loginForm))