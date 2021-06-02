/**
 * @author Francisco Javier González Sabariego
 * 
 * Este script sirve para controlar que no se manipula el árbol DOM a la hora de borrar una plataforma. 
 * 
 * De esta forma evitamos que se pueda cambiar el id del campo oculto y borrar otra plataforma
 */
document.addEventListener("DOMContentLoaded", () => {
    if (location.href.match(/platforms\.php\?del=(\d)+$/)?.input !== undefined) {
        const INPUT_ID_USER = document.getElementsByName("idPlatform")[0];
        const ID_URL = location.href.match(/(\d)+$/)[0];
        const BUTTON = document.getElementsByName("delete_platform")[0];

        BUTTON.addEventListener("click", e => {
            if (INPUT_ID_USER.value !== ID_URL)
                e.preventDefault();
        });
    }
});