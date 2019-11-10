const routes = new Routes();
//route
const allEstates = [];
const url = `${routes.api_origin}${routes.fetchEstates}`;

let estateDiv = document.querySelector('[data-fetch-estates]');
let spinner = document.querySelector('[data-preloader]');

const fetchEstates = () => {
    spinner.style.display = 'block';
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
                html: `<p style="color:tomato; font-size:17px;">${result}</p>`,
                confirmButtonText: 'Close'
            })
        }
        switch (status) {
            case 422:
                title = 'Login failed';
                result = JSON.stringify(data.errors).split('"').join('').split('{').join('').split('}').join('');
                flashAlert(title, result);
                break;
            case 401:
                title = 'Token Invalid';
                result = 'Token is invalid or have expired';
                flashAlert(title, result);
                setTimeout(() => {
                    location.replace('../login.html');
                }, 3000)
                break;
            case 404:
                title = 'Login error';
                result = 'Invalid credentials';
                flashAlert(title, result);
                break;
            default:
                
        }
    }
    fetch(url, {
        method: "GET",
        mode: "cors",
        headers: {
            "Accept": "application/json",
            "Authorization": token
        },
    })
        .then(response => errorHandling(response))
        .then(data => {
            if (data) {
                getResponse(data);
                allEstates.push(data.estates);
                viewEstate();
            }
        })
        .catch(err => {
            if (err) {
                Swal.fire({
                    title: 'Unexpected Error',
                    html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or referesh to try again, Thank you!</p>`,
                    confirmButtonText: 'Close'
                })
            }
            console.error(err);
        })
}


const viewEstate = () => {
    if (allEstates) {
        spinner.style.display = 'none';
        allEstates[0].map(allEstate => {
            const { estate_name, address, city, country, created_at, image, id } = allEstate;
            estateDiv.innerHTML += `
            <tr>
                <td>${estate_name}</td>
                <td>${address}, ${city}, ${country}</td>
                <td>${created_at}</td>
                <td><a 
                 data-estate-id='${id}'
                 data-estate-name='${estate_name}'
                 data-estate-img='${image}'
                 data-estate-location='${address}, ${city}, ${country}'
                 data-estate-created='${ created_at}'
                 class="displayEstate green"
                 data-toggle="modal"  
                 data-target="#singleEstateModal">Estate Details</a>
                </td>
            </tr>
        `;
        })
        //Picking individual estate deatils using data atrribute
        //This api has a conection to the script manipulation/displayEstateInfoToModal.js
        //The onclick event from the Estate Details is tranfer to the MODAL for view and other api is called
        const viewEstateBtns = Array.from(document.querySelectorAll('.displayEstate'));
        viewEstateBtns.map(viewEstateBtn =>
            viewEstateBtn.addEventListener('click', (event) => displayEstateInfoToModal(event, viewEstateBtn))
        )
    }
}
fetchEstates();