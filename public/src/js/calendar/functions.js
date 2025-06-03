//calendar

//get
async function getCalendar(){
    toggleLoading();
    fetch(`${baseUrl}/calendar/get.php`)
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                document.querySelector('#list').innerHTML = '';
                if(data.length === 0){
                    document.querySelector('#list').innerHTML = '<p class="color-white">Sem Eventos na agenda por enquanto!</p>';
                }
                for(let count = 0; count < data.length; count++){
                    let created = data[count].date_calendar.split(' ');
                    let createdFormated = created[0].split('-');
                    createdFormated = `${createdFormated[2]}/${createdFormated[1]}/${createdFormated[0]} ${created[1]}`;
                    let content = `
                        <div class="d-flex">
                            <img src="public/src/img/icons/calendar.png" class="icon-calendar" alt="">
                            <div class="px-3">
                                <p class="short-text m-0 color-gray">${createdFormated}</p>
                                <p class="color-white m-0">Local: ${data[count].local_name}</p>
                                <p class="color-white m-0">Rua: ${data[count].address}</p>
                            </div>
                        </div>
                    `;
                    if(sessionBol === true){
                        content += `
                            <div style="min-width: 90px;">
                                <a href="#" class="btn btn-edit" onclick="handleEdit(${data[count].id})">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <a href="#" onclick="handleDelete(${data[count].id}, '${data[count].local_name}')" class="btn btn-delete">
                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                </a>
                            </div>
                        `;
                    }
                    document.querySelector('#list').innerHTML += `
                        <div class="event d-flex align-items-center py-2 justify-content-between">
                            ${content}
                        </div>
                    `;
                }
            }
            else{
                creatAlert('alert-danger', 'Houve um erro desconhecido na sua solicitação');
            }
            toggleLoading();
        })
    })
    .catch(error => {
        console.error('Erro na requisição POST:', error);
        document.querySelector('.modal.opened').classList.remove('opened');
        throw new Error("error");
    });
}
getCalendar();

    //new
const newEvent = async (e) => {
    e.preventDefault();
    const tipo = document.querySelector('#tipo');
    const local = document.querySelector('#local');
    const dateCalendar = document.querySelector('#date_calendar');
    const address = document.querySelector('#address');
    if(!tipo.value){
        tipo.classList.add('error');
    }
    if(!local.value){
        local.classList.add('error');
    }
    if(!dateCalendar.value){
        dateCalendar.classList.add('error');
    }
    if(!address.value){
        address.classList.add('error');
    }
    if(tipo.value && local.value && dateCalendar.value && address.value){
        var formData = new FormData();
        formData.append('tipo', tipo.value);
        formData.append('local', local.value);
        formData.append('dateCalendar', dateCalendar.value);
        formData.append('address', address.value);
        await postFetchMultipartNoRedirect(formData, `${baseUrl}calendar/new.php`);
        getCalendar();
        document.querySelector('.modal.opened').classList.remove('opened');
        tipo.value = '';
        local.value = '';
        dateCalendar.value = '';
        address.value = '';
    }
}
if(document.querySelector(".modal-new form") != null){
    document.querySelector(".modal-new form").addEventListener("submit", newEvent);
}

//edit
const editEvent = async (e) => {
    e.preventDefault();
    const tipo = document.querySelector('#tipoEdit');
    const local = document.querySelector('#localEdit');
    const dateCalendar = document.querySelector('#date_calendarEdit');
    const address = document.querySelector('#addressEdit');
    if(!tipo.value){
        tipo.classList.add('error');
    }
    if(!local.value){
        local.classList.add('error');
    }
    if(!dateCalendar.value){
        dateCalendar.classList.add('error');
    }
    if(!address.value){
        address.classList.add('error');
    }
    if(tipo.value && local.value && dateCalendar.value && address.value){
        var formData = new FormData();
        formData.append('id', document.querySelector('#idEdit').value);
        formData.append('tipo', tipo.value);
        formData.append('local', local.value);
        formData.append('dateCalendar', dateCalendar.value);
        formData.append('address', address.value);
        await postFetchMultipartNoRedirect(formData, `${baseUrl}calendar/edit.php`);
        getCalendar();
        document.querySelector('.modal.opened').classList.remove('opened');
    }
}
if(document.querySelector(".modal-edit form") != null){
    document.querySelector(".modal-edit form").addEventListener("submit", editEvent);
}



//delete
async function deleteEvent(api){
    deleteItem2(api);
    getCalendar();
}

//handleEdit
const modalEdit = document.querySelector('.modal-edit');
const closeModalEdit = document.querySelector('.close-modal-edit');

if(closeModalEdit != null){
    closeModalEdit.onclick = () => {
        modalEdit.classList.remove('opened');
    }    
}

async function handleEdit(id){
    toggleLoading();
    fetch(`adm/api/calendar/getById.php?id=${id}`, {
        method: 'GET',
    })
    .then((response) => {

        response.json().then((data) => {
            if(response.status === 200){
                modalEdit.classList.add('opened');
                document.querySelector('#idEdit').value = data.id;
                document.querySelector(`#tipoEdit option[value="${data.id_event}"]`).selected = true
                document.querySelector('#localEdit').value = data.local_name;
                document.querySelector('#date_calendarEdit').value = data.date_calendar;
                document.querySelector('#addressEdit').value = data.address;
                toggleLoading();
            }
            else if(response.status === 401){

            }
            else{
                alert('Houve um erro desconhecido na sua solicitação');
            }
        })
    })
    .catch(error => {
        console.error('Erro na requisição POST:', error);
        throw new Error("error");
    });

}
