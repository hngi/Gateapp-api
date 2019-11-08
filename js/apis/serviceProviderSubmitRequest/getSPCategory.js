const route = new Routes();
const catUrl = `${route.api_origin}${route.serviceProviderCategory}`;

//Set dropdown option for service providers
  let drop = document.querySelector('#category-dropdown');
  drop.length = 0;

  let defaultOpt = document.createElement('option');
  defaultOpt.text = 'Service Type';

  drop.add(defaultOpt);
  drop.selectedIndex = 0;

  
//fetch request
const getCategory = () => {
    fetch(catUrl, {
        method: "GET",
        mode: "cors",
        headers: {
            "Accept": "application/json"
        }
    })
        .then(resp => resp.json())
        .then(resp => {
            let { data } = resp;
            console.log(data);
            console.log(data.length);
            populateCategory(data);
        })
}  
// Examine the text in the response  
getCategory();
const populateCategory = (data) =>{
    data.map((cat) => {
       
        let option;
        option = document.createElement('option');
        option.text = `${cat.title}`;
        option.value = `${cat.id}`;
        drop.add(option);
        
    })
}
 