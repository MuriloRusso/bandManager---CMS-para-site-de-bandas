

// users

//get
async function getUser(){
    toggleLoading();
    fetch(`${baseUrl}/users/get.php`)
    .then((response) => {
        response.json().then((data) => {
            if(response.status === 200){
                let users = data;
                document.querySelector('#list').innerHTML = '';
                for(let count = 0; count < users.length; count++){
                    let content = `
                        <h2 class="text-uppercase py-2 mb-0 color-white">${users[count].name}</h2>
                        <p class="color-white m-0">Nome de Usuário:</p>
                        <p class="color-white">${users[count].username}</p>
                        <p class="color-white m-0">E-mail:</p>
                        <p class="color-white">${users[count].email}</p>
                    `;
                    if(users[count].id != session.id){
                        console.log(users[count].id_hierarchy);
                        if(users[count].id_hierarchy == 1){
                            content += `
                                <div>
                                    <p class="text-danger">Administrador Master</p>
                                </div>
                            `;
                        }
                        else{
                            content += `
                                <div class="py-3">
                                    <a href="#" onclick="handleEdit(${users[count].id})" class="btn btn-edit">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    <a href="#" onclick="handleDelete(${users[count].id}, '${users[count].name}')" class="btn btn-delete">
                                        <i class="fa-sharp fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            `;
                        }
                    }
                    else{
                        content += `
                            <div class="py-3">
                                <a class="btn-primary" href="my-account.php">Minha Conta</a>
                            </div>
                        `;
                    }
                    document.querySelector('#list').innerHTML += `<div class="user my-5">${content}</div>`;
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
getUser();


//new
const newUser = async (e) => {
    e.preventDefault();
    const name = document.querySelector('#name');
    const username = document.querySelector('#username');
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');
    const passwordConfirm = document.querySelector('#password-confirm');

    if(!name.value){
        name.classList.add('error');
    }
    if(!username.value){
        username.classList.add('error');
    }
    if(!email.value){
        email.classList.add('error');
    }
    if(!password.value){
        password.classList.add('error');
    }
    if(!passwordConfirm.value){
        passwordConfirm.classList.add('error');
    }
    if(password.value != passwordConfirm.value){
        password.classList.add('error');
        passwordConfirm.classList.add('error');
    }

    if(name.value && username.value && email.value && password.value && passwordConfirm.value && password.value === passwordConfirm.value){
        var formData = new FormData();
        formData.append('name', name.value);
        formData.append('username', username.value);
        formData.append('email', email.value);
        formData.append('password', password.value);
        // await postFetchMultipart(formData, `${baseUrl}users/new.php`, 'new', 'users.php');
        await postFetchMultipartNoRedirect(formData, `${baseUrl}users/new.php`);
        getUser();
    }
}

document.querySelector(".modal-new form").addEventListener("submit", newUser);



//edit
const editUser = async (e) => {
    e.preventDefault();
    const name = document.querySelector('#nameEdit');
    const username = document.querySelector('#usernameEdit');
    const email = document.querySelector('#emailEdit');

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
        formData.append('id', document.querySelector('#idEdit').value);
        formData.append('name', name.value);
        formData.append('username', username.value);
        formData.append('email', email.value);
        await postFetchMultipartNoRedirect(formData, `${baseUrl}users/edit.php`);
        getUser();
    }
}

document.querySelector(".modal-edit form").addEventListener("submit", editUser);


//delete
async function deleteUser(api){
    deleteItem2(api);
    getUser();
}


//handleEdit

const modalEdit = document.querySelector('.modal-edit');
const closeModalEdit = document.querySelector('.close-modal-edit');

closeModalEdit.onclick = () => {
    modalEdit.classList.remove('opened');
}
async function handleEdit(id){
    toggleLoading();
    fetch(`adm/api/users/getById.php?id=${id}`, {
        method: 'GET',
    })
    .then((response) => {

        response.json().then((data) => {
            if(response.status === 200){
                modalEdit.classList.add('opened');
                document.querySelector('#idEdit').value = data.id;
                document.querySelector('#nameEdit').value = data.name;
                document.querySelector('#usernameEdit').value = data.username;
                document.querySelector('#emailEdit').value = data.email;
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