/**
 * @author Francisco Javier González Sabariego
 * 
 * Este script sirve para validar el formulario de añadir y de editar plataformas.
 * 
 * Para evitar errores en la consola por cargar elementos no existentes en una vista u otra (add | edit)
 * al momento de cargar el script se evalua con una expresión regular la URL y dependiendo de si estamos en
 * la vista de agregar una plataforma (add) o de editarla (edit) se cargarán unos elementos específicos u otros.
 * 
 * Si el formulario es válido se enviarán los datos al servidor, de lo contrario el formulario no enviará nada y 
 * mostrará un mensaje de error.
 */
 {
    const init = () => {
        if (location.href.match(/platforms\.php\?(add|edit=(\d+))$/)?.input !== undefined) {
            const SUBCATEGORY   = document.getElementById("subcategories");
            const MESSAGE_ERROR = document.getElementById("message_error");
            const NAME = document.getElementById("name");
            const SEND = document.getElementById("send");

            let category = undefined;
            let idHidden = undefined;

            if (location.href.match(/platforms\.php\?add$/)?.input !== undefined) {
                category = document.getElementById("categories");
            }

            if (location.href.match(/platforms\.php\?edit=(\d+)$/)?.input !== undefined) {
                idHidden = document.getElementsByName("id")[0].value;
            }

            const validateFormAdd = () => category.value !== '' && SUBCATEGORY.value !== '' && NAME.value !== '';

            const validateFormEdit = () => {
                let {idPlatform} = location.href.match(/platforms\.php\?edit=(?<idPlatform>\d+)$/)?.groups;
                return SUBCATEGORY.value !== '' && NAME.value !== '' && idHidden == idPlatform;
            }

            SEND.addEventListener("click", e => {
                NAME.value = NAME.value.replace(/\s+/g," ").trim();
                MESSAGE_ERROR.classList.remove("alert");
                MESSAGE_ERROR.innerText = "";

                if (location.href.match(/platforms\.php\?add$/)?.input !== undefined) {
                    if ( !validateFormAdd() ) {
                        e.preventDefault();
                        MESSAGE_ERROR.classList.add("alert");
                        MESSAGE_ERROR.innerText = "You must complete all the required fields";
                    }
                }
                else 
                    if ( !validateFormEdit() ) {
                        e.preventDefault();
                        MESSAGE_ERROR.classList.add("alert");
                        MESSAGE_ERROR.innerText = "You must complete all the required fields";
                    }
            });
        }
    }

    document.addEventListener("DOMContentLoaded", init);
}