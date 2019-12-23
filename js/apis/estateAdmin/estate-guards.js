const routes = new Routes();
//route

let estate_guard = JSON.parse(sessionStorage.getItem('estateGuard'));
// console.log(estate_guard);
let estate_id = estate_guard.home.estate_id;

const url = `${routes.api_origin}${routes.estateGuards}${estate_id}/gateman`;


const Table = document.getElementById("gatemenTable");

// const url = `http://52.40.191.249/api/v1/estate/${estate_id}/gateman`;
const estateUrl = `${routes.api_origin}${routes.estateGuards}${estate_id}`;

//fetch Estate name
const fetchEstate = async ()=>{
  try {
    let response = await fetch(estateUrl, {
      headers: {
        Accept: "applicaion/json",
        "Content-Type": "application/json",
        Authorization: token
      }
    });
    let data = await response.json();
    // console.log(data)
    const {estate} = data;
    let estateName = estate.estate_name;
    // console.log(estateName)

    document.querySelectorAll('.estate_name').forEach(key=>{
      key.innerHTML = estateName;
    });
  } catch (err){
    console.log(err);
  }
}

fetchEstate();

//Fetch data
const fetchData = async () => {
    // spinner.style.display = "block";
    try {
      let response = await fetch(url, {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          Authorization: token
        }
      });
      let data = await response.json();
      const { gatemen } = data;
      let count = 0;

      gatemen.map(gatemen => {
        const {
          name,
          phone,
          image
        } = gatemen;
        count++;
        
        responseData.push({
          count,
          name,
          phone,
          image
        });
        
      });
         
      const pagination = new Pagination;
      
          
    } catch (err) {
      Swal.fire({
        title: "Unexpected Error",
        html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or referesh to try again, Thank you!</p>`,
        confirmButtonText: "Close"
      });
    };
  };
  //call fetch
  fetchData();