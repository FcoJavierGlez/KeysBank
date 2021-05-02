/**
 * @author Francisco Javier González Sabariego
 * 
 * Este script se emplea en la vista edit_password de la página profile.
 * 
 * El objetivo de éste script es controlar que la nueva contraseña es exactamente
 * la que ha escrito el usuario y que la vieja contraseña no coincide con la nueva.
 * 
 * En esta vista el usuario podrá editar la contraseña de su cuenta de la propia app.
 */
 {
    document.addEventListener("DOMContentLoaded", () => {
        if (location.href.match(/profile\.php(\?edit_password)?$/)?.input !== undefined) {
            const OLD_PASS  = document.getElementById("old_pass");
            const NEW_PASS  = document.getElementById("new_pass");
            const NEW_PASS2 = document.getElementById("new_pass2");
            const ALERT     = document.getElementById("alert");
            const HIDDEN    = document.querySelector("input[type='hidden']");
            const BUTTON    = document.getElementsByName("update_password")[0];
            const PASSWORD_STRENGTH = document.getElementById("password_strength");

            let userNick = HIDDEN.value;
            
            document.getElementsByClassName("container-data")[0].removeChild(HIDDEN);

            NEW_PASS.classList = NEW_PASS2.classList = NEW_PASS.value == '' ? '' : NEW_PASS.value !== NEW_PASS2.value ? 'input-error' : 'input-correct';
            PASSWORD_STRENGTH.classList = PASSWORD_STRENGTH.innerText = NEW_PASS.value !== '' ? passManager.validatePasswordStrength( NEW_PASS.value, [userNick] ) : '';

            OLD_PASS.addEventListener( "keyup", () => OLD_PASS.value = functions.cleanInput(OLD_PASS.value) );
            NEW_PASS.addEventListener( "keyup", () => OLD_PASS.value = functions.cleanInput(OLD_PASS.value) );
            NEW_PASS2.addEventListener( "keyup", () => OLD_PASS.value = functions.cleanInput(OLD_PASS.value) );

            OLD_PASS.addEventListener( "copy", e => e.preventDefault() );
            NEW_PASS.addEventListener( "copy", e => e.preventDefault() );
            NEW_PASS2.addEventListener( "copy", e => e.preventDefault() );

            OLD_PASS.addEventListener( "paste", e => e.preventDefault() );
            NEW_PASS.addEventListener( "paste", e => e.preventDefault() );
            NEW_PASS2.addEventListener( "paste", e => e.preventDefault() );

            OLD_PASS.addEventListener( "keyup", () => OLD_PASS.classList.remove('input-error') );
            NEW_PASS.addEventListener( "keyup", () => PASSWORD_STRENGTH.classList = PASSWORD_STRENGTH.innerText = passManager.validatePasswordStrength( NEW_PASS.value, [userNick] ) );
            NEW_PASS2.addEventListener( "keyup", () => {
                NEW_PASS.classList = NEW_PASS2.classList = NEW_PASS.value !== NEW_PASS2.value ? 'input-error' : 'input-correct';
                ALERT.innerText = NEW_PASS.value == '' ? 'New password required' : NEW_PASS.value !== NEW_PASS2.value ? 'Passwords must match' : '';
            } );

            BUTTON.addEventListener("click", e => {
                if ( OLD_PASS.value == "" ) {
                    OLD_PASS.classList = 'input-error';
                    ALERT.innerText = 'Old password required';
                    e.preventDefault();
                    return;
                }
                else if ( NEW_PASS.value == "" || NEW_PASS.value !== NEW_PASS2.value ) {
                    NEW_PASS.classList = NEW_PASS2.classList = NEW_PASS.value == '' ? 'input-error' : NEW_PASS.value !== NEW_PASS2.value ? 'input-error' : 'input-correct';
                    ALERT.innerText = NEW_PASS.value == '' ? 'New password required' : NEW_PASS.value !== NEW_PASS2.value ? 'Passwords must match' : '';
                    e.preventDefault();
                    return;
                }
            });
        }
    });
}