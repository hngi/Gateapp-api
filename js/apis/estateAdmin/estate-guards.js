
const routes = new Routes();
//route

let estate_guard = JSON.parse(sessionStorage.getItem('estateGuard'));
// console.log(estate_guard);
let estate_id = estate_guard.home.estate_id;

const url = `${routes.api_origin}${routes.estateGuards}${estate_id}/gateman`;


const gatemenTable = document.getElementById("gatemenTable");

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
      return gatemen.map(gatemen => {
        const {
          name,
          phone,
          image
        } = gatemen;
        count++;

        gatemenTable.innerHTML += `<tr class="input">
                            <th scope= "row">${count}
                            </th>
                            <td class="shift-name">
                                <img width=10% class="img-fluid rounded-circle float-left pr-2 " src="https://res.cloudinary.com/getfiledata/image/upload/w_200,c_fill,ar_1:1,g_auto,r_max/${image}"><p>${name}</p>
                            </td>
                            <td>
                                <p>Morning</p>
                            </td>
                            <td class="shift-phone">
                                <p>${phone}</p>
                            </td>
                            <td>
                                <span class="fa fa-trash"><i class="unseen">delete</i></span>
                            
                                <span class="fa fa-pencil"><i class="unseen">edit</i></span>
                            </td>
                            <td>
                                <input type="submit" name="view" value="view" class="green_button view">
                            </td>
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