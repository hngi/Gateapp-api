const serviceProviderRequestSearch = () => {
    return fetch('http://localhost/api/v1/service-provider/info/{id}')
    .then(res => res.json())
    .then(data => {return data})
    }