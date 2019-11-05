// This script revokes admin access 
const routes = new Routes();
let revokeId = revokeButton.getAttribute('data-id');
const apiUrl = `${ routes.api_origin}${ routes.revokeEstateAdminAccess(revokeId)}`;
function revoke() {
    
    fetch(apiUrl,{
       
      method: 'PUT',
      mode: "cors",
        headers: {
            "Accept": "aplication/json",
            "Authorization": token
        }
      
     // body: JSON.stringify({data})
    }).then((response) => {
      response.json().then((response) => {
        console.log(response);
      })
    }).catch(err => {
      console.error(err)
    })
}

revokeButton.addEventListener('click',revoke());