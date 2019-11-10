//Here we are going to use promise.all method to fetch 

//Temporary storage for api response
const routes = new Routes();

let statHolder = {};
statHolder['wkly'] = [];
statHolder['mnthly'] = [];
statHolder['all'] = []; 

console.log('open')
const fetchAllStat = (requestkey = 'wkly') => {
    let request;
    let api_1;
    let api_2;
    let api_3;
    const triggerFetch = (url) => {
       return  fetch(url, {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                    "Authorization": token
                }
            });
    }
    //Weeekly route 
    if(requestkey == 'wkly'){
        api_1  = triggerFetch(`${routes.api_origin}${routes.statWeeklyEstate}`);
        api_2  = triggerFetch(`${routes.api_origin}${routes.statWeeklyServiceProvider}`)
        api_3  = triggerFetch(`${routes.api_origin}${routes.statWeeklyServiceVisits}`)
    }
    //Monthly route 
    if(requestkey == 'mnthly'){
        api_1  = triggerFetch(`${routes.api_origin}${routes.statMonthlyEstate}`)
        api_2  = triggerFetch(`${routes.api_origin}${routes.statMonthlyServiceProvider}`)
        api_3  = triggerFetch(`${routes.api_origin}${routes.statMonthlyServiceVisits}`)
    }
    //All Statistics route 
       if(requestkey == 'all'){
        api_1  = triggerFetch(`${routes.api_origin}${routes.statAllEstate}`)
        api_2  = triggerFetch(`${routes.api_origin}${routes.statAllServiceProvider}`)
        api_3  = triggerFetch(`${routes.api_origin}${routes.statAllVisits}`)
    }
    request = [api_1, api_2, api_3];
    //Error handling
    const handleError = (res) => {
        // console.log(res)
        // console.log(res.headers.get('content-type'))
        switch(res.status) {
            case 401:
                    Swal.fire({
                        title: `Token Error`,
                        html:  `<p style="color:tomato; font-size:17px;">Invalid token or token has expired!</p>`,
                        confirmButtonText: 'Close'
                    }) 
                break;
            case 403:
                    Swal.fire({
                        title: `Permission Denied`,
                        html:  `<p style="color:tomato; font-size:17px;">You are not permited to access this route!</p>`,
                        confirmButtonText: 'Close'
                    }) 
                break;
            case 429:
                    location.replace('../login.html');
                break;
            default:
        }
        return res.json();
    }

    Promise
        .all(request)
        .then(response => {
            //Convert to Json
            return Promise
                        .all(response.map(res => handleError(res)));
        })
        .then(datas => {
            console.log(datas);
            if(datas) {
                datas.map(data => {
                    console.log(data.status) 
                    switch(data.status){
                        case 'wkly':
                            statHolder['wkly'].push(data);
                            break;
                        case 'mnthly':
                            statHolder['mnthly'].push(data);
                            break;
                        case 'all':
                            statHolder['all'].push(data);
                            break;
                            default:
                    }
                });

                insertStat(statHolder);
            }
        })
        .catch(err => {
            if(err) {
                sunmitBtn.innerHTML = 'Login';
                Swal.fire({
                    title: 'Unexpected Error',
                    html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or contact website owner, Thank you!</p>`,
                    confirmButtonText: 'Close'            
                })
             }
             console.error(err);
        });
}


const insertStat = (statHolder) => {
    const statView   = document.querySelector('[data-stat-view]')
    const wklyBtn   = document.querySelector('[data-wkly-btn]');
    const mnthlyBtn = document.querySelector('[data-mnthly-btn]');
    const allBtn    = document.querySelector('[data-all-btn]');
    //get buttons class
    const btnClasses = Array.from(document.querySelectorAll('.all-stat-tabs'));

    const {all, wkly, mnthly} = statHolder;

    //Loop  Statistic Dynamicly
    const viewStatistics = (period, btn, type="Weekly") => {
        //Get the data using array destructuring
        const [estates, serviceProviders, visitors] = period;
        //Get the data using obj destructuring
        const {estates_count} = estates;
        const {sp_count}     = serviceProviders;
        const {visit_count}      = visitors;

         statView.innerHTML = '';
         
         //Remove any stat_active class
         btnClasses.map(btnClass => btnClass.classList.remove('stat_active'));
         //Add class to specific btn
         btn.classList.add('stat_active');

         statView.innerHTML += `
            <h5 class="col-12 stats-header" style="font-weight:bold; text-align:center;">${type} Statistics</h5>
            <div class="col-12 col-md-4 stat text-center">
                <h2 class="mb-0 mt-3">${ visit_count }</h2>
                <span>Scheduled Visit</span>
            </div>
            <div class="col-12 col-md-4 stat text-center">
                <h2 class="mb-0 mt-3">${ sp_count }</h2>
                <span>Services Providers</span>
            </div>
            <div class="col-12 col-md-4 stat text-center">
                <h2 class="mb-0 mt-3">${ estates_count }</h2>
                <span>New Estates</span>
            </div>
        `
    }
    viewStatistics(wkly, wklyBtn);

    wklyBtn.addEventListener('click', (event) => viewStatistics(wkly,  wklyBtn, 'Weekly'));
    mnthlyBtn.addEventListener('click', (event) => viewStatistics(mnthly, mnthlyBtn, 'Monthly'));
    allBtn.addEventListener('click', (event) => viewStatistics(all, allBtn, 'All'));

}

fetchAllStat('wkly');
setTimeout( () => {
    fetchAllStat('mnthly');
}, 300)
setTimeout( () => {
    fetchAllStat('all');
}, 600)

