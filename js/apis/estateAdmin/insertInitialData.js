function insertData(){ 
Table.innerHTML = "";
paginationData.forEach(data=>{
    
Table.innerHTML += `<tr class="input">
                <th scope= "row">${data.count}
                </th>
                <td class="shift-name">
                    <img width=10% class="img-fluid rounded-circle float-left pr-2 " src="https://res.cloudinary.com/getfiledata/image/upload/w_200,c_fill,ar_1:1,g_auto,r_max/${data.image}"><p>${data.name}</p>
                </td>
                <td>
                    <p>Morning</p>
                </td>
                <td class="shift-phone">
                    <p>${data.phone}</p>
                </td>
                <td>
                    <span class="fa fa-trash"><i class="unseen">delete</i></span>
                
                    <span class="fa fa-pencil"><i class="unseen">edit</i></span>
                </td>
                <td>
                    <input type="submit" name="view" value="view" class="green_button view">
                </td>
            </tr>`;
    });
    }