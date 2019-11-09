const removeButton   = document.querySelector('#remove');

const remove = (event, removeButton) => {

    event.preventDefault();
    removeButton.innerHTML = '<span class="spinner-border text-light spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span> Processing...';
    const Id  = suspendButton.getAttribute('data-id'); 
    const url  = `${routes.api_origin}${routes.removeServiceProvider(Id)}`;
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
        removeButton.innerHTML = "Remove";
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
            case 404:
                title = 'Operation Failed';
                result = 'Unable To Delete Service Provider!'
                flashAlert(title,result);
            break;
            case 200:
                title  = 'Success';
                result = `<p style="color:green; font-size:20px;">Service Provider Was Successfully Deleted!</p>`;
                flashAlert(title,result);
            break;
  
        }
     }
}

removeButton.addEventListener('click', (event) => remove(event, removeButton));
