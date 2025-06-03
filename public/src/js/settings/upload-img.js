const inputThumb = document.querySelector('#upload');
        const inputImage = document.querySelector('.upload_banner');
        const thumbImageText = 'Alterar/Escolher imagem';
        inputThumb.addEventListener('change', function(e){
            const inputTarget = e.target;
            const file = inputTarget.files[0];
            if(file){
                const reader = new FileReader();
                reader.addEventListener('load', function(e){
                    const readerTarget = e.target;
                    const img = document.createElement('img');
                    img.src = readerTarget.result;
                    inputImage.innerHTML = '';
                    inputImage.appendChild(img);
                    setTimeout(function(){
                        document.querySelector('.banner-atual').style.display = 'none';
                    }, 2000);
                    document.querySelector('.banner-atual').style.display = 'none';
                    try{
                        document.querySelector('.banner-atual').style.display = 'none';
                    }
                    catch{}
                });
                reader.readAsDataURL(file);
            }
            else{                
                inputImage.innerHTML = thumbImageText;
            }
        });

        // banner mobile

        const inputThumbBannerMobile = document.querySelector('#uploadBannerMobile');
        const inputImageBannerMobile = document.querySelector('.upload_banner_mobile');
        // const thumbImageText = 'Alterar/Escolher imagem';
        inputThumbBannerMobile.addEventListener('change', function(e){
            const inputTarget = e.target;
            const file = inputTarget.files[0];
            if(file){
                const reader = new FileReader();
                reader.addEventListener('load', function(e){
                    const readerTarget = e.target;
                    const img = document.createElement('img');
                    img.src = readerTarget.result;
                    inputImageBannerMobile.innerHTML = '';
                    inputImageBannerMobile.appendChild(img);
                    setTimeout(function(){
                        document.querySelector('.banner-mobile-atual').style.display = 'none';
                    }, 2000);
                    document.querySelector('.banner-mobile-atual').style.display = 'none';
                    try{
                        document.querySelector('.banner-mobile-atual').style.display = 'none';
                    }
                    catch{}
                });
                reader.readAsDataURL(file);
            }
            else{                
                inputThumbBannerMobile.innerHTML = thumbImageText;
            }
        });


        // logo

        const inputThumbLogo = document.querySelector('#uploadLogo');
        const inputImageLogo = document.querySelector('.upload_logo');
        inputThumbLogo.addEventListener('change', function(e){
            const inputTarget = e.target;
            const file = inputTarget.files[0];
            if(file){
                const reader = new FileReader();
                reader.addEventListener('load', function(e){
                    const readerTarget = e.target;
                    const img = document.createElement('img');
                    img.src = readerTarget.result;
                    inputImageLogo.innerHTML = '';
                    inputImageLogo.appendChild(img);
                    setTimeout(function(){
                        document.querySelector('.logo-atual').style.display = 'none';
                    }, 2000);
                    document.querySelector('.logo-atual').style.display = 'none';
                    try{
                        document.querySelector('.logo-atual').style.display = 'none';
                    }
                    catch{}
                });
                reader.readAsDataURL(file);
            }
            else{                
                inputImageLogo.innerHTML = thumbImageText;
            }
        });


        // favico

        const inputThumbFavico = document.querySelector('#uploadFavico');
        const inputImageFavico = document.querySelector('.upload_favico');
        // const thumbImageText = 'Alterar/Escolher imagem';
        inputThumbFavico.addEventListener('change', function(e){
            const inputTarget = e.target;
            const file = inputTarget.files[0];
            if(file){
                const reader = new FileReader();
                reader.addEventListener('load', function(e){
                    const readerTarget = e.target;
                    const img = document.createElement('img');
                    img.src = readerTarget.result;
                    inputImageFavico.innerHTML = '';
                    inputImageFavico.appendChild(img);
                    setTimeout(function(){
                        document.querySelector('.favico-atual').style.display = 'none';
                    }, 2000);
                    document.querySelector('.favico-atual').style.display = 'none';
                    try{
                        document.querySelector('.favico-atual').style.display = 'none';
                    }
                    catch{}
                });
                reader.readAsDataURL(file);
            }
            else{                
                inputThumbFavico.innerHTML = thumbImageText;
            }
        });


        // loading

        const inputThumbLoading = document.querySelector('#uploadLoading');
        const inputImageLoading = document.querySelector('.upload_loading');
        inputThumbLoading.addEventListener('change', function(e){
            const inputTarget = e.target;
            const file = inputTarget.files[0];
            if(file){
                const reader = new FileReader();
                reader.addEventListener('load', function(e){
                    const readerTarget = e.target;
                    const img = document.createElement('img');
                    img.src = readerTarget.result;
                    inputImageLoading.innerHTML = '';
                    inputImageLoading.appendChild(img);
                    setTimeout(function(){
                        document.querySelector('.loading-atual').style.display = 'none';
                    }, 2000);
                    document.querySelector('.loading-atual').style.display = 'none';
                    try{
                        document.querySelector('.loading-atual').style.display = 'none';
                    }
                    catch{}
                });
                reader.readAsDataURL(file);
            }
            else{                
                inputThumbLoading.innerHTML = thumbImageText;
            }
        });

        // card 1

        const inputThumbCard1 = document.querySelector('#card_img_1');
        const inputImageCard1 = document.querySelector('.upload_card_img_1');
        inputThumbCard1.addEventListener('change', function(e){
            const inputTarget = e.target;
            const file = inputTarget.files[0];
            if(file){
                const reader = new FileReader();
                reader.addEventListener('load', function(e){
                    const readerTarget = e.target;
                    const img = document.createElement('img');
                    img.src = readerTarget.result;
                    inputImageCard1.innerHTML = '';
                    inputImageCard1.appendChild(img);
                    setTimeout(function(){
                        document.querySelector('.card_img_1_atual').style.display = 'none';
                    }, 2000);
                    document.querySelector('.card_img_1_atual').style.display = 'none';
                    try{
                        document.querySelector('.card_img_1_atual').style.display = 'none';
                    }
                    catch{}
                });
                reader.readAsDataURL(file);
            }
            else{                
                inputThumbCard1.innerHTML = thumbImageText;
            }
        });


        // card 2

        const inputThumbCard2 = document.querySelector('#card_img_2');
        const inputImageCard2 = document.querySelector('.upload_card_img_2');
        inputThumbCard2.addEventListener('change', function(e){
            const inputTarget = e.target;
            const file = inputTarget.files[0];
            if(file){
                const reader = new FileReader();
                reader.addEventListener('load', function(e){
                    const readerTarget = e.target;
                    const img = document.createElement('img');
                    img.src = readerTarget.result;
                    inputImageCard2.innerHTML = '';
                    inputImageCard2.appendChild(img);
                    setTimeout(function(){
                        document.querySelector('.card_img_2_atual').style.display = 'none';
                    }, 2000);
                    document.querySelector('.card_img_2_atual').style.display = 'none';
                    try{
                        document.querySelector('.card_img_2_atual').style.display = 'none';
                    }
                    catch{}
                });
                reader.readAsDataURL(file);
            }
            else{                
                inputThumbCard2.innerHTML = thumbImageText;
            }
        });


        // card 3

        const inputThumbCard3 = document.querySelector('#card_img_3');
        const inputImageCard3 = document.querySelector('.upload_card_img_3');
        inputThumbCard3.addEventListener('change', function(e){
            const inputTarget = e.target;
            const file = inputTarget.files[0];
            if(file){
                const reader = new FileReader();
                reader.addEventListener('load', function(e){
                    const readerTarget = e.target;
                    const img = document.createElement('img');
                    img.src = readerTarget.result;
                    inputImageCard3.innerHTML = '';
                    inputImageCard3.appendChild(img);
                    setTimeout(function(){
                        document.querySelector('.card_img_3_atual').style.display = 'none';
                    }, 2000);
                    document.querySelector('.card_img_3_atual').style.display = 'none';
                    try{
                        document.querySelector('.card_img_3_atual').style.display = 'none';
                    }
                    catch{}
                });
                reader.readAsDataURL(file);
            }
            else{                
                inputThumbCard3.innerHTML = thumbImageText;
            }
        });