//Route to fetch all visit
const routes = new Routes();
const url = `${routes.api_origin}${routes.allVisitors}`;
//Define ui variables
const table = document.querySelector("#table");
const modal = document.querySelector("#singleVisitorModal");
const banButton = document.querySelector("#ban");
//Convert date Function
const convertDate = inputFormat => {
  //format date
  const date = new Date(inputFormat);
  return date.toLocaleDateString();
};

//Fetch data
const fetchData = async () => {
  let response = await fetch(url, { Authorization: token });
  let data = await response.json();
  console.log(data);
  const { visitors } = data;
  return visitors.map(visitor => {
    const { name, estate_id, updated_at } = visitor;
    //Render data
    let tableRow = table.insertRow(),
      visitorName = tableRow.insertCell(),
      lastVisitedEstate = tableRow.insertCell(),
      lastVisitedDate = tableRow.insertCell(),
      viewHistory = tableRow.insertCell();

    visitorName.innerHTML = `${name}`;
    lastVisitedEstate.innerHTML = `${estate_id}`;
    lastVisitedDate.innerHTML = `${convertDate(updated_at)}`;

    viewHistory.innerHTML = `<td><a href="" data-toggle="modal" data-target="#singleVisitorModal">View History</a></td>`;
    //Modal
    viewHistory.addEventListener("click", () => {
      modalName.innerHTML = `${name}`;
    });
  });
};
fetchData();
