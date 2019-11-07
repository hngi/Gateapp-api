//define ui variables
let loader = document.querySelectorAll("[data-loader]");
//getResidenceStats function calls from two different api endpoints with the id passed from displayResidentInfo.js
const getResidenceStats = id => {
  //preloader
  Array.from(loader).forEach(load => {
    load.style.display = "block";
  });
  //API calls to scheduledVisits and finishedVisits
  try {
    let firstAPICall = fetch(
      `${routes.api_origin}${routes.scheduledVisits(id)}`,
      { Authorization: token }
    );
    let secondAPICall = fetch(
      `${routes.api_origin}${routes.finishedVisits(id)}`,
      { Authorization: token }
    );
    Promise.all([firstAPICall, secondAPICall])
      .then(values => Promise.all(values.map(value => value.json())))
      .then(finalVals => {
        let firstAPIResp = finalVals[0];
        let secondAPIResp = finalVals[1];
        renderResponse(firstAPIResp, secondAPIResp);
      });
  } catch (error) {
    Swal.fire({
      title: "Unexpected Error",
      html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or referesh to try again, Thank you!</p>`,
      confirmButtonText: "Close"
    });
  }
};
//Render function
const renderResponse = (scheduledVisits, finishedVisits) => {
  console.log(scheduledVisits, finishedVisits);
  Array.from(loader).forEach(load => {
    load.style.display = "none";
  });
  let dataScheduledVisit = document.querySelector("#scheduled-visit");
  let dataFinisedVisit = document.querySelector("#finished-visit");
  dataScheduledVisit.innerHTML = scheduledVisits.visit_schedule;
  dataFinisedVisit.innerHTML = finishedVisits.visit_schedule;
};
