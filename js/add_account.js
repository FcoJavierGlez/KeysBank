/**
 * @author Francisco Javier González Sabariego
 */
 {
    /**
     * 
     * @param {*} eye 
     */
    const toggleEye = function (eye){
        eye.children[0].checked = !eye.children[0].checked;
        eye.classList.toggle("eye");
        eye.classList.toggle("eye_slash");
    }

    const adjustNumberChar = () => {
        
    }

    const init = () => {
        if (location.href.match(/accounts\.php\?add$/)?.input !== undefined) {
            //const FORM          = document.getElementById("form-add");
            const CATEGORIES     = document.getElementById("categories");
            const SUBCATEGORIES  = document.getElementById("subcategories");
            const NAME_ACCOUNT   = document.getElementById("name");
            const PASSWORD       = document.getElementById("pass");
            const PASS_REP       = document.getElementById("pass_rep");
            const PASS_STR       = document.getElementById("strong_password");
            const EYE_BUTTONS    = [document.getElementById("shps"), document.getElementById("shpsr")];
            const USE_GENERATE   = document.getElementById("use_generate");
            const GEN_PASS_PANEL = document.getElementById("gen_panel");
            const SPECIAL_CHAR   = document.getElementById("special_char");
            const NUMBER_CHAR    = document.getElementById("number_char");
            const GEN_PASSWORD   = document.getElementById("gen_pass");

            EYE_BUTTONS.forEach( e => {
                e.addEventListener("click", function() {
                    toggleEye(e);
                    e.nextElementSibling.type = e.children[0].checked ? "text" : "password";
                });
            });

            PASSWORD.addEventListener("keyup", () => {
                PASSWORD.value = cleanInput(PASSWORD.value);
                PASS_STR.innerText = PASSWORD.value !== "" ? `${validatePasswordStrength(PASSWORD.value)}` : "";
                PASS_STR.className = `${validatePasswordStrength(PASSWORD.value)}`;
            });
            PASSWORD.addEventListener("copy", e => {
                e.preventDefault();
            });

            PASS_REP.addEventListener("keyup", () => {
                PASS_REP.value = cleanInput(PASS_REP.value);
                PASS_REP.value == "" ? 
                    PASSWORD.classList = PASS_REP.classList = "" :
                    PASSWORD.classList = PASS_REP.classList = PASS_REP.value == PASSWORD.value ? 'input-correct' : 'input-error';
            });
            PASS_REP.addEventListener("paste", e => {
                e.preventDefault();
            });

            USE_GENERATE.addEventListener("click", () => {
                USE_GENERATE.parentElement.classList.toggle("text-error");
                USE_GENERATE.parentElement.classList.toggle("text-green");
                GEN_PASS_PANEL.classList.toggle("hidden");
                GEN_PASS_PANEL.classList.toggle("gen_pass");
            });

            SPECIAL_CHAR.addEventListener("click", () => {
                SPECIAL_CHAR.parentElement.classList.toggle("text-error");
                SPECIAL_CHAR.parentElement.classList.toggle("text-green");
            });

            NUMBER_CHAR.addEventListener("blur", () => {
                NUMBER_CHAR.min = 8;
                NUMBER_CHAR.max = 64;
                NUMBER_CHAR.value = isNaN(NUMBER_CHAR.value) || NUMBER_CHAR.value == "" ? 8 : NUMBER_CHAR.value;
                NUMBER_CHAR.value = NUMBER_CHAR.value < 8 ? 8 : NUMBER_CHAR.value > 64 ? 64 : NUMBER_CHAR.value;
            });

            GEN_PASSWORD.addEventListener("click", e => {
                e.preventDefault();
                PASS_REP.value = PASSWORD.value = genPass(NUMBER_CHAR.value, SPECIAL_CHAR.checked);
                PASSWORD.dispatchEvent(new Event("keyup"));
                PASS_REP.dispatchEvent(new Event("keyup"));
                EYE_BUTTONS.forEach( e => {
                    e.children[0].checked ? e.dispatchEvent(new Event("click")) : false;
                });
            });

        }
        
    }

    document.addEventListener("DOMContentLoaded", init);
}