//Here we are going to use promise.all method to fetch 

//Temporary storage for api response
let statHolder = {};
console.log('open')
const fetchAllStat = () => {

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
    const  api_weeklyEstate    = triggerFetch(`${api_origin}${weeklyEstate}`);
    const  api_weeklySp        = triggerFetch(`${api_origin}${weeklyServiceProvider}`)
    const  api_weeklyVisitor   = triggerFetch(`${api_origin}${weeklyServiceVisits}`)
    //Monthly route 
    const  api_monthlyEstate   = triggerFetch(`${api_origin}${monthlyEstate}`)
    const  api_monthlySp       = triggerFetch(`${api_origin}${monthlyServiceProvider}`)
    const  api_monthlyVisitor  = triggerFetch(`${api_origin}${monthlyServiceVisits}`)
    //All Statistics route 
    const  api_estates_all     = triggerFetch(`${api_origin}${allEstate}`)
    const  api_services_all    = triggerFetch(`${api_origin}${allServiceProvider}`)
    const  api_vistors_all     = triggerFetch(`${api_origin}${allVisits}`)

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
            default:
        }
        return res.json();
    }

    Promise
        .all([
            api_weeklyEstate,  api_weeklySp,     api_weeklyVisitor,
            api_monthlyEstate, api_monthlySp,    api_monthlyVisitor,
            api_estates_all,   api_services_all, api_vistors_all
        ])
        .then(response => {
            //Convert to Json
            return Promise
                        .all(response.map(res => handleError(res)));
        })
        .then(datas => {
            console.log(datas);
            if(datas) {
                statHolder['wkly'] = [];
                statHolder['mnthly'] = [];
                statHolder['all'] = []; 

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
            console.log(err);
        });
}


const insertStat = (statHolder) => {
    console.log(statHolder);
    const statView   = document.querySelector('[data-stat-view]')
    const wklyBtn   = document.querySelector('[data-wkly-btn]');
    const mnthlyBtn = document.querySelector('[data-mnthly-btn]');
    const allBtn    = document.querySelector('[data-all-btn]');

    let {all, wkly, mnthly} = statHolder;

    //Loop Weekly  Statistic
    const viewWkly = () => {
        
    }
    //Loop Monthly Statistic
    const viewMnthly = () => {
        
    }
    //Loop All Statistic
    const viewAll = () => {
        
    }
    console.log(all);
    console.log(wkly);
    console.log(mnthly);


}

fetchAllStat();
