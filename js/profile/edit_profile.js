/**
 * @author Francisco Javier González Sabariego
 * 
 * Este script se emplea en la vista edit de la página profile.
 * 
 * El objetivo de éste script es controlar que no se inserten espacios o caracteres
 * especiales en el nick y que, el número de días para el mensaje de contraseña antigua, no
 * sean inferiores a 30 días ni excedan los 365.
 * 
 * En esta vista el usuario podrá editar los datos de su cuenta de la propia app, 
 * pudiendo editar: nick, email, nombre, apellido y/o configuración de la app.
 */
{
    const editProfile = inputNick => {
        const NAME     = document.getElementById("name");
        const SURNAME  = document.getElementById("surname");
        const DAYS     = document.getElementById("days_old_password");

        DAYS.min = 30;
        DAYS.max = 365;

        inputNick.addEventListener("paste", e => e.preventDefault() );
        NAME.addEventListener("paste", e => e.preventDefault() );
        SURNAME.addEventListener("paste", e => e.preventDefault() );
        DAYS.addEventListener("paste", e => e.preventDefault() );

        inputNick.addEventListener("keyup", () => inputNick.value = functions.cleanInput(inputNick.value) );
        DAYS.addEventListener("keyup", () => {
            DAYS.min = 30;
            DAYS.max = 365;
        });
        DAYS.addEventListener("blur", () => {
            DAYS.min = 30;
            DAYS.max = 365;
            DAYS.value = DAYS.value > 365 ? 365 : DAYS.value;
            DAYS.value = DAYS.value < 30 ? 30 : DAYS.value;
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (location.href.match(/profile\.php(\?edit)?$/)?.input !== undefined) {
            const NICK     = document.getElementById("nick");
            const HIDDEN   = document.querySelector("input[type='hidden']");
            const PASSWORD_STRENGTH = document.getElementById("password_strength");
            
            let strongPassword = passManager.validatePasswordStrength( HIDDEN.value, [NICK.tagName == 'DIV' ? NICK.innerHTML : NICK.value] );
            
            document.getElementsByClassName("container-data")[0].removeChild(HIDDEN);
    
            PASSWORD_STRENGTH.innerText = `Your password is ${strongPassword}`;
            PASSWORD_STRENGTH.classList = `${strongPassword}`;
    
            if (location.href.match(/profile\.php\?edit$/)?.input !== undefined) 
                editProfile(NICK);
        }
    });
}