const baseUrl = 'adm/api/';


//check-session

let sessionBol = false;
let session = {};

async function checkSession(){
    fetch(`${baseUrl}/check-session.php`)
    .then((response) => {
        response.json().then((data) => {
            sessionBol = data.session;
            session = data;
        })
    })
    .catch(error => {
        console.error('Erro na requisição POST:', error);
        throw new Error("error");
    });
}

checkSession();

//-----------------------------





//fetchs


async function getFetch(route) {
    toggleLoading();
    let myResponse = fetch(`${route}`)
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                toggleLoading();
                console.log(data);
            }
            else if(response.status === 401){
                toggleLoading();
            }
            else{
                creatAlert('alert-danger', 'Houve um erro desconhecido na sua solicitação');
            }
        })
    })
    .catch(error => {
        console.error('Erro na requisição POST:', error);
        throw new Error("error");
    });
    return myResponse;
}


async function postFetchMultipart(body, route, alert, red) {
    toggleLoading();
    let myResponse = fetch(`${route}`, {
        method: 'POST',
        body: body,
    })
    .then((response) => {
        console.log(response);
        console.log(response.status);
        response.json().then((data) => {
            if(response.status === 200){
                window.location.href = `${red}?alert=${alert}`;//descomentar depois
                toggleLoading();
                // createAlert('alert-success', 'teste');
            }
            else if(response.status === 401){
                toggleLoading();
                // return toggleModal(data.message);;
                console.log(data.status);
                console.log(data.message);
                console.log(response.status);
                console.log(response.message);
                // alert(data.message);
                createAlert('alert-danger', data.message);
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
    return myResponse;
}

async function postFetchMultipartNoRedirect(body, route) {
    toggleLoading();
    let myResponse = fetch(`${route}`, {
        method: 'POST',
        body: body,
    })
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                toggleLoading();
                createAlert('alert-success', data.message);
            }
            else if(response.status === 401){
                toggleLoading();
                createAlert('alert-danger', data.message);
            }
            else{
                toggleLoading();
                createAlert('alert-danger', 'Houve um erro desconhecido na sua solicitação');
            }
        })
    })
    .catch(error => {
        createAlert('alert-danger', 'Houve um erro desconhecido na sua solicitação');
        console.error('Erro na requisição POST:', error);
        throw new Error("error");
    });
    return myResponse;
}

//--------------------------------------------




async function postFetchMultipartLogin(body, route) {
    toggleLoading();
    let myResponse = fetch(`${route}`, {
        method: 'POST',
        body: body,
    })
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                window.location.href = `index.php`;//descomentar depois
                toggleLoading();
                // createAlert('alert-success', 'teste');
            }
            else if(response.status === 401){
                toggleLoading();
                createAlert('alert-danger', data.message);
            }
            else{
                createAlert('alert-danger', data.message);
                alert('Houve um erro desconhecido na sua solicitação');
            }
        })
    })
    .catch(error => {
        console.error('Erro na requisição POST:', error);
        throw new Error("error");
    });
    return myResponse;
}



//crud functions

async function deleteItem(api){
    var formData = new FormData();
    formData.append('id', document.querySelector('#idDelete').value);
    await postFetchMultipart(formData, `${baseUrl + api}/delete.php`, 'delete', api+ '.php');
}

async function deleteItem2(api){
    var formData = new FormData();
    formData.append('id', document.querySelector('#idDelete').value);
    await postFetchMultipartNoRedirect(formData, `${baseUrl + api}/delete.php`);
    document.querySelector('.modal.opened').classList.remove('opened');
}

//---------------------------------------------

