const rejectRequest    = document.querySelector('#rejectBtn');

const reject = (event, rejectRequest) => {

    rejectRequest.innerHTML = '<span class="spinner-border text-light spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span> Processing...';
    event.preventDefault();

    const Id  = rejectRequest.getAttribute('data-id'); 
    const url  = `${routes.api_origin}${routes.rejectServiceProviderRequests(Id)}`;

    fetch(url, {
        method: "POST",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization": token
        },
        body: ''
    })
    .then(response => response.json())
    
    .then(data => {
        rejectRequest.innerHTML = "Reject";
       getResponse(data);  
        console.log(data);
    })
    .catch(err => {
        Swal.fire({
            title: 'Unexpected Error',
            html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or contact website owner, Thank you!</p>`,
            confirmButtonText: 'Close'            
        })
        console.log(err);
    })

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
        switch(data.status) {
            case false:
                title = 'Operation Failed';
                result = 'Service Provider not found'
                flashAlert(title,result);
            break;
            case true:
                title  = 'Success';
                result = `<p style="color:green; font-size:20px;">Service request has already been rejected </p>`;
                flashAlert(title,result);
            break;
  
        }
     }
}

rejectRequest.addEventListener('click', (event) => reject(event, rejectRequest));
