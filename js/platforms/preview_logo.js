/**
 * @author Francisco Javier González Sabariego
 */
 {
    const FILE_TYPES = [
        "image/png",
        //"image/gif",
        //"image/jpeg",
        //"image/webp",
    ];
    
    const validFileType = file => FILE_TYPES.includes(file.type);

    const  returnFileSize = number => {
        if(number < 1024) {
            return number + 'bytes';
        } 
        else if(number >= 1024 && number < 1048576) {
            return (number/1024).toFixed(1) + 'KB';
        } 
        else if(number >= 1048576) {
            return (number/1048576).toFixed(1) + 'MB';
        }
      }

    document.addEventListener("DOMContentLoaded", () => {
        if (location.href.match(/platforms\.php\?(add|edit=(\d+))$/)?.input !== undefined) {
            const INPUT         = document.querySelector('input[type=file]');
            const MAX_SIZE      = document.querySelector('input[type=hidden]').value;
            const IMAGE_PREVIEW = document.querySelector('.preview');
            const DIV_ERROR     = document.getElementById("error");
    
            const updateImageDisplay = function() {
                while(IMAGE_PREVIEW.firstChild) {
                    IMAGE_PREVIEW.removeChild(IMAGE_PREVIEW.firstChild);
                }
              
                const curFiles = INPUT.files;
                if(curFiles.length === 0) {
                    const paragraph = document.createElement('p');
                    
                    paragraph.textContent = 'No files currently selected for upload';
                    IMAGE_PREVIEW.appendChild(paragraph);
                } else {
                    const DIV_CONTAINER = document.createElement('div');
                    DIV_CONTAINER.classList = 'preview_logo';
                    IMAGE_PREVIEW.appendChild(DIV_CONTAINER);
                
                    for(const file of curFiles) {
                        const paragraph = document.createElement('p');
                        if( validFileType(file) ) {
                            paragraph.textContent = `File name ${file.name}, file size ${returnFileSize(file.size)}.`;
                            const image = document.createElement('img');
                            image.src   = URL.createObjectURL(file);
    
                            DIV_ERROR.innerText = file.size > MAX_SIZE ? 
                                'This photo will not be uploaded because its size is too larger than 50KB' :
                                "";
                            DIV_ERROR.classList = file.size > MAX_SIZE ? 
                                'alert' :
                                '';
                    
                            DIV_CONTAINER.appendChild(image);
                            DIV_CONTAINER.appendChild(paragraph);
                        } else {
                            paragraph.textContent = `File name ${file.name}: Not a valid file type. Update your selection.`;
                            DIV_CONTAINER.appendChild(paragraph);
                        }
                    }
                }
            }
    
            INPUT.addEventListener('change', updateImageDisplay);
        }
    });
}