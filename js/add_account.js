/**
 * @author Francisco Javier González Sabariego
 * 
 * Formulario añadir cuenta.
 */
 {
    /**
     * Commuta el estado que renderiza el botón del ojo y 
     * activa/desactiva el checkbox que tiene oculto por hijo.
     * 
     * @param {Element} eye Elemento del árbol DOM
     */
    const toggleEye = function (eye){
        eye.children[0].checked = !eye.children[0].checked;
        eye.classList.toggle("eye");
        eye.classList.toggle("eye_slash");
    }

    /**
     * Cambiar el color del texto asociado a un checkbox.
     * 
     * @param {Element} checkbox Elemento DOM (checkbox)
     */
    const toggleColorCheckbox = (checkbox) => {
        checkbox.parentElement.classList.toggle("text-error");
        checkbox.parentElement.classList.toggle("text-green");
    }

    /**
     * Normaliza la longitud del textarea pasado por parámetro y 
     * actualiza el contador de caracteres asociado a él.
     * 
     * @param {Element} textarea Elemento DOM (textarea) a normalizar.
     */
    const normalizeTextarea = textarea => {
        textarea.maxlength = "255";
        textarea.parentElement.nextElementSibling.nextElementSibling.innerText = `${textarea.value.length}/255`;
    }

    /**
     * Valida los selectores del formulario
     * 
     * @param {Array} selects Array con la lista de selectores del árbol DOM
     * @returns {Boolean}     True si los selectores son válidos (en caso de no serlos lanzará un excepción) 
     */
    const validateSelects = selects => {
        let numCategories  = [...selects[0].getElementsByTagName("option")].length;
        let optionCategory = [...selects[0].getElementsByTagName("option")].find( e => e.selected ).value;
        let optionPlatform = [...selects[1].getElementsByTagName("option")].find( e => e.selected ).value;
        if (optionCategory === "" || isNaN(optionCategory) || (optionCategory < 1 && optionCategory > numCategories) || optionPlatform === "") 
            throw new Error('selectors')
        return true;
    }

    /**
     * Valida el nombre de la cuenta
     * 
     * @param {Element} name Elemento (input) del nombre de cuenta
     * @returns {Boolean}    True si el nombre es válido (en caso de no serlo lanzará un excepción)
     */
    const validateNameAccount = name => {
        if (name.value == "")
            throw new Error('name_account_req');
        else if (name.value !== functions.cleanInput(name.value))
            throw new Error('name_account_incorrect');
        return  true;
    };

    /**
     * Valida la contraseña de la cuenta
     * 
     * @param {Array} passwords Array con el elemento DOM de la contraseña y la contraseña repetida 
     * @returns {Boolean}       True si la contraseña es válida (en caso de no serlo lanzará un excepción)
     */
    const validatePasswords = passwords => {
        let password = passwords[0].value;
        let passwordRep = passwords[1].value;
        if (password === "")
            throw new Error('password_req');
        /* else if (passManager.checkDangerousPassword(password))
            throw new Error('password_dang'); */
        else if (password !== passwordRep)
            throw new Error('passwords_must_match');
        return true;
    }

    /**
     * Valida el formulario. En caso de que no sea válido la validación donde falle lanzará una excepción.
     * 
     * @param {Array} selects       Array con la lista de selectores del árbol DOM
     * @param {Element} nameAccount Elemento (input) del nombre de cuenta
     * @param {Array} passwords     Array con el elemento DOM de la contraseña y la contraseña repetida
     * @returns {Boolean}           True si es válido
     */
    const validateForm = (selects, nameAccount, passwords) => {
        return validateSelects(selects) && validateNameAccount(nameAccount) && validatePasswords(passwords);
    }

    /**
     * Muestra el mensaje de error del formulario
     * 
     * @param {String} messageError Mensaje del error capturado
     * @returns {String}            Mensaje de error que se mostrará al usuario
     */
    const messageFormError = messageError => {
        switch (messageError) {
            case 'selectors':
                return 'incorrect selectors';
            case 'name_account_req':
                return 'name account required';
            case 'name_account_incorrect':
                return 'invalid name account';
            case 'password_req':
                return 'password required';
            case 'password_dang':
                return 'dangerous password';
            case 'passwords_must_match':
                return 'passwords must match';
        }
    }

    /**
     * Devuelve una template string con enlaces de las cuentas con el nombre de cuenta del usuario repetidas
     * 
     * @param {Array} info Array con el conjunto de cuentas cuyo nombre de cuenta está repetido.
     * @returns {String}   Template string con la lista de cuentas repetidas
     */
    const printAccountsNameRepeat = info => {
        let string = "";
        info.forEach( e => string += `<a href="./accounts.php?view=${e.id}" class="account_used" target="_blank"><div>${Object.values(e)[1]}</div><div>${Object.values(e)[2]}</div></a>` );
        return string;
    }

    const init = () => {
        if (location.href.match(/accounts\.php\?add$/)?.input !== undefined) {
            const FORM  = document.getElementById("form-add");
            const SPANS = [...document.getElementsByTagName("span")];
            const SELECTS = [...document.getElementsByTagName("select")];
            const NAME_ACCOUNT   = document.getElementById("name");
            const NAME_REPEAT    = document.getElementById("acc_name_rep");
            const PASSWORD       = document.getElementById("pass");
            const PASS_REP       = document.getElementById("pass_rep");
            const EYE_BUTTONS    = [...document.getElementsByTagName("div")].filter( e => e.id.match(/^sh/) );/* [document.getElementById("shps"), document.getElementById("shpsr")]; */
            const USE_GENERATE   = document.getElementById("use_generate");
            const GEN_PASS_PANEL = document.getElementById("gen_panel");
            const SPECIAL_CHAR   = document.getElementById("special_char");
            const NUMBER_CHAR    = document.getElementById("number_char");
            const GEN_PASSWORD   = document.getElementById("gen_pass");
            const SAVE_BUTTON    = document.getElementById("save");
            const TEXT_AREA      = [...document.getElementsByTagName("textarea")];

            /**
             * Muestra un recuadro con la lista de cuentas cuyo nombre de cuenta está repetido
             * 
             * @param {Array} info Array con el conjunto de cuentas cuyo nombre de cuenta está repetido.
             */
            const getAccountsNameRepeat = info => {
                NAME_REPEAT.classList = 'name_accounts_repeat';
                NAME_REPEAT.innerHTML = `
                <div class="alert">Account name used</div>
                <div class="scroll">
                    ${
                        printAccountsNameRepeat(info)
                    }
                </div>
                `;
            }

            /**
             * En caso de que el formulario no sea válido muestra los errores de los campos o selectores no válidos.
             */
            const showErrors = () => {
                SPANS[0].innerText = SELECTS[0].value == "" ? "REQUIRED" : "";
                SPANS[1].innerText = SELECTS[1].value == "" ? "REQUIRED" : ""
                NAME_ACCOUNT.classList = NAME_ACCOUNT.value == "" ? "input-error" : "input-correct";
                SPANS[2].innerText = NAME_ACCOUNT.value == "" ? "REQUIRED" : "";
                SPANS[3].innerText = PASSWORD.value !== "" ? `${passManager.validatePasswordStrength(PASSWORD.value,[NAME_ACCOUNT.value])}` : "REQUIRED";
                SPANS[3].classList = PASSWORD.value !== "" ? `${passManager.validatePasswordStrength(PASSWORD.value,[NAME_ACCOUNT.value])}` : "dangerous";
                PASSWORD.classList = PASS_REP.classList = PASS_REP.value == PASSWORD.value && PASS_REP.value !== "" ? 'input-correct' : 'input-error';
            }

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

            TEXT_AREA.forEach( e => {
                e.addEventListener("focus", () =>  normalizeTextarea(e) );
                e.addEventListener("keyup", () =>  normalizeTextarea(e) );
                e.addEventListener("paste", () =>  normalizeTextarea(e) );
            });

            SELECTS[0].addEventListener( "change", () => SPANS[0].innerText = "" );
            SELECTS[1].addEventListener( "change", () => SPANS[1].innerText = "" );

            //NAME_ACCOUNT
            NAME_ACCOUNT.addEventListener("keyup", () => {
                NAME_REPEAT.innerHTML = '';
                NAME_REPEAT.classList = 'hidden';
                NAME_ACCOUNT.value = functions.cleanInput(NAME_ACCOUNT.value);
                NAME_ACCOUNT.classList = NAME_ACCOUNT.value !== "" ? "input-correct" : "required";
                SPANS[2].innerText = "";
                if (NAME_ACCOUNT.value.replace(/\s/g,"").length) {
                    const data = new FormData(FORM);
                    functions.requestApi(data, 'name_account_repeat', getAccountsNameRepeat);
                }
                if (NAME_ACCOUNT.value.replace(/\s/g,"").length && PASSWORD.value.length) 
                    PASSWORD.dispatchEvent(new Event("keyup"));
                else if (!NAME_ACCOUNT.value.replace(/\s/g,"").length && PASSWORD.value.length) {
                    SPANS[3].innerText = SPANS[2].innerText = "ACCOUNT NAME REQUIRED";
                    NAME_ACCOUNT.classList = 'input-error';
                    PASS_REP.value = PASSWORD.value = "";
                    SPANS[3].classList = "dangerous";
                    PASS_REP.dispatchEvent(new Event("keyup"));
                }
            });

            //PASWORD
            PASSWORD.addEventListener("keyup", () => {
                if (!NAME_ACCOUNT.value.replace(/\s/g,"").length) {
                    PASSWORD.value = "";
                    SPANS[2].innerText = "ACCOUNT NAME REQUIRED";
                    NAME_ACCOUNT.classList = 'input-error';
                    return;
                }
                PASSWORD.value = functions.cleanInput(PASSWORD.value);
                SPANS[3].className = SPANS[3].innerText = PASSWORD.value !== "" ? `${passManager.validatePasswordStrength(PASSWORD.value,[NAME_ACCOUNT.value])}` : "";
                PASS_REP.dispatchEvent(new Event("keyup"));
            });
            PASSWORD.addEventListener("focus", () => PASS_REP.dispatchEvent(new Event("keyup")) );
            PASSWORD.addEventListener("blur", () => PASS_REP.dispatchEvent(new Event("keyup")) );
            PASSWORD.addEventListener("copy", e => e.preventDefault() );

            //PASS_REP
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

            //USE_GENERATE
            USE_GENERATE.addEventListener("click", () => {
                toggleColorCheckbox(USE_GENERATE);
                GEN_PASS_PANEL.classList.toggle("hidden");
                GEN_PASS_PANEL.classList.toggle("gen_pass");
                PASSWORD.toggleAttribute("disabled");
                PASS_REP.toggleAttribute("disabled");
            });

            //SPECIAL_CHAR
            SPECIAL_CHAR.addEventListener("click", () => toggleColorCheckbox(SPECIAL_CHAR) );

            //NUMBER_CHAR
            NUMBER_CHAR.addEventListener("blur", () => {
                NUMBER_CHAR.min = 6;
                NUMBER_CHAR.max = 64;
                NUMBER_CHAR.value = isNaN(NUMBER_CHAR.value) || NUMBER_CHAR.value == "" ? 6 : NUMBER_CHAR.value;
                NUMBER_CHAR.value = NUMBER_CHAR.value < 6 ? 6 : NUMBER_CHAR.value > 64 ? 64 : NUMBER_CHAR.value;
            });

            //GEN_PASSWORD
            GEN_PASSWORD.addEventListener("click", e => {
                e.preventDefault();
                if (!NAME_ACCOUNT.value.replace(/\s/g,"").length) {
                    SPANS[3].innerText = SPANS[2].innerText = "ACCOUNT NAME REQUIRED";
                    NAME_ACCOUNT.classList = 'input-error';
                    PASS_REP.value = PASSWORD.value = "";
                    SPANS[3].classList = "dangerous";
                    PASS_REP.dispatchEvent(new Event("keyup"));
                    return;
                }
                PASS_REP.value = PASSWORD.value = passManager.genPass(NUMBER_CHAR.value, SPECIAL_CHAR.checked);
                PASSWORD.dispatchEvent(new Event("keyup"));
                PASS_REP.dispatchEvent(new Event("keyup"));
                EYE_BUTTONS.filter( e=> e.id === "shps" || e.id === "shpsr" ).forEach( e => {
                    e.children[0].checked ? e.dispatchEvent(new Event("click")) : false;
                });
            });

            //SAVE_BUTTON
            SAVE_BUTTON.addEventListener("click", e => {
                SPANS[7].innerText = "";
                try {
                    validateForm(SELECTS, NAME_ACCOUNT, [PASSWORD,PASS_REP]);
                    PASSWORD.removeAttribute("disabled");
                    PASS_REP.removeAttribute("disabled");
                } catch (error) {
                    e.preventDefault();
                    showErrors();
                    SPANS[7].innerText = messageFormError(error.message);
                }
            });
        }
    }

    document.addEventListener("DOMContentLoaded", init);
}