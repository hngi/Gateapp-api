const routes = new Routes();
axios.defaults.baseURL = "http://localhost:8000";
axios.defaults.headers.common['Authorization'] = token;
const container = document.querySelector(`table.estates-table tbody`);


const handleError = (error) => {
    switch (error.response.status) {
        case" 401":
            window.location.assign('login.html');
            break;
        default:
            Swal.fire(
                'Error',
                error.response.data.message || error.toString(),
                'error'
            )
    }
};

const removeBan = (visitor_id) => {
    axios.post(routes.removeBannedVisitor(visitor_id))
        .then((response => {
            let elem = document.getElementById(`baned_visitor_${visitor_id}`);
            elem.parentNode.removeChild(elem);
            Swal.fire(
                'Ban Removed!',
            );

            if (container.innerHTML.length < 1) {
                container.innerHTML
                = `<tr>
                    <td colspan="4"> No banned visitor </td>
                </tr>`;
            }
        }))
};

const confirmBanRemove = (visitor_id) => {
    Swal.fire({
        title: 'Are you sure to remove ban',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            removeBan(visitor_id);
        }
    })
};

const getBannedVisitors = () => {
    axios.get(routes.allBannedVisitor)
        .then(response => {
            let banned = response.data.data;
           if (banned.length < 1) {
               return document.querySelector(`#loading_wait td`).innerHTML = `No banned visitor`;
           }

           container.innerHTML  = '';

            $(banned).each((index, item) => {
                let row =`<tr id="baned_visitor_${item.id}">
                    <td>${item.name}</td>
                    <td>${item.estate || 'Otedola Estate'}</td>
                    <td>${item.time_in || 'Not Available'}</td>
                    <td><a href="javascript:void(0)" class="unban-link" onclick="confirmBanRemove(${item.id})">Unban</a>
                    </td>
                </tr>`;

                $(container).append(row);
            });

            container.innerHTML = data;
        }).catch( error => handleError(error));
};