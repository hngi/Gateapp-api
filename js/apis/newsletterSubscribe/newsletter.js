
const routes = new Routes();
const url = `${routes.api_origin}${routes.newsletter}`;

//Get input field values
const subscribe = (e) => {
    e.preventDefault();
    const name = document.querySelector('#name').value;
    const email = document.querySelector('#email').value;

    const data = {
            name,
            email
        };
        console.log(data);

    //fetch(request)
    fetch(url, {
        method: 'POST',
        mode: 'cors',
        headers: {
            'Content-Type': 'application/json'     
        },
        body: JSON.stringify(data)
    })
        .then(resp => resp.json()) 
        .then(resp => {
            Swal.fire({
                title: 'Subscribed Successfully',
                html:  `<p style="color:tomato; font-size:17px;">${resp.message} Check your email.</p>`,
                confirmButtonText: 'Close'
            })       
            console.log(resp);
        })
        .catch(err => {
            Swal.fire({
                title: 'An Error Occured',
                html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection, Thank you!</p>`,
                confirmButtonText: 'Close'
            })
            console.log(err);
        })

};

const submit = document.querySelector('#form-submit').addEventListener('submit', subscribe);


console.log(url);


