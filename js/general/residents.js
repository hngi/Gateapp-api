const resdients = [
    {
        id: 67,
        name : "Sandra Anderson",
        estate : "Otedola Estate",
        phoneNumber : "+234 803 234 3456"
    },

    {
        id: 23,
        name : "Kelvin Metu",
        estate : "Ikeji Estate",
        phoneNumber : "+234 803 234 5677"
    },

    {
        id: 90,
        name : "Jeff Madson",
        estate : "Otedola Estate",
        phoneNumber : "+234 803 567 4767"
    },

    {
        id: 120,
        name : "Chioma Madukwere",
        estate : "Maryland Estate",
        phoneNumber : "+234 803 234 3456"
    },

    {
        id: 89,
        name : "Sandra Anderson",
        estate : "Otedola Estate",
        phoneNumber : "+234 803 234 3456"
    }
]

const createResidentRow = (props) => {
    const { id, name, estate, phoneNumber} = props
    const tableRow = document.createElement('tr');

    tableRow.classList.add('mobile-table-row');
    tableRow.innerHTML = `
        <td class="table-data"><span class="mobile-header">name <i class="plus">+</i></span>${name}</td>
        <td class="table-data"><span class="mobile-header">estate</span>${estate}</td>
        <td class="table-data"><span class="mobile-header">phone no.</span>${phoneNumber}</td>
        <td class="view-stats table-data">view stats</td>                           
    `
    tableRow.querySelector('.view-stats')
    .addEventListener('click', () => {
        console.log(props)
        const dataName = document.getElementById('dataName');
        const dataEstate = document.getElementById('dataEstate');
        const dataNumber = document.getElementById('dataNumber');

        dataName.innerHTML = props.name;
        dataEstate.innerHTML = props.estate;
        dataNumber.innerHTML = props.phoneNumber;

        const informationCont = document.getElementById('informationCont');
        informationCont.classList.remove('hide');

        const closeBtn = document.getElementById('closeInfoBtn');
        closeBtn.addEventListener('click', () =>{
            informationCont.classList.add('hide');
        })
    })


    

    return tableRow
}
const appendRow = (row) => {
    const table = document.getElementById('table');
    table.append(row);
}
for(let res of resdients) {
    appendRow(createResidentRow(res))
}


/* ---------------------------- */
const showOtherData = (e) => {
    
}
const plusSign = document.querySelectorAll('plus');
plusSign.forEach((p) =>{
    p.addEventListener('click', showOtherData);
})