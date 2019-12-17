let estate_guard = JSON.parse(sessionStorage.getItem('estateId'));
let estate_id = estate_guard.home.estate_id;

const gatemenTable = document.getElementById("gatemenTable");

const url = `http://52.40.191.249/api/v1/estate/${estate_id}/gateman`;

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
                                <img class="img-fluid rounded-circle" src="${image}"><p>${name}</p>
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