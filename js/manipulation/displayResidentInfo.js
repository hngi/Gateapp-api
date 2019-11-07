//Define ui variables
let dataName = document.querySelector("#dataName");
let dataEstate = document.querySelector("#dataEstate");
let dataNumber = document.querySelector("#dataNumber");
let dataDate = document.querySelector("#dataDate");
//received data from getAllResidents.js
let displayResidentInformation = (event, viewStatBtn) => {
  event.preventDefault();
  //assign dataset value to variables
  const id = viewStatBtn.dataset.residenceId;
  const name = viewStatBtn.dataset.residenceName;
  const phone = viewStatBtn.dataset.residencePhone;
  const estate = viewStatBtn.dataset.residenceEstate;
  const date = viewStatBtn.dataset.residenceDate;
  //render values
  dataName.innerHTML = `${name}`;
  dataEstate.innerHTML = `${estate}`;
  dataNumber.innerHTML = `${phone}`;
  dataDate.innerHTML = `${convertDate(date)}`;
  //open view stats pop up
  const informationCont = document.querySelector("#informationCont");
  informationCont.classList.remove("hide");
  //close view stats pop up
  const closeBtn = document.querySelector("#closeInfoBtn");
  closeBtn.addEventListener("click", () => {
    informationCont.classList.add("hide");
  });
  //Call getResidenceStats with id from dataset. This function is located in residents/allResidentStats.js
  getResidenceStats(id);
};
