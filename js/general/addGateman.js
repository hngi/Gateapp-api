const routes = new Routes();
let addGatemanUrl = `${routes.api_origin}api/v1/register/gateman`;
rowElement = document.getElementById('gatemanTable');
let spinner = document.querySelector("[data-preloader]");
const addGatemanBtn = document.querySelector('[data-add-gateman-btn]');
const nameInput = document.getElementById('gatemanInputName');
const phoneInput = document .getElementById('gatemanInputPhone');
const emailInput = document .getElementById('gatemanInputEmail');
const duty_time = document .getElementById('duty_time');

addGatemanBtn.addEventListener('click', (e) => {
   e.preventDefault();
//    console.log("You have clicked me!");
   let data = {
       name: nameInput.value,
       phone: phoneInput.value,
       email: emailInput.value,
       duty_time: duty_time.value,
       device_id: "thdkldkladhhl"
       
   }

   addGatemanBtn.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span> Processing...'

//    console.log(data.name);
//    console.log(phoneInput.value);
//    console.log(emailInput.value);
//    console.log(duty_time.value);

   fetch(addGatemanUrl, {
    method: 'POST', 
    mode: 'cors', 
    redirect: 'follow',
    headers: new Headers({
        "Accept": "application/json",
        "Content-Type": "application/json",
        "Authorization": token
    }),
    body: JSON.stringify(data)

    }).then( response => response.json())
    .then( data => { 
        console.log(data.status);
        if(data.status * 1  === 201 || data.status * 1 === 200 ){
            Swal.fire({
                title: "Status",
                html: `<p style="color:green; font-size:17px;">User Created Successfully</p>`,
                confirmButtonText: "Close"
              });
            //   setTimeout(() => { location.reload();; }, 5000);
        }  
       
    addGatemanBtn.innerHTML = 'Add Gateman';
            console.log(data);
        }).catch(error=> {
         Swal.fire({
            title: "Unexpected Error",
            html: `<p style="color:tomato; font-size:17px;">${error}</p>`,
            confirmButtonText: "Close"
          });
      });


})
