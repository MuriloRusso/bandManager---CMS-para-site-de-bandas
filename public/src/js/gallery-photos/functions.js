
// photos



//get
async function getPhotos(){
    toggleLoading();

    const url = window.location.href;
    const id = url.split('?id=')[1];
    fetch(`${baseUrl}/gallery-photos/get.php?id=${id}`)
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                document.querySelector('#list').innerHTML = '';
                if(data.length === 0){
                    document.querySelector('#list').innerHTML = '<p class="color-white">Sem fotos na galeria por enquanto!</p>';
                }
                for(let count = 0; count < data.length; count++){

                    let content = `                            
                        <a href="#" class="d-flex justify-content-center align-items-center gallery-img">
                            <img src="public/src/img/upload/gallery/photos/${data[count].photo}.${data[count].format}" alt="${data[count].photo}">
                            <!-- <button href="#" class="view">
                                <img src="./public/src/img/icons/arrow.png">
                            </button> -->
                        </a>
                    `;

                    if(sessionBol === true){
                        content += `
                            <div class="p-3">
                                <a href="#" class="d-flex justify-content-center align-items-center gallery-img"></a>
                                <a href="#" onclick="handleDelete(${data[count].id})" class="btn btn-delete">
                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                </a>
                            </div>
                        `;
                    }

                    document.querySelector('#list').innerHTML += `
                        <div class="gallery-item my-1">
                            ${content}
                        </div>
                    `;
                }

                // Modal de foto

                const photos = document.querySelectorAll('.gallery-item');
                const modalGalleryItem = document.querySelector('.modal-gallery-item');

                for(let count = 0; count < photos.length; count++){
                    photos[count].onclick = () => {
                        let src = photos[count].querySelector('img').src;
                        modalGalleryItem.classList.add('opened');
                        modalGalleryItem.querySelector('img').src = src;
                    }
                }

                document.querySelector('.close-modal-gallery-item').onclick = () => {
                    modalGalleryItem.classList.remove('opened');
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
getPhotos();





// new
async function newPhoto(){
    const id_gallery = document.querySelector('#id_gallery');
    const upload = document.querySelector('#upload');

    if(upload.files.length === 0){
        upload.classList.add('error');
    }
    if(id_gallery.value && upload.files.length > 0){
        var formData = new FormData();
        formData.append('id_gallery', id_gallery.value);
        formData.append('file', upload.files[0], upload.files[0].name);
        await postFetchMultipartNoRedirect(formData, `${baseUrl}gallery-photos/new.php`);
        getPhotos();
        document.querySelector('.modal.opened').classList.remove('opened');
        document.querySelector('.upload-image img').remove();
        document.querySelector('.upload-image').innerHTML = 'Alterar/Escolher imagem';
    }
}



//delete
async function deletePhoto(api){
    await deleteItem2(api);
    getPhotos();
}


