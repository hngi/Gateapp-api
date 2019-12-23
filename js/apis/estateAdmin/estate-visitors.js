let estate_guard = JSON.parse(sessionStorage.getItem('estateGuard'));
// console.log(estate_guard);
let estate_id = estate_guard.home.estate_id;

const Table = document.getElementById("visitors");

const routes = new Routes;
const url = `${routes.api_origin}${routes.allVisitors}${estate_id}`;
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
      const { visitors } = data;
      let count = 0;
      visitors.map(visitor => {
        const {
          name,
          phone_no,
          image,
          visit_count
        } = visitor;
        count++;

        responseData.push({
          count,
          name,
          phone_no,
          image,
          visit_count
        });
      });

      const pagination = new Pagination;
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