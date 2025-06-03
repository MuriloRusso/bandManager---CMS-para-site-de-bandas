const inputName = document.querySelector('[name="name"]');
const inputEmail = document.querySelector('[name="email"]');
const inputPhone = document.querySelector('[name="phone"]');
const inputMsg = document.querySelector('#msg');


const sendMsg = async (e) => {
    e.preventDefault();
    if(!inputName.value){
        inputName.classList.add('error');
    }
    if(!inputEmail.value){
        inputEmail.classList.add('error');
    }
    if(!inputPhone.value){
        inputPhone.classList.add('error');
    }
    if(!inputMsg.value){
        inputMsg.classList.add('error');
    }
    if(inputName.value && inputEmail.value && inputPhone.value && inputMsg.value){
        var formData = new FormData();
        formData.append('name', inputName.value);
        formData.append('email', inputEmail.value);
        formData.append('telephone', inputPhone.value);
        formData.append('msg', inputMsg.value);
        toggleLoading();
        let myResponse = fetch(`${baseUrl}/contact/new.php`, {
            method: 'POST',
            body: formData,
        })
        .then((response) => {
            response.json().then((data) => {
                if(response.status === 200){
                    toggleLoading();
                    createAlert("alert-success", data.message)
                    document.querySelector('form').reset();
                }
                else if(response.status === 401){
                    toggleLoading();
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
}

document.querySelector("form").addEventListener("submit", sendMsg);
