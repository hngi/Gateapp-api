// This script revokes admin access 

const resetPassword =(event, resetButton) =>{
  
  event.preventDefault();
  resetButton.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span> Processing...'
    let resetId = resetButton.getAttribute('data-id');  
    const resetUrl = `${routes.api_origin}${routes.resetEstateAdminPassword(resetId)}`;
    
    fetch(resetUrl,{
       
      method: 'POST',
      mode: "cors",
        headers: {
            "Accept": "aplication/json",
            "Authorization": token
        }

    }).then((response) => {
      resetButton.innerHTML = "Reset Password";
      response.json().then((response) => {
        
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
              result = 'Admin user not found'
              flashAlert(title,result);
          break;
          case 200:
              title  = 'Password Reset Successful';
              result = `<p style="color:green; font-size:20px;">Password reset successful! A mail with the new password has been sent to the Estate admin</p>`;
              flashAlert(title,result);
          break;

      }
   }

  
}
resetButton.addEventListener('click', (event) => resetPassword(event, resetButton));

