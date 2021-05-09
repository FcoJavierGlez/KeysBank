/**
 * @author Francisco Javier González Sabariego
 * 
 * Este script sirve para controlar que no se manipula el árbol DOM a la hora de borrar un usuario. 
 * 
 * De esta forma evitamos que se pueda cambiar el id del campo oculto y borrar otro usuario
 */
document.addEventListener("DOMContentLoaded", () => {
    if (location.href.match(/users\.php\?del=(\d)+$/)?.input !== undefined) {
        const INPUT_ID_USER = document.getElementsByName("idUser")[0];
        const ID_URL = location.href.match(/(\d)+$/)[0];
        const BUTTON = document.getElementsByName("delete_user")[0];

        BUTTON.addEventListener("click", e => {
            if (INPUT_ID_USER.value !== ID_URL)
                e.preventDefault();
        });
    }
});