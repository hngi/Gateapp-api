const url = `${api_origin}${allVisitors}`;
const fetchData = async () => {
  let response = await fetch(url);
  let data = await response.json();
  console.log(data);
  const { visitors } = data;
  const tableBody = document.createElement("tbody");
  tableBody.innerHTML = `
  ${visitors
    .map(
      visitor =>
        `<tr>
                <td>${visitor.name}</td>
                <td>Otedola Estate</td>
                <td>${visitor.arrival_date}</td>
                <td><a href="" data-toggle="modal" data-target="#singleVisitorModal">View History</a>
                </td>
              </tr>`
    )
    .join(" ")}`;
  let table = document.querySelector("#table");
  table.appendChild(tableBody);
};
fetchData();
