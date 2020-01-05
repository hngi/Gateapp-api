function insertData(){ 
Table.innerHTML = "";
paginationData.forEach(data=>{
    
    Table.innerHTML += `<tr class="highlight">
                            <th>${data.count}</th>
                            <td>
                                <div class="d-flex flex-row align-items-start">
                                    <img
                                    width="40px"
                                    height="40px"
                                    src="${data.image}"
                                    alt="You"
                                    style="margin-right: 10px; border-radius: 50%;"
                                    />
                                    <p
                                    style="font-size: 16px; color: #141821;"
                                    class="mt-1"
                                    >
                                    ${data.name}
                                    </p>
                                </div>
                            </td>
                            <td>Online</td>
                            <td>${data.phone}</td>
                            <td>${data.access}</td>
                            <td>
                                <button
                                    type="button"
                                    style="background: #49A347; color: #fff;"
                                    class="btn"
                                >View</button>
                            </td>
                            </tr>`;
    });
  }
