let estate_id = sessionStorage.getItem('estateId');
console.log(estate_id);
const url = `http://52.40.191.249/api/v1/estate/${estate_id}/gateman`;


// const token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1NzE1NzEwNjksImV4cCI6MTU3ODgyODY2OSwibmJmIjoxNTcxNTcxMDY5LCJqdGkiOiJUU0VpM1poMlRRbWo0R3BPIiwic3ViIjozMywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.xbWkPC5Y1KuLMOk2YEIPjHLQmmNlyp60URuebP4ETHQ';

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
      console.log(data);
      // const { visitors } = data;
      // console.log(visitors);
    //   return visitors.map(visitor => {
    //     const {
    //       name,
    //       banned,
    //       estate: { estate_name },
    //       updated_at
    //     } = visitor;
    //     //Render data
    //     if(!banned){
    //       spinner.style.display = "none";
    //       table.innerHTML += `
    //                 <tr>
    //                 <td>${name}</td>
    //                 <td>${estate_name}</td>
    //                 <td>${convertDate(updated_at)}</td>
    //                 <td><a href="" data-toggle="modal" data-target="#singleVisitorModal" onclick="fetchVisitorHistory(${visitor.id})">View History</a></td>
    //                 </tr>`;
    //     }
    //   });
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