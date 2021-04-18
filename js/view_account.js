/**
 * @author Francisco Javier González Sabariego
 */
 {
    const copyText = textToCopy => {  
        const passBox = document.createElement("textarea");
        passBox.value = textToCopy;
        document.body.appendChild(passBox);
        passBox.select();
        document.execCommand("copy");
        document.body.removeChild(passBox);
    }

    /**
     * 
     */
    const validateAccountId = elementDom => {
        try {
            const {idAccountUrl} = location.href.match(/\?view=(?<idAccountUrl>\d+)$/).groups;
            const idAccountDom   = elementDom.value;

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
     * @param {*} data 
     * @param {*} info 
     * @param {*} elementDom 
     */
    const toggleShowNextSibling = function(data, request, elementDom, callback) {
        if (elementDom.children[0].checked)
            functions.requestApi( data, request, callback, elementDom );
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

            const showInfo = (info,elementDom) => {
                elementDom.nextElementSibling.tagName == 'INPUT' || elementDom.nextElementSibling.tagName == 'TEXTAREA' ? 
                        elementDom.nextElementSibling.value = info :
                        elementDom.nextElementSibling.innerText = info;
            }

            COPY_BUTTON.addEventListener("click", e => {
                e.preventDefault();
                if ( !validateAccountId(HIDDEN) ) return;
                const data = new FormData(FORM);
                functions.requestApi( data, 'pass', copyText );
            });

            SHOW_PASS.addEventListener("click", function() {
                if ( !validateAccountId(HIDDEN) ) return;
                const data = new FormData(FORM);
                toggleEye(this);
                toggleShowNextSibling( data, 'pass', this, showInfo );
            });
        }
        
    }

    document.addEventListener("DOMContentLoaded", init);
}