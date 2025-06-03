
const inputThumb = document.querySelector('#upload');
const inputImage = document.querySelector('.upload-image');
const thumbImageText = 'Alterar/Escolher imagem';
if(inputImage != null){
    inputImage.innerHTML = thumbImageText;
    inputThumb.addEventListener('change', function(e){
        try{
            document.querySelector('.upload').style = 'display: flex';
        }
        catch{}
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
                    document.querySelector('.img-atual').style.display = 'none';
                }, 2000);
                document.querySelector('.img-atual').style.display = 'none';
                try{
                    document.querySelector('.img-atual').style.display = 'none';
                }
                catch{}
            });
            reader.readAsDataURL(file);
        }
        else{                
            inputImage.innerHTML = thumbImageText;
        }
    });
}


//edit

const inputThumbEdit = document.querySelector('#uploadEdit');
const inputImageEdit = document.querySelector('.upload-image-edit');

if(inputImageEdit != null){
    inputThumbEdit.addEventListener('change', function(e){
        const inputTarget = e.target;
        const file = inputTarget.files[0];
        if(file){
            const reader = new FileReader();
            reader.addEventListener('load', function(e){
                const readerTarget = e.target;
                const img = document.createElement('img');
                // const img = document.querySelector('.uploadEdit img');
                img.src = readerTarget.result;
                inputImageEdit.innerHTML = '';
                inputImageEdit.appendChild(img);
    
                setTimeout(function(){
                    document.querySelector('.uploadEdit .img-atual').style.display = 'none';
                }, 2000);
                document.querySelector('.uploadEdit .img-atual').style.display = 'none';
                try{
                    document.querySelector('.uploadEdit .img-atual').style.display = 'none';
                }
                catch{}
            });
            reader.readAsDataURL(file);
        }
        else{                
            inputImageEdit.innerHTML = thumbImageText;
        }
    });
}

