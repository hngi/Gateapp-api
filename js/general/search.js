	
	filterList = () => {
        let searchInput, filter, tr, i, td, txtValue;
        
        searchInput = document.getElementById('myInput');
        filter = searchInput.value.toUpperCase();
        trs = document.querySelectorAll('.search-row');
        trs.forEach(tr => tr.style.display = [...tr.children].find(td => td.innerHTML.toUpperCase().includes(filter)) ? '' : 'none');
    };