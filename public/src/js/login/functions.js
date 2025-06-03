// login
const login = async (e) => {
    e.preventDefault();
    const username = document.querySelector('#username');
    const password = document.querySelector('#password');
    if(!username.value){
        username.classList.add('error');
    }
    if(!password.value){
        password.classList.add('error');
    }
    if(username.value && password.value){
        var formData = new FormData();
        formData.append('username', username.value);
        formData.append('password', password.value);
        await postFetchMultipartLogin(formData, `${baseUrl}login.php`);
    }
}

document.getElementById("login-form").addEventListener("submit", login);
