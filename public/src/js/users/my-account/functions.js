//edit
const editMyAccount = async (e) => {
    e.preventDefault();
    const name = document.querySelector('#name');
    const username = document.querySelector('#username');
    const email = document.querySelector('#email');

    if(!name.value){
        name.classList.add('error');
    }
    if(!username.value){
        username.classList.add('error');
    }
    if(!email.value){
        email.classList.add('error');
    }
    if(name.value && username.value && email.value){
        var formData = new FormData();
        // formData.append('id', document.querySelector('#idEdit').value);
        formData.append('name', name.value);
        formData.append('username', username.value);
        formData.append('email', email.value);
        await postFetchMultipartNoRedirect(formData, `${baseUrl}users/my-account/edit.php`);
    }
}

document.querySelector("form").addEventListener("submit", editMyAccount);


async function changePassword(){
    const password = document.querySelector('#password');
    const newPassword = document.querySelector('#new-password');
    const passwordConfirm = document.querySelector('#password-confirm');

    if(!password.value){
        password.classList.add('error');
    }
    if(!newPassword.value){
        newPassword.classList.add('error');
    }
    if(!passwordConfirm.value){
        passwordConfirm.classList.add('error');
    }
    if(newPassword.value != passwordConfirm.value){
        newPassword.classList.add('error');
        passwordConfirm.classList.add('error');
        createAlert('alert-danger', "Nova senha não confere com confirmação da senha!");
    }
    if(newPassword.value.length < 6){
        newPassword.classList.add('error');
        passwordConfirm.classList.add('error');
        createAlert('alert-danger', "Nova senha precisa conter no mínimo 6 caracteres!");
    }

    if(password.value && newPassword.value && passwordConfirm.value && newPassword.value === passwordConfirm.value && newPassword.value.length > 5){
        var formData = new FormData();
        formData.append('password', password.value);
        formData.append('new-password', newPassword.value);
        await postFetchMultipartNoRedirect(formData, `${baseUrl}users/my-account/change-password.php`);
        password.value = "";
        newPassword.value = "";
        passwordConfirm.value = "";
    }
}

