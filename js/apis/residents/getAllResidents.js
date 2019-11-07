//Route to fetch all visit
const routes = new Routes();
const url = `${routes.api_origin}${routes.allResidents}`;
//Define ui variables
const table = document.querySelector("#table");
const infoContent = document.querySelector("#informationCont");
let spinner = document.querySelector("[data-preloader]");
//Format date
const convertDate = inputFormat => {
  const date = new Date(inputFormat);
  return date.toDateString();
};

//init residentsArray
const residentsArray = [];
//fetch data
const fetchData = async () => {
  spinner.style.display = "block";
  try {
    let response = await fetch(url, { Authorization: token });
    let data = await response.json();
    residentsArray.push(data.residents);
    //call render function
    viewResidents();
  } catch (err) {
    Swal.fire({
      title: "Unexpected Error",
      html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or referesh to try again, Thank you!</p>`,
      confirmButtonText: "Close"
    });
  }
};
//call fetch
fetchData();
//render function
const viewResidents = () => {
  if (residentsArray) {
    spinner.style.display = "none";
    residentsArray[0].map(resident => {
      const { id, name, phone, created_at } = resident;
      table.innerHTML += `
            <tr>
            <td>${name}</td>
            <td>${
              resident.home === null ? "-" : resident.home.estate.estate_name
            }</td>
            <td>${phone}</td>
            <td class="view-stats"
            data-residence-id="${id}" 
            data-residence-name="${name}" 
            data-residence-phone="${phone}" 
            data-residence-date="${created_at}" 
            data-residence-estate="${
              resident.home === null ? "-" : resident.home.estate.estate_name
            }"><a href="#">view stats</a></td>
            </tr>`;
    });

    //Picking individual residence deatils using data atrribute
    //This api has a conection to the script manipulation/displayResidentInfo.js
    //The onclick event from the Residence Details is tranfer to the view stats popup
    const viewStatsBtn = Array.from(document.querySelectorAll(".view-stats"));
    viewStatsBtn.map(viewStatBtn =>
      viewStatBtn.addEventListener("click", e =>
        displayResidentInformation(e, viewStatBtn)
      )
    );
  }
};
