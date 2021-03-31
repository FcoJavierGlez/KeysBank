/**
 * @author Francisco Javier González Sabariego
 */
{
    const copyValue = textToCopy => {  
        const passBox = document.createElement("textarea");
        passBox.value = textToCopy;
        document.body.appendChild(passBox);
        passBox.select();
        document.execCommand("copy");
        document.body.removeChild(passBox);
    }

    async function getPass(formDOM) {
        let path = "";
        const ROUTE = `${location.origin}/${(path = location.pathname.match(/^\/(\w+)(\/pages\/)?(\w+\.(html|php))?$/)?.[1]) == undefined ? "" : path}`;

        const data = new FormData(formDOM);

        const connect = await fetch(`${ROUTE}/api/get_pass.php`,{ 
            method: 'POST',
            body: data
        });
        
        const pass = await connect.json();
        
        copyValue( pass.length ? pass[0]['AES_DECRYPT(UNHEX(A.pass_account),K.password)'] : 'Error 404. Not found.');
    }

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

    const init = () => {
        if (location.href.match(/\?view=(\d)+$/)?.input !== undefined) {
            const FORM = document.getElementById("form-view");
            const COPY_BUTTON = document.getElementById("cp_pss");
            const HIDDEN = document.querySelector("input[type='hidden']");

            COPY_BUTTON.addEventListener("click", e => {
                e.preventDefault();
                if ( !validateAccountId(HIDDEN) ) return;
                getPass( FORM, 'COPY' );
            });
        }
        
    }

    document.addEventListener("DOMContentLoaded", init);
}