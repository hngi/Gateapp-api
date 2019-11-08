const updateServiceProviderTable = async (data) => {
    // return
    let tbody = "";
    for (let i = 0; i < data[0].length; i++) {
        const row = data[0][i];
        // return
        const tr = "<tr>";
        const td1 = "<td>" + row.name + "</td>";
        const td2 = "<td>" + row.description + "</td>";
        const td4 = "<td>" + "<a href='" + row.id + "' data-toggle='modal' data-target='#singleProviderModal'>View Details</a>" + "</td>";
        let td3 = ""
        await fetch('http://gateappapi.herokuapp.com/api/v1/estate/' + row.estate_id, {
            headers: {
                Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nYXRlYXBwYXBpLmhlcm9rdWFwcC5jb21cL2FwaVwvdjFcL2xvZ2luXC9hZG1pbiIsImlhdCI6MTU3MzEyMDA2NiwiZXhwIjoxNTczMzM2MDY2LCJuYmYiOjE1NzMxMjAwNjYsImp0aSI6IjNaOXZDUmNneVJRelJLMEMiLCJzdWIiOjg1LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.AFwChREgNxECAzucbYDglfhXXkGAfhQ3lpd5bU4cCQk'
            }
        })
        .then(res => res.json())
        .then(data => { td3 = "<td>" + data.estate.estate_name + ", " + data.estate.address + "</td>" })
        .catch(err => console.log(err))
        tbody += tr + td1 + td2 + td3 + td4 + "</tr>"
    }
    // console.log(tbody)
    document.querySelector('tbody').innerHTML = tbody;
    return;
}

fetch('http://gateappapi.herokuapp.com/api/v1/service-provider/requests', {
    headers: {
        Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9nYXRlYXBwYXBpLmhlcm9rdWFwcC5jb21cL2FwaVwvdjFcL2xvZ2luXC9hZG1pbiIsImlhdCI6MTU3MzEyMDA2NiwiZXhwIjoxNTczMzM2MDY2LCJuYmYiOjE1NzMxMjAwNjYsImp0aSI6IjNaOXZDUmNneVJRelJLMEMiLCJzdWIiOjg1LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.AFwChREgNxECAzucbYDglfhXXkGAfhQ3lpd5bU4cCQk'
    }
})
.then(res => res.json())
.then(data => updateServiceProviderTable(data.requests))
.catch(err => console.log(err))