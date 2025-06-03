
// member




//get
async function getPosts(){
    toggleLoading();
    fetch(`${baseUrl}/blog/get.php`)
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                document.querySelector('#list').innerHTML = '';
                if(data.length === 0){
                    document.querySelector('#list').innerHTML = '<p class="color-white">Sem postagens por enquanto!</p>';
                }
                for(let count = 0; count < data.length; count++){

                    let created = data[count].created.split(' ');
                    let createdFormated = created[0].split('-');
                    createdFormated = `${createdFormated[2]}/${createdFormated[1]}/${createdFormated[0]} ${created[1]}`;

                    let content = `
                        <div class="col-md-1 col-12">
                            <p class="date">${createdFormated}</p>
                            <p class="color-white m-0">Publicado Por:</p>
                            <p class="color-white">${data[count].user_name}</p>
                        </div>
                        <div class="col-md-4 col-12 d-flex justify-content-center">
                            <img src="public/src/img/upload/post/${data[count].capa}.${data[count].format}" alt="${data[count].title}">
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="px-1">
                                <h3 class="font-title pt-md-0 pt-3">${data[count].title}</h3>
                                <p class="color-white short-text">${data[count].text}</p>
                                <a href="post.php?id=${data[count].id}" class="btn-primary">Leia mais</a>
                            </div>
                        </div>
                    `;

                    if(sessionBol === true){
                        content = `
                            <div class="col-md-1 col-12">
                                <p class="date">${createdFormated}</p>
                                <p class="color-white m-0">Publicado Por:</p>
                                <p class="color-white">${data[count].user_name}</p>
                            </div>
                            <div class="col-md-4 col-12 d-flex justify-content-center">
                                <img src="public/src/img/upload/post/${data[count].capa}.${data[count].format}" alt="${data[count].title}">
                            </div>
                            <div class="col-md-7 col-12">
                                <div class="px-1">
                                    <h3 class="font-title pt-md-0 pt-3">${data[count].title}</h3>
                                    <p class="color-white short-text">${data[count].text}</p>
                                    <a href="post.php?id=${data[count].id}" class="btn-primary">Leia mais</a>
                                    <div class="py-3">
                                        <a href="#" onclick="handleEdit(${data[count].id})" class="btn btn-edit">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="#" onclick="handleDelete(${data[count].id}, '${data[count].title}')" class="btn btn-delete">
                                            <i class="fa-sharp fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                    document.querySelector('#list').innerHTML += `
                        <div class="post d-flex flex-wrap py-5 aos-init aos-animate" data-aos="fade-right" data-aos-duration="700">
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
getPosts();



// new
const newPost = async (e) => {
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
        await postFetchMultipartNoRedirect(formData, `${baseUrl}blog/new.php`);
        getPosts();
        document.querySelector('.modal.opened').classList.remove('opened');


        title.value = '';
        text.value = '';
        document.querySelector('.upload-image img').remove();
        document.querySelector('.upload-image').innerHTML = 'Alterar/Escolher imagem';

    }
}
if(document.querySelector(".modal-new form") != null){
    document.querySelector(".modal-new form").addEventListener("submit", newPost);
}

//edit
const editPost = async (e) => {
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
        await postFetchMultipartNoRedirect(formData, `${baseUrl}blog/edit.php`);
        getPosts();
        document.querySelector('.modal.opened').classList.remove('opened');


    }
}
if(document.querySelector(".modal-edit form") != null){
    document.querySelector(".modal-edit form").addEventListener("submit", editPost);
}

//delete
async function deletePost(api){
    await deleteItem2(api);
    getPosts();
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
    fetch(`adm/api/blog/getById.php?id=${id}`, {
        method: 'GET',
    })
    .then((response) => {

        response.json().then((data) => {
            if(response.status === 200){
                modalEdit.classList.add('opened');
                document.querySelector('#idEdit').value = data.id;
                document.querySelector('#titleEdit').value = data.title;
                document.querySelector('#textEdit').value = data.text;
                document.querySelector('.img-atual').src = './public/src/img/upload/post/'+ data.capa + '.' + data.format;
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