
// member




//get
async function getMembers(){
    toggleLoading();
    fetch(`${baseUrl}/members/get.php`)
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                document.querySelector('#list').innerHTML = '';
                if(data.length === 0){
                    document.querySelector('#list').innerHTML = '<p class="color-white">Sem Membros por enquanto!</p>';
                }
                for(let count = 0; count < data.length; count++){
                    let dateInclusion = data[count].date_inclusion.replace(' 00:00:00', '');
                    dateInclusion = dateInclusion.split('-');
                    let content = `
                        
                        <div class="col-md-2 col-12">
                            <img src="public/src/img/upload/member/${data[count].photo}.${data[count].format}" alt="${data[count].name}">
                        </div>
                        <div class="col-md-10 col-12">
                            <div class="px-3 d-flex flex-column justify-content-center">
                                <h2 class="text-uppercase py-2 mb-0 color-white">${data[count].name}</h2>
                                <h3 class="color-white">${data[count].function}</h3>
                                <p class="date mb-0 color-gray py-2">Membro(a) desde: ${dateInclusion[2]}/${dateInclusion[1]}/${dateInclusion[0]}</p>
                                <p class="color-white">${data[count].text}</p>
                            </div>
                        </div>
                    `;

                    if(sessionBol === true){
                        content = `
                        <div class="col-md-2 col-12">
                            <img src="public/src/img/upload/member/${data[count].photo}.${data[count].format}" alt="${data[count].name}">
                        </div>
                        <div class="col-md-10 col-12">
                            <div class="px-3 d-flex flex-column justify-content-center">
                                <h2 class="text-uppercase py-2 mb-0 color-white">${data[count].name}</h2>
                                <h3 class="color-white">${data[count].function}</h3>
                                <p class="date mb-0 color-gray py-2">Membro(a) desde: ${dateInclusion[2]}/${dateInclusion[1]}/${dateInclusion[0]}</p>
                                <p class="color-white">${data[count].text}</p>
                                <div>
                                    <div class="py-3">
                                        <a href="#" onclick="handleEdit(${data[count].id})" class="btn btn-edit">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="#" onclick="handleDelete(${data[count].id}, '${data[count].name}')" class="btn btn-delete">
                                            <i class="fa-sharp fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                    }

                    document.querySelector('#list').innerHTML += `
                        <div class="member my-5 d-flex flex-wrap pb-5">
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
getMembers();



// new
const newMember = async (e) => {
    e.preventDefault();
    const title = document.querySelector('#title');
    const functionMember = document.querySelector('#functionMember');
    const dataInclusion = document.querySelector('#date_inclusion');
    const text = document.querySelector('#text');
    const upload = document.querySelector('#upload');

    if(!title.value){
        title.classList.add('error');
    }
    if(!text.value){
        text.classList.add('error');
    }
    if(!functionMember.value){
        functionMember.classList.add('error');
    }
    if(!dataInclusion.value){
        dataInclusion.classList.add('error');
    }
    if(upload.files.length === 0){
        upload.classList.add('error');
    }
    if(title.value && text.value && upload.files.length > 0 && functionMember.value && dataInclusion.value){
        var formData = new FormData();
        formData.append('title', title.value);
        formData.append('function', functionMember.value);
        formData.append('inclusion', dataInclusion.value);
        formData.append('text', text.value);
        formData.append('file', upload.files[0], upload.files[0].name);
        // await postFetchMultipart(formData, `${baseUrl}members/new.php`, 'new', 'members.php');
        await postFetchMultipartNoRedirect(formData, `${baseUrl}members/new.php`);
        getMembers();
        document.querySelector('.modal.opened').classList.remove('opened');

        title.value = '';
        functionMember.value = '';
        text.value = '';
        document.querySelector('.upload-image img').remove();
        document.querySelector('.upload-image').innerHTML = 'Alterar/Escolher imagem';
    }
}

if(document.querySelector(".modal-new form") != null){  
    document.querySelector(".modal-new form").addEventListener("submit", newMember);
}



// edit
const editMember = async (e) => {
    e.preventDefault();
    const title = document.querySelector('#titleEdit');
    const text = document.querySelector('#textEdit');
    const functionMember = document.querySelector('#functionMemberEdit');
    const dataInclusion = document.querySelector('#date_inclusion_edit');
    const upload = document.querySelector('#uploadEdit');

    if(!title.value){
        title.classList.add('error');
    }
    if(!text.value){
        text.classList.add('error');
    }
    if(!functionMember.value){
        functionMember.classList.add('error');
    }
    if(!dataInclusion.value){
        dataInclusion.classList.add('error');
    }
    if(title.value && text.value && functionMember.value && dataInclusion.value){
        var formData = new FormData();
        formData.append('id', document.querySelector('#idEdit').value);
        formData.append('title', title.value);
        formData.append('function', functionMember.value);
        formData.append('inclusion', dataInclusion.value);
        formData.append('text', text.value);
        if(upload.files.length > 0){
            formData.append('file', upload.files[0], upload.files[0].name);
        }
        await postFetchMultipartNoRedirect(formData, `${baseUrl}members/edit.php`);
        getMembers();
        document.querySelector('.modal.opened').classList.remove('opened');
    }
}
if(document.querySelector(".modal-edit form") != null){
    document.querySelector(".modal-edit form").addEventListener("submit", editMember);
}


//delete
async function deleteMember(api){
    await deleteItem2(api);
    getMembers();
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
    fetch(`adm/api/members/getById.php?id=${id}`, {
        method: 'GET',
    })
    .then((response) => {

        response.json().then((data) => {
            let dateInclusion = data.date_inclusion.replace(' 00:00:00', '');
            if(response.status === 200){
                modalEdit.classList.add('opened');
                document.querySelector('#idEdit').value = data.id;
                document.querySelector('#titleEdit').value = data.name;
                document.querySelector('#textEdit').value = data.text;
                document.querySelector('#functionMemberEdit').value = data.function;
                document.querySelector('#date_inclusion_edit').value = dateInclusion;
                console.log(dateInclusion);
                document.querySelector('.img-atual').src = './public/src/img/upload/member/'+ data.photo + '.' + data.format;
                document.querySelector('.img-atual').style.display = 'block';//por algum motivo,ao editar/deletar/add algum membro, ao tentar editar novamente, aparece sem foto pois a mesma fica com display none, investigar causa.
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