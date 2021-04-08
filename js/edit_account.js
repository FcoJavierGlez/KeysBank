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

    const toggleColorCheckbox = (checkbox) => {
        checkbox.parentElement.classList.toggle("text-error");
        checkbox.parentElement.classList.toggle("text-green");
    }

    const normalizeTextarea = textarea => {
        textarea.maxlength = "255";
        textarea.parentElement.nextElementSibling.nextElementSibling.innerText = `${textarea.value.length}/255`;
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (location.href.match(/accounts\.php\?edit=(\d)+$/)?.input !== undefined) {
            const CATEGORY        = document.getElementById("category");
            const PLATFORM_SELECT = [...document.getElementsByTagName("select")];
            const SPANS           = [...document.getElementsByTagName("span")];
            const NAME_ACCOUNT    = document.getElementById("name");
            const PASSWORD        = document.getElementById("pass");
            const PASS_REP        = document.getElementById("pass_rep");
            const EYE_BUTTONS     = [...document.getElementsByTagName("div")].filter( e => e.id.match(/^sh/) );/* [document.getElementById("shps"), document.getElementById("shpsr")]; */
            const USE_GENERATE    = document.getElementById("use_generate");
            const GEN_PASS_PANEL  = document.getElementById("gen_panel");
            const SPECIAL_CHAR    = document.getElementById("special_char");
            const NUMBER_CHAR     = document.getElementById("number_char");
            const GEN_PASSWORD    = document.getElementById("gen_pass");
            const SAVE_BUTTON     = document.getElementById("save");
            const TEXT_AREA       = [...document.getElementsByTagName("textarea")];

            EYE_BUTTONS.forEach( e => {
                e.addEventListener("click", function() {
                    toggleEye(e);
                    if (e.id === "shps" || e.id === "shpsr")
                        e.nextElementSibling.type = e.children[0].checked ? "text" : "password";
                    else
                        e.nextElementSibling.tagName== "INPUT" ? 
                            e.nextElementSibling.classList.toggle("hidden") : 
                            (
                                e.nextElementSibling.style.display = e.children[0].checked ? "none" : "flex",
                                e.parentElement.nextElementSibling.nextElementSibling.style.display = e.children[0].checked ? "none" : "block"
                            )
                });
            });

            NAME_ACCOUNT.addEventListener("keyup", () => {
                NAME_ACCOUNT.value = functions.cleanInput(NAME_ACCOUNT.value);
                NAME_ACCOUNT.classList = NAME_ACCOUNT.value !== "" ? "input-correct" : "required";
                SPANS[2].innerText = "";
            });

            PASSWORD.addEventListener("keyup", () => {
                PASSWORD.value = functions.cleanInput(PASSWORD.value);
                SPANS[3].className = SPANS[3].innerText = PASSWORD.value !== "" ? `${passManager.validatePasswordStrength(PASSWORD.value)}` : "";
                PASS_REP.dispatchEvent(new Event("keyup"));
            });
            PASSWORD.addEventListener("focus", () => PASS_REP.dispatchEvent(new Event("keyup")) );
            PASSWORD.addEventListener("blur", () => PASS_REP.dispatchEvent(new Event("keyup")) );
            PASSWORD.addEventListener("copy", e => e.preventDefault() );

            PASS_REP.addEventListener("keyup", () => {
                PASS_REP.value = functions.cleanInput(PASS_REP.value);
                PASS_REP.value == "" ? 
                    PASSWORD.classList = PASS_REP.classList = "required" :
                    (
                        PASSWORD.classList = PASS_REP.classList = PASS_REP.value == PASSWORD.value ? 'input-correct' : 'input-error',
                        SPANS[4].innerText = PASS_REP.value == PASSWORD.value ? '' : 'They must match'
                    );
            });
            PASS_REP.addEventListener("focus", () => PASSWORD.dispatchEvent(new Event("keyup")) );
            PASS_REP.addEventListener("blur", () => PASSWORD.dispatchEvent(new Event("keyup")) );
            PASS_REP.addEventListener("paste", e => e.preventDefault() );

            USE_GENERATE.addEventListener("click", () => {
                toggleColorCheckbox(USE_GENERATE);
                GEN_PASS_PANEL.classList.toggle("hidden");
                GEN_PASS_PANEL.classList.toggle("gen_pass");
                PASSWORD.toggleAttribute("disabled");
                PASS_REP.toggleAttribute("disabled");
            });

            SPECIAL_CHAR.addEventListener("click", () => toggleColorCheckbox(SPECIAL_CHAR) );

            NUMBER_CHAR.addEventListener("blur", () => {
                NUMBER_CHAR.min = 6;
                NUMBER_CHAR.max = 64;
                NUMBER_CHAR.value = isNaN(NUMBER_CHAR.value) || NUMBER_CHAR.value == "" ? 6 : NUMBER_CHAR.value;
                NUMBER_CHAR.value = NUMBER_CHAR.value < 6 ? 6 : NUMBER_CHAR.value > 64 ? 64 : NUMBER_CHAR.value;
            });

            GEN_PASSWORD.addEventListener("click", e => {
                e.preventDefault();
                PASS_REP.value = PASSWORD.value = passManager.genPass(NUMBER_CHAR.value, SPECIAL_CHAR.checked);
                PASSWORD.dispatchEvent(new Event("keyup"));
                PASS_REP.dispatchEvent(new Event("keyup"));
                EYE_BUTTONS.filter( e=> e.id === "shps" || e.id === "shpsr" ).forEach( e => {
                    e.children[0].checked ? e.dispatchEvent(new Event("click")) : false;
                });
            });

            SAVE_BUTTON.addEventListener("click", e => {
                //SPANS[7].innerText = "";
                try {
                    //validateForm(SELECTS, NAME_ACCOUNT, [PASSWORD,PASS_REP]);
                    PASSWORD.removeAttribute("disabled");
                    PASS_REP.removeAttribute("disabled");
                } catch (error) {
                    e.preventDefault();
                    showErrors();
                    //SPANS[7].innerText = messageFormError(error.message);
                }
            });

            NAME_ACCOUNT.dispatchEvent(new Event("keyup"));
            PASSWORD.dispatchEvent(new Event("keyup"));
            PASS_REP.dispatchEvent(new Event("keyup"));

            console.log(PLATFORM_SELECT);
            console.log(NAME_ACCOUNT);
            console.log(PASSWORD);
            console.log(PASS_REP);
            console.log(EYE_BUTTONS);
            console.log(USE_GENERATE);
            console.log(GEN_PASS_PANEL);
            console.log(SPECIAL_CHAR);
            console.log(NUMBER_CHAR);
            console.log(GEN_PASSWORD);
            console.log(SAVE_BUTTON);
            console.log(TEXT_AREA);

            CATEGORY.innerText = `${functions.normalizeOption(CATEGORY.innerText)}`;
        }
    });
}