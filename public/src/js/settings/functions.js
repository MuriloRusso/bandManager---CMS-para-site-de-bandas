//settings

//edit

const editSettings = async (e) => {
    e.preventDefault();
    const bandName = document.querySelector('#band_name');
    const emailContact = document.querySelector('#email_contact');
    const banner = document.querySelector('#upload');
    const bannerMobile = document.querySelector('#uploadBannerMobile');
    const logo = document.querySelector('#uploadLogo');
    const favico = document.querySelector('#uploadFavico');
    const loading = document.querySelector('#uploadLoading');
    const title = document.querySelector('#title');
    const text = document.querySelector('#text');

    // cards

    //card 1
    const cardTitle1 = document.querySelector('#card-title-1');
    const cardSubTitle1 = document.querySelector('#card-sub-title-1');
    const cardText1 = document.querySelector('#card-text-1');
    const cardImg1 = document.querySelector('#card_img_1');

    //card 2
    const cardTitle2 = document.querySelector('#card-title-2');
    const cardSubTitle2 = document.querySelector('#card-sub-title-2');
    const cardText2 = document.querySelector('#card-text-2');
    const cardImg2 = document.querySelector('#card_img_2');

    //card 3
    const cardTitle3 = document.querySelector('#card-title-3');
    const cardSubTitle3 = document.querySelector('#card-sub-title-3');
    const cardText3 = document.querySelector('#card-text-3');
    const cardImg3 = document.querySelector('#card_img_3');


    //redes socias
    const facebook = document.querySelector('#facebookInput');
    const instagram = document.querySelector('#instagramInput');
    const twitter = document.querySelector('#twitterInput');
    const youtube = document.querySelector('#youtubeInput');


    cleanAlerts();

    function error(el, alertMsg){
        el.classList.add('error');
        window.scrollTo({ top: 0, behavior: 'smooth' });
        createAlert("alert-danger", alertMsg);
    }

    if(!bandName.value){
        error(bandName, "Preencha o campo Nome da Banda!");
    }
    if(!emailContact.value){
        error(emailContact, "Preencha o campo Email de Contato da Banda!");
    }
    if(!title.value){
        error(title, "Preencha o campo Titulo de Introdução!");
    }
    if(!text.value){
        error(text, "Preencha o campo Texto de Introdução!");
    }

    //card 1 

    if(!cardTitle1.value){
        error(cardTitle1, "Preencha o campo Título do card 1!");
    }

    if(!cardSubTitle1.value){
        error(cardSubTitle1, "Preencha o campo Sub-Título do card 1!");
    }

    if(!cardText1.value){
        error(cardText1, "Preencha o campo Texto do card 1!");
    }



    //card 2 

    if(!cardTitle2.value){
        error(cardTitle2, "Preencha o campo Título do card 2!");
    }

    if(!cardSubTitle2.value){
        error(cardSubTitle2, "Preencha o campo Sub-Título do card 2!");
    }

    if(!cardText2.value){
        error(cardText2, "Preencha o campo Texto do card 2!");
    }


    //card 3 

    if(!cardTitle3.value){
        error(cardTitle3, "Preencha o campo Título do card 3!");
    }

    if(!cardSubTitle3.value){
        error(cardSubTitle3, "Preencha o campo Sub-Título do card 3!");
    }

    if(!cardText3.value){
        error(cardText3, "Preencha o campo Texto do card 3!");
    }

    if(title.value && emailContact.value && text.value && bandName && 
        cardTitle1 && cardSubTitle1 && cardText1 && cardImg1 && 
        cardTitle2 && cardSubTitle2 && cardText2 && cardImg2 &&
        cardTitle3 && cardSubTitle3 && cardText3 && cardImg3){

        var formData = new FormData();
        formData.append('band_name', bandName.value);
        formData.append('email_contact', emailContact.value);
        formData.append('title', title.value);
        formData.append('text', text.value);

        formData.append('cardTitle1', cardTitle1.value);
        formData.append('cardSubTitle1', cardSubTitle1.value);
        formData.append('cardText1', cardText1.value);


        formData.append('cardTitle2', cardTitle2.value);
        formData.append('cardSubTitle2', cardSubTitle2.value);
        formData.append('cardText2', cardText2.value);


        formData.append('cardTitle3', cardTitle3.value);
        formData.append('cardSubTitle3', cardSubTitle3.value);
        formData.append('cardText3', cardText3.value);

        //redes sociais
        formData.append('facebook', facebook.value);
        formData.append('instagram', instagram.value);
        formData.append('twitter', twitter.value);
        formData.append('youtube', youtube.value);


        if(logo.files.length > 0){
            formData.append('logo', logo.files[0], logo.files[0].name);
        }
        if(favico.files.length > 0){
            formData.append('favico', favico.files[0], favico.files[0].name);
        }
        if(loading.files.length > 0){
            formData.append('loading', loading.files[0], loading.files[0].name);
        }
        if(banner.files.length > 0){
            formData.append('banner', banner.files[0], banner.files[0].name);
        }
        if(bannerMobile.files.length > 0){
            formData.append('banner_mobile', bannerMobile.files[0], bannerMobile.files[0].name);
        }

        if(cardImg1.files.length > 0){
            formData.append('card_img_1', cardImg1.files[0], cardImg1.files[0].name);
        }

        if(cardImg2.files.length > 0){
            formData.append('card_img_2', cardImg2.files[0], cardImg2.files[0].name);
        }

        if(cardImg3.files.length > 0){
            formData.append('card_img_3', cardImg3.files[0], cardImg3.files[0].name);
        }
        await postFetchMultipartNoRedirect(formData, `${baseUrl}settings/edit.php`);
        window.scrollTo({ top: 0, behavior: 'smooth' });

        document.querySelector("#logo").src = document.querySelector('.upload_logo img').src;
        document.querySelector("#loading img").src = document.querySelector('.upload_loading img').src;
        try{
            document.querySelector('#facebook').href = document.querySelector('#facebookInput').value;
        }
        catch{}

        try{
            document.querySelector('#instagram').href =  document.querySelector('#instagramInput').value;
        }
        catch{}

        try{
            document.querySelector('#twitter').href =  document.querySelector('#twitterInput').value;
        }
        catch{}     

        try{
            document.querySelector('#youtube').href =  document.querySelector('#youtubeInput').value;
        }
        catch{}
    }
}

document.querySelector('form').addEventListener('submit', editSettings);