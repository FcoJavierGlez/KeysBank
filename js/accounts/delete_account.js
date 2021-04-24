/**
 * @author Francisco Javier González Sabariego
 * 
 * Este script sirve para controlar que no se manipula el árbol DOM a la hora de borrar una cuenta. 
 * 
 * De esta forma evitamos que el usuario pueda cambiar el id del campo oculto y borrar otra cuenta (aunque sea de su propiedad)
 */
document.addEventListener("DOMContentLoaded", () => {
    if (location.href.match(/accounts\.php\?del=(\d)+$/)?.input !== undefined) {
        const INPUT_ID_ACCOUNT = document.getElementsByName("id_account")[0];
        const ID_URL = location.href.match(/(\d)+$/)[0];
        const BUTTON = document.getElementsByName("delete_account")[0];

        BUTTON.addEventListener("click", e => {
            if (INPUT_ID_ACCOUNT.value !== ID_URL)
                e.preventDefault();
        });
    }
});