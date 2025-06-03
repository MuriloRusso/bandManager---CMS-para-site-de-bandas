//news


//get
async function getNews(){
    toggleLoading();
    fetch(`${baseUrl}/news/get.php`)
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                document.querySelector('#list').innerHTML = '';
                if(data.length === 0){
                    document.querySelector('#list').innerHTML = '<p class="color-white">Sem Notícias por enquanto!</p>';
                }
                for(let count = 0; count < data.length; count++){
                    let created = data[count].created.split(' ');
                    let createdFormated = created[0].split('-');
                    createdFormated = `${createdFormated[2]}/${createdFormated[1]}/${createdFormated[0]} ${created[1]}`;
                    let content = `
                        <p class="date mb-0 color-gray">${createdFormated}</p>
                            <a href="new.php?id=${data[count].id}" class="text-decoration-none">
                                <h2 class="text-uppercase py-2 mb-0 color-white">${data[count].title}</h2>
                            </a>
                        <p class="color-white">${data[count].text}</p>
                        <div>
                            <a href="new.php?id=${data[count].id}" class="btn-primary">Ver mais</a>                            
                        </div>                                            
                    `;

                    if(sessionBol === true){
                        content += `
                            <div class="py-3">
                                <a href="#" onclick="handleEdit(${data[count].id})" class="btn btn-edit">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <a href="#" onclick="handleDelete(${data[count].id}, '${data[count].title}')" class="btn btn-delete">
                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                </a>
                            </div>
                        `;
                    }
                    document.querySelector('#list').innerHTML += `
                        <div class="new my-5 aos-init aos-animate" data-aos="zoom-in-up" data-aos-duration="700">
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
        throw new Error("error");
    });
}
getNews();

//new
const newNew = async (e) => {
    e.preventDefault();
    const title = document.querySelector('#title');
    const text = document.querySelector('#text');
    if(!title.value){
        title.classList.add('error');
    }
    if(!text.value){
        text.classList.add('error');
    }
    if(title.value && text.value){
        var formData = new FormData();
        formData.append('title', title.value);
        formData.append('text', text.value);
        await postFetchMultipartNoRedirect(formData, `${baseUrl}news/new.php`);
        getNews();
        document.querySelector('.modal.opened').classList.remove('opened');

        title.value = '';
        text.value = '';
    }
}
if(document.querySelector(".modal-new form") != null){
    document.querySelector(".modal-new form").addEventListener("submit", newNew);
}

//edit

const editNew = async (e) => {
    e.preventDefault();
    const title = document.querySelector('#titleEdit');
    const text = document.querySelector('#textEdit');

    if(!title.value){
        title.classList.add('error');
    }
    if(!text.value){
        text.classList.add('error');
    }
    if(title.value && text.value){
        var formData = new FormData();
        formData.append('id', document.querySelector('#idEdit').value);
        formData.append('title', title.value);
        formData.append('text', text.value);
        // await postFetchMultipart(formData, `${baseUrl}news/edit.php`, 'edit', 'news.php');
        await postFetchMultipartNoRedirect(formData, `${baseUrl}news/edit.php`);
        getNews();
        document.querySelector('.modal.opened').classList.remove('opened');
    }
}

if(document.querySelector(".modal-edit form") != null){
    document.querySelector(".modal-edit form").addEventListener("submit", editNew);
}



//delete
async function deleteNew(api){
    deleteItem2(api);
    getNews();
}


//HandleEdit

const modalEdit = document.querySelector('.modal-edit');
const closeModalEdit = document.querySelector('.close-modal-edit');

if(closeModalEdit != null){
    closeModalEdit.onclick = () => {
        modalEdit.classList.remove('opened');
    }
}
async function handleEdit(id){
    toggleLoading();
    fetch(`adm/api/news/getById.php?id=${id}`, {
        method: 'GET',
    })
    .then((response) => {

        response.json().then((data) => {
            if(response.status === 200){
                modalEdit.classList.add('opened');
                document.querySelector('#idEdit').value = data.id;
                document.querySelector('#titleEdit').value = data.title;
                document.querySelector('#textEdit').value = data.text;
                toggleLoading();

            }
            else{
                createAlert('Houve um erro desconhecido na sua solicitação');
            }
        })
    })
    .catch(error => {
        console.error('Erro na requisição POST:', error);
        throw new Error("error");
    });

}