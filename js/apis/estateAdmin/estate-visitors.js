let estate_guard = JSON.parse(sessionStorage.getItem('estateGuard'));
// console.log(estate_guard);
let estate_id = estate_guard.home.estate_id;

const visitorsTable = document.getElementById("visitors");

const url = `http://52.40.191.249/api/v1/visitors/${estate_id}`;
const estateUrl = `http://52.40.191.249/api/v1/estate/${estate_id}`;

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
      const { visitors } = data;
      let count = 0;
      return visitors.map(visitor => {
        const {
          name,
          phone_no,
          image,
          visit_count
        } = visitor;
        count++;

        visitorsTable.innerHTML += `<tr class="input">
                            <th scope= "row">${count}
                            </th>
                            <td class="shift-name">
                                <img  width="10%" class="img-fluid rounded-circle float-left pr-1" src="https://res.cloudinary.com/getfiledata/image/upload/w_200,c_fill,ar_1:1,g_auto,r_max/${image}"><p>${name}</p>
                            </td>
                            <td>
                                <p>Morning</p>
                            </td>
                            <td class="shift-phone">
                                <p>${phone_no}</p>
                            </td>
                            <td>
                                <p>${visit_count}</p>
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