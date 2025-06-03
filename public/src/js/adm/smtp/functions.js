
// smtp

//get
async function getSMTP(){
    toggleLoading();
    fetch(`${baseUrl}/smtp/get.php`)
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                document.querySelector('#host').value = data.host;
                document.querySelector('#port').value = data.port;
                document.querySelector('#secure').value = data.secure;
                document.querySelector('#auth').value = data.auth;
                document.querySelector('#email').value = data.email;
                document.querySelector('#password').value = data.password;
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
getSMTP();



// update
const editSMTP = async (e) => {
    e.preventDefault();
    const host = document.querySelector('#host');
    const port = document.querySelector('#port');
    const secure = document.querySelector('#secure');
    const auth = document.querySelector('#auth');
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');

    if(!host.value){
        host.classList.add('error');
    }
    if(!port.value){
        port.classList.add('error');
    }

    if(!secure.value){
        secure.classList.add('error');
    }

    if(!auth.value){
        auth.classList.add('error');
    }

    if(!email.value){
        email.classList.add('error');
    }

    if(!password.value){
        password.classList.add('error');
    }


    if(host.value && port.value && secure.value && auth.value && email.value && password.value){
        var formData = new FormData();
        formData.append('host', host.value);
        formData.append('port', port.value);
        formData.append('secure', secure.value);
        formData.append('auth', auth.value);
        formData.append('email', email.value);
        formData.append('password', password.value);

        await postFetchMultipartNoRedirect(formData, `${baseUrl}/smtp/edit.php`);
        getSMTP();
    }
}

document.querySelector("form").addEventListener("submit", editSMTP);

