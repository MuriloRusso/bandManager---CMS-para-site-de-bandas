
// change-password
const changePassword = async (e) => {
    e.preventDefault();
    const password = document.querySelector('#password');
    const newPassword = document.querySelector('#new-password');
    const passwordConfirm = document.querySelector('#password-confirm');

    if(!password.value){
        password.classList.add('error');
        createAlert('alert-danger', 'Preencha o campo Senha Atual');

    }
    if(!newPassword.value){
        newPassword.classList.add('error');
        createAlert('alert-danger', 'Preencha o campo Senha Nova');

    }
    if(!passwordConfirm.value){
        passwordConfirm.classList.add('error');
        createAlert('alert-danger', 'Preencha o campo de Conformação da Senha Nova');

    }
    if(newPassword.value != passwordConfirm.value){
        newPassword.classList.add('error');
        passwordConfirm.classList.add('error');
        createAlert('alert-danger', 'Nova senha e confirmação são diferentes');
    }

    if(password.value && newPassword.value && passwordConfirm.value && newPassword.value === passwordConfirm.value){
        var formData = new FormData();
        formData.append('password', password.value);
        formData.append('new-password', newPassword.value);
        await postFetchMultipartNoRedirect(formData, `${baseUrl}/users/my-account/change-password.php`);
    }
}

document.querySelector("form").addEventListener("submit", changePassword);
