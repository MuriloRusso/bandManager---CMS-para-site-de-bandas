//new
const modalNew = document.querySelector('.modal-new');
const closeModalNew = document.querySelector('.close-modal-new');
const openModalNew = document.querySelector('.open-modal-new');

if(modalNew != null){    
    if(closeModalNew != null){
        closeModalNew.onclick = () => {
            modalNew.classList.remove('opened');
        }
        openModalNew.onclick = () => {
            modalNew.classList.add('opened');
        }
        //delete
        const modalDelete = document.querySelector('.modal-delete');
        const closeModalDelete = document.querySelector('.close-modal-delete');
        
        closeModalDelete.onclick = () => {
            modalDelete.classList.remove('opened');
        }
        function handleDelete(id, title){
            modalDelete.classList.add('opened');
            document.querySelector('#idDelete').value = id;
            document.querySelector('#titleText').innerText = title;
        }
    }
}