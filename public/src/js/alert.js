function createAlert(type, msg){
    const alert = document.createElement('div');
    alert.classList.add('alert');
    alert.classList.add(type);
    alert.innerText = msg;

    const btnClose = document.createElement('button');
    btnClose.classList.add('btn-close');
    alert.appendChild(btnClose);
    btnClose.onclick = () => {
        alert.remove();
    }


    document.querySelector('#alert-container').appendChild(alert);    
}


function cleanAlerts(){
    const alerts = document.querySelectorAll('.alert');
    for(let count = 0; count < alerts.length; count ++){
        alerts[count].remove();
    }
}