const suspendButton   = document.querySelector('#suspend');

const suspendEvent = (event, suspendButton) => {

    event.preventDefault();
    suspendButton.innerHTML = '<span class="spinner-border text-light spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span> Processing...';
    const Id  = suspendButton.getAttribute('data-id'); 
    const url  = `${routes.api_origin}${routes.suspendServiceProvider(Id)}`;
    console.log(Id)
    console.log(url)
    fetch(url, {
        method: "DELETE",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization": token
        },
        body: ''
    })
    .then(response => response.json())
    .then(data => {
        suspendButton.innerHTML = "Suspend";
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
            case 501:
                title = 'Operation Failed';
                result = 'Unable To Suspend Service Provider!'
                flashAlert(title,result);
            break;
            case 200:
                title  = 'Success';
                result = `<p style="color:green; font-size:20px;">Service Provider Was Successfully Suspended!</p>`;
                flashAlert(title,result);
            break;
  
        }
     }
}

suspendButton.addEventListener('click', (event) => suspendEvent(event, suspendButton));
