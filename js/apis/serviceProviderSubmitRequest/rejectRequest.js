const rejectRequest    = document.querySelector('.btn-remove');

const reject = (event, rejectRequest) => {

    event.preventDefault();

    let id     = 5;
    const url  = `${api_origin}${rejectServiceProvider+id}`;

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
            title: 'Service Provider Request\'s Rejected',
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

rejectRequest.addEventListener('click', (event) => reject(event, rejectRequest));
