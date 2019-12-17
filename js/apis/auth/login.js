const routes = new Routes();

sessionStorage.removeItem('estateId');

const loginApi = (event, loginForm) => {
    event.preventDefault();
    const submitBtn = event.target[2];
    const url = `${ routes.api_origin }${ routes.signin }`;
    console.log(url);

    if(permit == true) {//Condition that check if validation is true
         submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span>'
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
                submitBtn.innerHTML = 'Login';
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
                if(data.user.user_type === 'super_admin'){
                    location.replace('super-admin/dashboard.html');
                }else {
                    location.replace('estate-admin/estate_guards_dash.html');
                    sessionStorage.setItem('estateId', JSON.stringify(data));
                }

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
                submitBtn.innerHTML = 'Login';
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