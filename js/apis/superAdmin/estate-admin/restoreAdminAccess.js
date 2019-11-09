// This script revokes admin access 

const restore = (event, restoreButton) => {

    event.preventDefault();
    restoreButton.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span> Processing...'
    let restoreId = restoreButton.getAttribute('data-id');  
    const restoreUrl = `${routes.api_origin}${routes.restoreEstateAdminAccess(restoreId)}`;
    
    fetch(restoreUrl,{
       
      method: 'PUT',
      mode: "cors",
        headers: {
            "Accept": "aplication/json",
            "Authorization": token
        }

      
     // body: JSON.stringify({data})
    }).then((response) => {
      response.json().then((response) => {
        restoreButton.innerHTML ="Restore Access"
        getResponse(response);
        console.log(response);
      })
    }).catch(err => {
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
              result = 'Admin user already has full access or Admin user not found'
              flashAlert(title,result);
          break;
          case 402:
              title = 'Operation Failed';
              result = 'This is not an admin user'
              flashAlert(title,result);
          break;
          case 200:
              title  = 'Access Restored';
              result = `<p style="color:green; font-size:20px;">Admin access has been restored Successfully</p>`;
              flashAlert(title,result);
          break;

      }
   }

  
}

restoreButton.addEventListener('click', (event) => restore(event, restoreButton));

