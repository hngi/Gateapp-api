const routes = new Routes();
let residentsData = [];
let visitorsData = [];
let guardsData = [];
let totalVisits = 0;
let numR = [];
let numG = [];

let residentsSummary = document.getElementById('residents');

let guardsSummary = document.getElementById('guards');

let estate_guard = JSON.parse(sessionStorage.getItem("estateGuard"));
console.log(estate_guard);
let estate_id = estate_guard.home.estate_id;

const residentsUrl = `${routes.api_origin}${routes.estateGuards}${estate_id}/residents`;
const visitorsUrl = `${routes.api_origin}${routes.allVisitors}${estate_id}`;
const guardsUrl = `${routes.api_origin}${routes.estateGuards}${estate_id}/gateman`;
const servicesUrl = `${routes.api_origin}${routes.estateServiceProviders}`;


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
    // console.log(data)
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
    document.getElementById('totalResidents').innerHTML = residents.length;
    let count = 0;
    for (let i=0; i<3; i++){
      numR.push(Math.floor(Math.random() * residents.length));
    }

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
    
    //Residents summary
    
    residentsData.forEach(resident=>{
      numR.forEach(num=>{
        if (resident.count ===num){
    residentsSummary.innerHTML += `
    <div
    class="d-flex flex-row justify-content-between align-items-center pl-4 pr-4 mb-3"
  >
    <div class="d-flex flex-row align-items-center">
      <img
        width="60px"
        height="60px"
        src="${resident.image}"
        alt="You"
        style="margin-right: 10px; border-radius: 50%;"
      />
      <div
        class="d-flex flex-column"
        style="width: inherit;"
      >
        <p style="font-size: 16px; color: #141821;">${resident.name}</p>
        <p style="font-size: 14px; margin-top: -1.5em; color: #858997;">
          BLOCK D, Flat 3
        </p>
      </div>
    </div>
    <p style="color: #858997; font-size: 14px;">
    ${resident.phone}
    </p>
    <a href="#"><p style="color: #49A347; font-size: 14px;"> View</p></a>
  </div>
    `}
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
    // console.log(visitorsData, 'visitors')
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
    document.getElementById('totalGuards').innerHTML = gatemen.length;
    let count = 0;
    for (let i=1; i<=3; i++){
      numG.push(Math.floor(Math.random() * gatemen.length));
    }
    

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

    guardsData.forEach(guard=>{
      numG.forEach(num=>{
        if (guard.count ===num){
      guardsSummary.innerHTML += `
    <div
    class="d-flex flex-row justify-content-between align-items-center pl-4 pr-4 mb-3"
  >
    <div class="d-flex flex-row align-items-center">
      <img
        width="60px"
        height="60px"
        src="${guard.image}"
        alt="You"
        style="margin-right: 10px; border-radius: 50%;"
      />
      <div
        class="d-flex flex-column"
        style="width: inherit;"
      >
        <p style="font-size: 16px; color: #141821;">${guard.name}</p>
        <p style="font-size: 14px; margin-top: -1.5em; color: #858997;">
          Morning Shift
        </p>
      </div>
    </div>
    <p style="color: #858997; font-size: 14px;">
      ${guard.phone}
    </p>
    <a href="#"><p style="color: #49A347; font-size: 14px;"> View</p></a>
  </div>
    `}
      });
    });
    
// console.log(guardsData, 'guards')
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
    
    const { message, sp_count, estate_id } = data;
    document.getElementById('totalServices').innerHTML = sp_count;
      
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