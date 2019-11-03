const url = `${api_origin}${allVisitors}`;
console.log(url);

const fetchData = async () => {
  let response = await fetch(url);
  let data = await response.json();
  console.log(data);
  // return data;
};
fetchData();
