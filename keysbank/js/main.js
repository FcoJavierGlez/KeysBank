/**
 * @author Francisco Javier González Sabariego
 * 
 * Este script se ejecuta en el página principal 'index.php' y sirve para controlar los inputs 
 * del formulario de login y de registro, para evitar posibles inyecciones SQL por ejemplo:
 * mira la función: functions.cleanInput(NICK_INPUT.value), la función la podrás encontrar en 
 * js/functions.js
 * 
 * Además controla que la pantalla de login se oculte tras la animación que se produce en caso de un login correcto.
 */
{
    const init = () => {
        const LOGIN_SCREEN = document.getElementById("login_screen");
        const NICK_INPUT = document.getElementsByName("nick")[0];
        const PASS_INPUT = document.getElementsByName("pswd")[0];

        NICK_INPUT.addEventListener( "keyup", () => NICK_INPUT.value = functions.cleanInput(NICK_INPUT.value) );
        NICK_INPUT.addEventListener( "copy", e => e.preventDefault() );
        NICK_INPUT.addEventListener( "paste", e => e.preventDefault() );

        PASS_INPUT.addEventListener( "keyup", () => PASS_INPUT.value = functions.cleanInput(PASS_INPUT.value) );
        PASS_INPUT.addEventListener( "copy", e => e.preventDefault() );
        PASS_INPUT.addEventListener( "paste", e => e.preventDefault() );

        if (location.href.match(/\?register$/)?.input !== undefined) {
            const REP_PASS_INPUT = document.getElementsByName("pswd2")[0];
            const EMAIL_INPUT    = document.getElementsByName("email")[0];

            REP_PASS_INPUT.addEventListener( "keyup", () => REP_PASS_INPUT.value = functions.cleanInput(REP_PASS_INPUT.value) );
            REP_PASS_INPUT.addEventListener( "copy", e => e.preventDefault() );
            REP_PASS_INPUT.addEventListener( "paste", e => e.preventDefault() );

            EMAIL_INPUT.addEventListener( "keyup", () => EMAIL_INPUT.value = functions.cleanInput(EMAIL_INPUT.value) );
        }

        LOGIN_SCREEN.addEventListener("animationend", function () {
            this.className = "hidden";
        });
    }
    document.addEventListener("DOMContentLoaded", init);
}