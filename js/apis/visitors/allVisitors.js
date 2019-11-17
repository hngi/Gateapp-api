//Route to fetch all visit
const routes = new Routes();
const url = `${routes.api_origin}${routes.allVisitors}`;
//Define ui variables
const table = document.querySelector("#table");
const modal = document.querySelector("#singleVisitorModal");
const banButton = document.querySelector("#ban");
let spinner = document.querySelector("[data-preloader]");
//Convert date Function
const convertDate = inputFormat => {
  const date = new Date(inputFormat);
  return date.toLocaleDateString();
};

//Fetch data
const fetchData = async () => {
  spinner.style.display = "block";
  try {
    let response = await fetch(url, {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: token
      }
    });
    let data = await response.json();
    console.log(data);
    const { visitors } = data;
    return visitors.map(visitor => {
      const {
        name,
        estate: { estate_name },
        updated_at
      } = visitor;
      //Render data
      spinner.style.display = "none";
      table.innerHTML += `
                <tr>
                <td>${name}</td>
                <td>${estate_name}</td>
                <td>${convertDate(updated_at)}</td>
                <td><a href="" data-toggle="modal" data-target="#singleVisitorModal">View History</a></td>
                </tr>`;
    });
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
