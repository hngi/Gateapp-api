const routes = new Routes();
const url = `${routes.api_origin}${routes.allEstates}`;

//Set dropdown option for service providers
  let dropdown = document.querySelector('#estate-dropdown');
  dropdown.length = 0;

  let defaultOption = document.createElement('option');
  defaultOption.text = 'Choose Estate';

  dropdown.add(defaultOption);
  dropdown.selectedIndex = 0;

  
//fetch request
const getEstates = () => {
    fetch(url, {
        method: "GET",
        mode: "cors",
        headers: {
            "Accept": "application/json"
        }
    })
        .then(resp => resp.json())
        .then(data => {
            let { estates } = data;
            console.log(estates);
            console.log(estates.length);
            populateEstate(estates);
        })
}  
// Examine the text in the response  
getEstates();
const populateEstate = (estates) =>{
    estates.map((est) => {
       
        let option;
        option = document.createElement('option');
        option.text = `${est.estate_name}, ${est.city}, ${est.country}`;
        option.value = `${est.id}`;
        dropdown.add(option);
        
    })
}
 