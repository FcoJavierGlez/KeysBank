/**
 * @author Francisco Javier González Sabariego
 */
 {
    const INFO_ROUTES = {
        'pass': 'get_pass',
    }

    const INFO_ARRAY = {
        'pass': 'AES_DECRYPT(UNHEX(A.pass_account),K.password)',
    }

    const copyValue = textToCopy => {  
        const passBox = document.createElement("textarea");
        passBox.value = textToCopy;
        document.body.appendChild(passBox);
        passBox.select();
        document.execCommand("copy");
        document.body.removeChild(passBox);
    }

    /**
     * 
     * @param {*} formDOM 
     */
    async function copyPass(formDOM) {
        let idCleanClipBoard = 0;
        let path = "";
        const ROUTE = `${location.origin}/${(path = location.pathname.match(/^\/(\w+)(\/pages\/)?(\w+\.(html|php))?$/)?.[1]) == undefined ? "" : path}`;

        const data = new FormData(formDOM);

        const connect = await fetch(`${ROUTE}/api/${INFO_ROUTES.pass}.php`,{ 
            method: 'POST',
            body: data
        });
        
        const pass = await connect.json();

        copyValue( pass.length ? pass[0]['AES_DECRYPT(UNHEX(A.pass_account),K.password)'] : 'Error 404. Not found.');

        idCleanClipBoard = setTimeout( () => {

            copyValue('*******************');

            clearTimeout(idCleanClipBoard);
        }, 4700);
    }

    /**
     * 
     * @param {*} formDOM 
     * @param {*} info 
     * @param {*} elementDom 
     */
    async function showInfo(formDOM,info,elementDom = undefined) {
        let path = "";
        const ROUTE = `${location.origin}/${(path = location.pathname.match(/^\/(\w+)(\/pages\/)?(\w+\.(html|php))?$/)?.[1]) == undefined ? "" : path}`;

        const data = new FormData(formDOM);

        const connect = await fetch(`${ROUTE}/api/${INFO_ROUTES[`${info}`]}.php`,{ 
            method: 'POST',
            body: data
        });
        
        const getInfo = await connect.json();

        elementDom.nextElementSibling.tagName == 'INPUT' || elementDom.nextElementSibling.tagName == 'TEXTAREA' ? 
                elementDom.nextElementSibling.value = `${getInfo[0][INFO_ARRAY[`${info}`]]}` :
                elementDom.nextElementSibling.innerText = `${getInfo[0][INFO_ARRAY[`${info}`]]}`;
    }

    /**
     * 
     */
    const validateAccountId = elementDom => {
        try {
            const {idAccountUrl} = location.href.match(/\?view=(?<idAccountUrl>\d+)$/).groups;
            const {idAccountDom} = elementDom.value.match(/^\?\d+!(?<idAccountDom>\d+)$/).groups;

            return idAccountUrl == idAccountDom;
        } catch (error) {
            console.log('%cERROR. Manipulated DOM.', "font-weight: bold; color: red;"); //Show error message in console.
            return false;
        }
    }

    /**
     * 
     * @param {*} eye 
     */
    const toggleEye = function (eye){
        eye.children[0].checked = !eye.children[0].checked;
        eye.classList.toggle("eye");
        eye.classList.toggle("eye_slash");
    }

    /**
     * 
     * @param {*} form 
     * @param {*} info 
     * @param {*} elementDom 
     */
    const toggleShowNextSibling = function(form, info, elementDom) {
        if (elementDom.children[0].checked)
            showInfo( form, info, elementDom );
        else
            elementDom.nextElementSibling.tagName == 'INPUT' || elementDom.nextElementSibling.tagName == 'TEXTAREA' ?
                elementDom.nextElementSibling.value = `${"".padStart(elementDom.nextElementSibling.value.length,'*')}` :
                elementDom.nextElementSibling.innerText = `${"".padStart(elementDom.nextElementSibling.innerText.length,'*')}`;
    }

    const init = () => {
        if (location.href.match(/\?view=(\d)+$/)?.input !== undefined) {
            const FORM        = document.getElementById("form-view");
            const HIDDEN      = document.querySelector("input[type='hidden']");
            const SHOW_PASS   = document.getElementById("shps");
            const COPY_BUTTON = document.getElementById("cp_pss");

            COPY_BUTTON.addEventListener("click", e => {
                e.preventDefault();
                if ( !validateAccountId(HIDDEN) ) return;
                copyPass( FORM );
            });

            SHOW_PASS.addEventListener("click", function() {
                if ( !validateAccountId(HIDDEN) ) return;
                toggleEye(this);
                toggleShowNextSibling( FORM, 'pass', this );
            });
        }
        
    }

    document.addEventListener("DOMContentLoaded", init);
}