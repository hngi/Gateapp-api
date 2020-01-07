const routes = new Routes();
let residentsData = [];
let visitorsData = [];
let guardsData = [];
let totalVisits = 0;

let estate_guard = JSON.parse(sessionStorage.getItem("estateGuard"));
console.log(estate_guard);
let estate_id = estate_guard.home.estate_id;

const residentsUrl = `${routes.api_origin}${routes.estateGuards}${estate_id}/residents`;
const visitorsUrl = `${routes.api_origin}${routes.allVisitors}${estate_id}`;
const guardsUrl = `${routes.api_origin}${routes.estateGuards}${estate_id}/gateman`;
const servicesUrl = 'https://api.gateguard.co/api/v1/statistics/estateService/';


const estateUrl = `${routes.api_origin}${routes.estateGuards}${estate_id}`;

//fetch Estate name
const fetchEstate = async () => {
  try {
    let response = await fetch(estateUrl, {
      headers: {
        Accept: "applicaion/json",
        "Content-Type": "application/json",
        Authorization: token
      }
    });
    let data = await response.json();
    console.log(data)
    const { estate } = data;
    let estateName = estate.estate_name;
    // console.log(estateName)

    document.querySelectorAll(".estate_name").forEach(key => {
      key.innerHTML = estateName;
    });
  } catch (err) {
    console.log(err);
  }
};

fetchEstate();

//Fetch Residents data
const fetchResidentsData = async () => {
  // spinner.style.display = "block";
  try {
    let response = await fetch(residentsUrl, {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: token
      }
    });
    let data = await response.json();
    const { residents } = data;
    console.log(residents)
    document.getElementById('totalResidents').innerHTML = residents.length;
    let count = 0;

    residents.map(resident => {
      const { name, phone, image, access } = resident[0];
      count++;
// console.log(name)
      residentsData.push({
        count,
        name,
        phone,
        image,
        access
      });
      
    });
console.log(residentsData, 'residents');
} catch (err) {
  Swal.fire({
    title: "Unexpected Error",
    html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or refresh to try again. Thank you!</p>`,
    confirmButtonText: "Close"
  });
}
};
//call fetch
fetchResidentsData();

//Fetch visitors data
const fetchVisitorsData = async () => {
  // spinner.style.display = "block";
  try {
    let response = await fetch(visitorsUrl, {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: token
      }
    });
    let data = await response.json();
    const { visitors } = data;
    // console.log(visitors)
    let count = 0;
    visitors.map(visitor => {
      const {
        name,
        phone_no,
        image,
        visit_count
      } = visitor;
      count++;
      
      visitorsData.push({
        count,
        name,
        phone_no,
        image,
        visit_count
      });
    });
    visitorsData.forEach(element => {
      totalVisits += element.visit_count;
    });
    document.getElementById('totalVisits').innerHTML = totalVisits;
    console.log(visitorsData, 'visitors')
  } catch (err) {
    Swal.fire({
      title: "Unexpected Error",
      html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or referesh to try again, Thank you!</p>`,
      confirmButtonText: "Close"
    });
  }
};
//call fetch
fetchVisitorsData();

//Fetch Guards data
const fetchGuardsData = async () => {
  // spinner.style.display = "block";
  try {
    let response = await fetch(guardsUrl, {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: token
      }
    });
    let data = await response.json();
    const { gatemen } = data;
    console.log(gatemen)
    document.getElementById('totalGuards').innerHTML = gatemen.length;
    let count = 0;

    gatemen.map(gatemen => {
      const { name, phone, image } = gatemen;
      count++;

      guardsData.push({
        count,
        name,
        phone,
        image
      });
    });
console.log(guardsData, 'guards')
  } catch (err) {
    Swal.fire({
      title: "Unexpected Error",
      html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or refresh to try again. Thank you!</p>`,
      confirmButtonText: "Close"
    });
  }
};
//call fetch
fetchGuardsData();


//Fetch services data
const fetchServicesData = async () => {
  // spinner.style.display = "block";
  try {
    let response = await fetch(servicesUrl, {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: token
      }
    });
    let data = await response.json();
    console.log(data)
    // document.getElementById('totalservices').innerHTML = gatemen.length;

    // gatemen.map(gatemen => {
    //   const { name, phone, image } = gatemen;
    //   count++;

      // servicesData.push({
      //   count,
      //   name,
      //   phone,
      //   image
      // });
    // });
// console.log(servicesData, 'services')
  } catch (err) {
    Swal.fire({
      title: "Unexpected Error",
      html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or refresh to try again. Thank you!</p>`,
      confirmButtonText: "Close"
    });
  }
};
//call fetch
fetchServicesData();