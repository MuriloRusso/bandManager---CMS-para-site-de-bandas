
// member




//get
async function getGallerys(){
    toggleLoading();
    fetch(`${baseUrl}/gallery/get.php`)
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                document.querySelector('#list').innerHTML = '';
                if(data.length === 0){
                    document.querySelector('#list').innerHTML = '<p class="color-white">Sem Galerias por enquanto!</p>';
                }
                for(let count = 0; count < data.length; count++){

                    let content = `                            
                        <a href="gallery-photos.php?id=${data[count].id}" class="d-flex justify-content-center align-items-center gallery-img">
                            <img src="public/src/img/upload/gallery/${data[count].capa}.${data[count].format}" alt="${data[count].title}">
                            <button href="gallery-photos.php?id=${data[count].id}" class="arrow">
                                <img src="./public/src/img/icons/arrow.png" alt="">
                            </button>
                        </a>
                        <div class="p-3">
                            <a href="gallery-photos.php?id=${data[count].id}" class="text-decoration-none btn-secondary heading font-title">
                                ${data[count].title}
                            </a>
                            <p class="short-text color-white">${data[count].text}</p>
                        </div>
                    `;

                    if(sessionBol === true){
                        content = `
                            <a href="gallery-photos.php?id=${data[count].id}" class="d-flex justify-content-center align-items-center gallery-img">
                                <img src="public/src/img/upload/gallery/${data[count].capa}.${data[count].format}" alt="">
                                <button href="gallery-photos.php?id=${data[count].id}" class="arrow">
                                    <img src="./public/src/img/icons/arrow.png" alt="">
                                </button>
                            </a>
                            <div class="p-3">
                                <a href="gallery-photos.php?id=${data[count].id}" class="text-decoration-none btn-secondary heading font-title">
                                    ${data[count].title}
                                </a>
                                <p class="short-text color-white">${data[count].text}</p>
                                <div class="py-3">
                                    <a href="#" onclick="handleEdit(${data[count].id})" class="btn btn-edit">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    <a href="#" onclick="handleDelete(${data[count].id}, '${data[count].title}')" class="btn btn-delete">
                                        <i class="fa-sharp fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        `;
                    }
                    document.querySelector('#list').innerHTML += `
                        <div class="gallery-item my-5 aos-init aos-animate" data-aos="flip-down" data-aos-duration="700">
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
getGallerys();





// new
const newGallery = async (e) => {
    e.preventDefault();
    const title = document.querySelector('#title');
    const text = document.querySelector('#text');
    const upload = document.querySelector('#upload');

    if(!title.value){
        title.classList.add('error');
    }
    if(!text.value){
        text.classList.add('error');
    }
    if(upload.files.length === 0){
        upload.classList.add('error');
    }
    if(title.value && text.value && upload.files.length > 0){
        var formData = new FormData();
        formData.append('title', title.value);
        formData.append('text', text.value);
        formData.append('file', upload.files[0], upload.files[0].name);
        await postFetchMultipartNoRedirect(formData, `${baseUrl}gallery/new.php`);
        getGallerys();
        document.querySelector('.modal.opened').classList.remove('opened');

        title.value = '';
        text.value = '';
        document.querySelector('.upload-image img').remove();
        document.querySelector('.upload-image').innerHTML = 'Alterar/Escolher imagem';
    }
}
if(document.querySelector(".modal-new form") != null){
    document.querySelector(".modal-new form").addEventListener("submit", newGallery);
}


// edit
const editGallery = async (e) => {
    e.preventDefault();
    const title = document.querySelector('#titleEdit');
    const text = document.querySelector('#textEdit');
    const upload = document.querySelector('#uploadEdit');

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
        if(upload.files.length > 0){
            formData.append('file', upload.files[0], upload.files[0].name);
        }
        await postFetchMultipartNoRedirect(formData, `${baseUrl}gallery/edit.php`);
        getGallerys();
        document.querySelector('.modal.opened').classList.remove('opened');
    }
}

if(document.querySelector(".modal-edit form") != null){
    document.querySelector(".modal-edit form").addEventListener("submit", editGallery);
}


//delete
async function deleteGallery(api){
    deleteItem2(api);
    getGallerys();
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
    fetch(`adm/api/gallery/getById.php?id=${id}`, {
        method: 'GET',
    })
    .then((response) => {

        response.json().then((data) => {
            if(response.status === 200){
                modalEdit.classList.add('opened');
                document.querySelector('#idEdit').value = data.id;
                document.querySelector('#titleEdit').value = data.title;
                document.querySelector('#textEdit').value = data.text;
                document.querySelector('.img-atual').src = './public/src/img/upload/gallery/'+ data.capa + '.' + data.format;
                document.querySelector('.img-atual').style.display = 'block';
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