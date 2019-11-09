const approveRequest   = document.querySelector('#approveBtn');

const approve = (event, approveRequest) => {

    event.preventDefault();
    approveRequest.innerHTML = '<span class="spinner-border text-light spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span> Processing...';
    const Id  = approveRequest.getAttribute('data-id'); 
    const url  = `${routes.api_origin}${routes.approveServiceProviderRequests(Id)}`;
    console.log(Id)
    console.log(url)
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
        approveRequest.innerHTML = "Approve";
        getResponse(data);      
        console.log(data);
    })
    .catch(err => {
        if(err) {
            Swal.fire({
                title: 'Unexpected Error',
                html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or contact website owner, Thank you!</p>`,
                confirmButtonText: 'Close'            
            })
        }
      console.error(err)
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
                result = 'Service Provider request not found- you jyst approved this request'
                flashAlert(title,result);
            break;
            case true:
                title  = 'Success';
                result = `<p style="color:green; font-size:20px;">Service Provider has been added!</p>`;
                flashAlert(title,result);
            break;
  
        }
     }
}

approveRequest.addEventListener('click', (event) => approve(event, approveRequest));