// This script revokes admin access 

function revoke(event, revokeButton) { 

    event.preventDefault(); 
    revokeButton.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span> Processing...'
    let revokeId = revokeButton.getAttribute('data-id');  
    const revokeUrl = `${routes.api_origin}${routes.revokeEstateAdminAccess(revokeId)}`;
    
    fetch(revokeUrl,{
       
      method: 'PUT',
      mode: "cors",
        headers: {
            "Accept": "aplication/json",
            "Authorization": token
        }
      
     // body: JSON.stringify({data})
    }).then((response) => {
      response.json().then((response) => {
        revokeButton.innerHTML = "Revoke Access"
        getRevokeResponse(response);
        console.log(response);
      })
    }).catch(err => {
      console.error(err)
    })
    const getRevokeResponse = (data) => {
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
              result = 'Admin access has already been revoked or admin user was not found'
              flashAlert(title,result);
          break;
          case 402:
              title = 'Operation Failed';
              result = 'This is not an admin user'
              flashAlert(title,result);
          break;
          case 200:
              title  = 'Access Revoked';
              result = `<p style="color:green; font-size:20px;">Admin access has been revoked Successfully</p>`;
              flashAlert(title,result);
          break;

      }
   }
}
revokeButton.addEventListener('click', (event) => revoke(event, revokeButton));

