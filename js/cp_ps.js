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
        
        copyValue(await pass[0]['AES_DECRYPT(UNHEX(A.pass_account),K.password)']);
    }

    const init = () => {
        if (location.href.match(/\?view=(\d)+$/)?.input !== undefined) {
            const FORM = document.getElementById("form-view");
            const COPY_BUTTON = document.getElementById("cp_pss");
            
            COPY_BUTTON.addEventListener("click", e => {
                e.preventDefault();
                getPass( FORM );
            });
        }
        
    }

    document.addEventListener("DOMContentLoaded", init);
}