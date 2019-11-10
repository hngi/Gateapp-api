const fetchVisitorHistory = async (id) => {
const url = `${routes.api_origin}${routes.visitorHistory(id)}`;
const table = document.querySelector("#historyTable");
table.innerHTML =  `<thead data-table-head>
                      <tr><th scope="col">Date</th><th scope="col">Estate</th></tr>
                    </thead>
                    <tbody>
                    <div data-preloader="" id="loading" class="text-center"
                    style="position: absolute;left: 50%;margin-top: 30vh;display: block;">
                       <div class="spinner-border" role="status" style="color: #49a347;"></div>
                   </div>
                        `;
  const visitorName = document.querySelector("[data-history-name]");
  const banBtn = document.querySelector("[data-ban-btn]");
  const tableHead = document.querySelector("[data-table-head]");
  let loader = document.getElementById("loading");
  visitorName.style.display = "none";
  banBtn.style.display = "none";
  tableHead.style.display = "none";
  // loader.style.display="block";
  let response = await fetch(url,{
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          Authorization: token
        }
      });
  let data = await response.json();
  const { history } = data;

  const {name, estate, visitor_history} = history[0];
  console.log(history[0]);

  if(!visitor_history.length == 0){
    visitorName.innerHTML = name;
    visitorName.style.display = "block";
    banBtn.style.display = "block";
    banBtn.setAttribute("onclick",`banVisitor(${history[0].id})`);
    tableHead.style.display = "";
    visitor_history.map((history) => {
      table.innerHTML += `<tr class="history-items"><td>${history.visit_date}</td><td>${estate.estate_name}</td></tr>`;
    });
    document.getElementById("loading").style.display="none"
  } else{
    table.innerHTML = `<h5 style="margin: 50% auto;">this visitor has no history</h5>`;
  }
}


const banVisitor = async (id) => {
  const url = `${routes.api_origin}${routes.banVisitor(id)}`;
  const table = document.querySelector("#historyTable");
const visitorName = document.querySelector("[data-history-name]");
const banBtn = document.querySelector("[data-ban-btn]");
const tableHead = document.querySelector("[data-table-head]");
let loader = document.getElementById("loading");
// let rows = document.querySelectorAll('.history-items');
let rows = document.querySelectorAll('tr');
rows.forEach((row) =>{row.style.display = "none"});
visitorName.style.display = "none";
banBtn.style.display = "none";
tableHead.style.display = "none";
  document.getElementById("loading").style.display="block"

  let response = await fetch(url,{
        method: "POST",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          Authorization: token
        }
      });
  let data = await response.json();
  const { message } = data;
  table.innerHTML = `<h5 style="margin: 50% auto;">${message}</h5>`;
  fetchData();
};
