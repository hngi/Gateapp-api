// This script revokes admin access 




let revokeId = revokeButton.getAttribute('data-id');
const apiUrl = `${api_origin}${revokeEstateAdminAccess}`;
function revoke(id) {
    
    fetch(apiUrl + "/"+ id ,{
       
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

revokeButton.addEventListener('click',revoke(revokeId));