const approveRequest   = document.querySelector('.btn-suspend');

const approve = (event, approveRequest) => {

    event.preventDefault();

    let id     = 5;
    const url  = `${api_origin}${approveServiceProvider+id}`;

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
        Swal.fire({
            title: 'Service Provider Request\'s Accepted',
            html:  `<p style="color:tomato; font-size:17px;">${data.message}</p>`,
            confirmButtonText: 'Close'
        })       
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
}

approveRequest.addEventListener('click', (event) => approve(event, approveRequest));
