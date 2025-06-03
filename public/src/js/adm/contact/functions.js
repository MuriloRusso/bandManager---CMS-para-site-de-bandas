//contacts


let contact = {};


//answer

const answer = async (e) =>{
    e.preventDefault();
    // toggleLoading();
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
        formData.append('email', contact.email);
        formData.append('name', contact.name);
        formData.append('title', title.value);
        formData.append('text', text.value);
        await postFetchMultipartNoRedirect(formData, `${baseUrl}contact/answer.php`);
        document.querySelector('.modal.opened').classList.remove('opened');
        title.value = '';
        text.value = '';
    }
}
if(document.querySelector('.modal-answer form') != null){
    document.querySelector('.modal-answer form').addEventListener('submit', answer);
}


//HandleAnswer

const modalAnswer = document.querySelector('.modal-answer');
const closemodalAnswer = document.querySelector('.close-modal-answer');

if(closemodalAnswer != null){
    closemodalAnswer.onclick = () => {
        modalAnswer.classList.remove('opened');
    }
}
async function openAnswer(id){
    toggleLoading();
    fetch(`adm/api/contact/getById.php?id=${id}`, {
        method: 'GET',
    })
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                modalAnswer.classList.add('opened');
                contact = data;
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


//HandleView

const modalView = document.querySelector('.modal-view');
const closemodalView = document.querySelector('.close-modal-view');

if(closemodalView != null){
    closemodalView.onclick = () => {
        modalView.classList.remove('opened');
    }
}

async function openView(id){
    toggleLoading();
    fetch(`adm/api/contact/getById.php?id=${id}`, {
        method: 'GET',
    })
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                modalView.classList.add('opened');
                contact = data;
                const timeStampSplit = contact.created.split(' ');
                const date = timeStampSplit[0];
                const time = timeStampSplit[1];
                const dataSplit = date.split('-');
                document.querySelector('#date').innerText = dataSplit[2] + '/' + dataSplit[1] + '/' + dataSplit[0] + ' ' + time;
                document.querySelector('#name').innerText = contact.name;
                document.querySelector('#telefone').innerText = contact.telephone;
                document.querySelector('#email').innerText = contact.email;
                document.querySelector('#msg').innerText = contact.message;
                document.querySelector('.modal-view .btn-answer').onclick = () => {openAnswer(contact.id)};

                if(contact.view == 0){
                    var formData = new FormData();
                    formData.append('id', id);
                    postFetchMultipartNoRedirect(formData, `${baseUrl}contact/view.php`);
                }
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