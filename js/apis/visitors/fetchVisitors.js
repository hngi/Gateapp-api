const table = document.querySelector('tbody');

const fetchVisitors = (apiUrl) => {
	
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
		const visitors = data.visitors;

		visitors.forEach((visitor, index) => {
			console.log(visitor);
			const node = document.createElement("tr");
			const name = document.createElement("td");
			name.innerHTML = `${visitor.name}`;
			const lastVisited = document.createElement("td");
			lastVisited.innerHTML = visitor.user_id;
			const visitedOn = document.createElement("td");
			visitedOn.innerHTML =`${visitor.arrival_date}`;
			const status = document.createElement("td");
			status.innerHTML = `<a href="#" data-toggle="modal" data-target="#singleVisitorModal" onclick="showVisitorHistory(${visitor.id})" >Visit History</a>`;
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
fetchVisitors(`${api_origin}${getVisitors}`);