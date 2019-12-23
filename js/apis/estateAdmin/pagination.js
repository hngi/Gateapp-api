let currentPage = 1;
let dataPerPage = 10;
let paginationData = [];
let responseData = [];




class Pagination {
    constructor () {
        let pageCount = Math.ceil(responseData.length/dataPerPage);
        loadPage();
        console.log('hi');
        const firstBtn = document.querySelector('#firstBtn');
        const prevBtn = document.querySelector('#prevBtn');
        const nextBtn = document.querySelector('#nextBtn');
        const lastBtn = document.querySelector('#lastBtn');
        
        firstBtn.addEventListener('click', ()=>{
            currentPage = 1;
            console.log(currentPage);
            loadPage();
        });
        prevBtn.addEventListener('click', ()=>{
            currentPage -= 1;
            console.log(currentPage);
            loadPage();
        });
        nextBtn.addEventListener('click', ()=>{
            currentPage += 1;
            console.log(currentPage);
            loadPage();
        });
        lastBtn.addEventListener('click', ()=>{
            currentPage = pageCount;
            console.log(currentPage);
            loadPage();
        });
        
        function  loadPage () {
            let start = (currentPage-1) * dataPerPage;
            let end = start + dataPerPage;
            paginationData = responseData.slice(start, end);
        
            insertData();
            checkPagination();
            console.log(paginationData)
        }
        
        function checkPagination() {
            document.getElementById("nextBtn").disabled = currentPage == pageCount ? true : false;
            document.getElementById("prevBtn").disabled = currentPage == 1 ? true : false;
            document.getElementById("firstBtn").disabled = currentPage == 1 ? true : false;
            document.getElementById("lastBtn").disabled = currentPage == pageCount ? true : false;
            console.log('here')
        }
    }
}