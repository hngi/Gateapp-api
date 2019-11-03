// check if user is superadmin
const table = document.querySelector('tbody');

const url = `${api_origin}${getBanned}`;


const fetchEstateName = (id) => {
	let $result = "";
  	fetch(`${api_origin}api/v1/estate/${id}`,{
		method: "GET",
		mode: "cors",
		headers: {
			"Accept": "application/json",
			"Content-Type": "application/json",
			"Authorization": localStorage.getItem('token')
		}
	})
	.then((response) => response.json())
	.then((data) => {
		console.log(data);

		if(data.status === false){
			console.log(id);
			return id;
		} else {
			console.log(data.estate.estate_name);
			return data.estate.estate_name;
		}

	})
	.catch((error) => {
	console.log(error);
	});

return $result;
};

const fetchBannedVisitors = (apiUrl) => {
	fetch(apiUrl,{
		method: "GET",
		mode: "cors",
		headers: {
			"Accept": "application/json",
			"Content-Type": "application/json",
			"Authorization": localStorage.getItem('token')
		}
	})
	.then((response) => response.json())
	.then((data) => {
		const users = data.data;
		users.forEach((user, index) => {
			console.log(user);
			const node = document.createElement("tr");
			const name = document.createElement("td");
			name.innerHTML = `${user.name}`;
			const lastVisited = document.createElement("td");
			lastVisited.innerHTML = user.id;
			const visitedOn = document.createElement("td");
			visitedOn.innerHTML =`${user.arrival_date}`;
			const status = document.createElement("td");
			status.innerHTML = `<a href="#" class="unban-link" data-id="${user.id}" onclick="unbanVisitor(${user.id})" >Unban</a>`;
			node.appendChild(name);
			node.appendChild(lastVisited);
			node.appendChild(visitedOn);
			node.appendChild(status);
			table.appendChild(node);
		})
	})
	.catch((error) => {
	console.log(error);
	});

}

// load banned visitors
fetchBannedVisitors(url);