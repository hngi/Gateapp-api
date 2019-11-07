//Route to fetch all visit
const routes = new Routes();
const url = `${routes.api_origin}${routes.allResidents}`;
//Define ui variables
const table = document.querySelector("#table");
const infoContent = document.querySelector("#informationCont");
//Format date
const convertDate = inputFormat => {
  //format date
  const date = new Date(inputFormat);
  return date.toDateString();
};
//fetch data
const fetchData = async () => {
  try {
    let response = await fetch(url, { Authorization: token });
    let data = await response.json();
    console.log(data);
    const { residents } = data;
    console.log(residents);
    return residents.map(resident => {
      const { name, phone, created_at } = resident;
      //render
      let tableRow = table.insertRow(),
        residentName = tableRow.insertCell(),
        residentEstate = tableRow.insertCell(),
        residentPhone = tableRow.insertCell(),
        viewStats = tableRow.insertCell();

      residentName.innerHTML = `${name}`;
      residentEstate.innerHTML = `${
        resident.home === null ? "-" : resident.home.estate.estate_name
      }`;
      residentPhone.innerHTML = `${phone}`;
      viewStats.innerHTML = `<td class="view-stats"><a href="#">view stats</a></td>`;
      viewStats.querySelector(".view-stats");
      viewStats.addEventListener("click", () => {
        const dataName = document.querySelector("#dataName");
        const dataEstate = document.querySelector("#dataEstate");
        const dataNumber = document.querySelector("#dataNumber");
        const dataDate = document.querySelector("#dataDate");

        dataName.innerHTML = `${name}`;
        dataEstate.innerHTML = `${
          resident.home === null ? "-" : resident.home.estate.estate_name
        }`;
        dataNumber.innerHTML = `${phone}`;
        dataDate.innerHTML = `${convertDate(created_at)}`;

        const informationCont = document.querySelector("#informationCont");
        informationCont.classList.remove("hide");

        const closeBtn = document.querySelector("#closeInfoBtn");
        closeBtn.addEventListener("click", () => {
          informationCont.classList.add("hide");
        });
      });
    });
  } catch (err) {
    Swal.fire({
      title: "Unexpected Error",
      html: `<p style="color:tomato; font-size:17px;">${err}</p>`,
      confirmButtonText: "Close"
    });
  }
};
fetchData();
