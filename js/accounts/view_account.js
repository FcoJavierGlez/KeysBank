/**
 * @author Francisco Javier González Sabariego
 * 
 * Vista de una cuenta.
 */
 {
    let tooltip = false;
    let idDelayTooltip = 0;

    /**
     * Borra el tooltip creado
     */
    const removeTooltip = () => tooltip ? (document.body.removeChild(tooltip),tooltip = false) : false;

    /**
     * Crea un tooltip mostrando el mensaje de que la contraseña ha sido copiada.
     * Se crea en una posición relativa superior a las coordenadas del click.
     * 
     * @param {Event} event 
     */
    const createTooltip = event => {
        tooltip               = document.createElement("div");
        tooltip.classList     = "tooltip";
        tooltip.innerHTML     = 'Password copied';
        tooltip.style.top     = `${event.clientY - 47}px`; //CSS el padding son 8 + 8px + 16px la fuente de separación vertical
        tooltip.style.left    = `${event.clientX - 70}px`;
        document.body.appendChild(tooltip);
    }

    /**
     * Copia la contraseña y muestra un tooltip, creado en las coordenadas superiores al click,
     * con el mensaje de que la contraseña ha sido copiada.
     * 
     * @param {String} textToCopy Contraseña copiada
     * @param {Event} event       Evento con las coordenadas del click
     */
    const copyText = (textToCopy, event = undefined) => {  
        const passBox = document.createElement("textarea");
        passBox.value = textToCopy;
        document.body.appendChild(passBox);
        passBox.select();
        document.execCommand("copy");
        document.body.removeChild(passBox);
        createTooltip(event);
        idDelayTooltip = setInterval( 
            () => {
                removeTooltip();
                clearInterval(idDelayTooltip);
                idDelayTooltip = 0;
            }, 
        800);
    }

    /**
     * Valida que el ID del campo oculto coincide con el ID registrado por get en la url
     * (para evitar que se peudan acceder a los datos de otra cuenta);
     * 
     * @param {Element} elementDom Campo oculto con el id de la cuenta que se está viendo
     * @return {Boolean}           True si la información del campo oculto no ha sido manipulada
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
     * Conmuta la información de un input o textarea. Si la información está oculta (en forma de asteriscos)
     * muestra la información correspondiente, de lo contrario rellena el input o textarea con asteriscos.
     * 
     * @param {FormData} data      Los datos del formulario (objeto FormData)
     * @param {String} request     El dato que pedimos al servidor puede ser: 'pass','info'
     * @param {Element} elementDom Elemento del árbol DOM a manipular
     * @param {Function} callback  Función que se va a ejecutar para realizar los cambios en el elemento DOM
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
            const SHOW_INFO   = document.getElementById("shinfo");
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
                functions.requestApi( data, 'pass', copyText, undefined, e );
            });

            SHOW_PASS.addEventListener("click", function() {
                if ( !validateAccountId(HIDDEN) ) return;
                const data = new FormData(FORM);
                toggleEye(this);
                toggleShowNextSibling( data, 'pass', this, showInfo );
            });

            SHOW_INFO.addEventListener("click", function() {
                if ( !validateAccountId(HIDDEN) ) return;
                const data = new FormData(FORM);
                toggleEye(this);
                toggleShowNextSibling( data, 'info', this, showInfo );
            });
        }
        
    }

    document.addEventListener("DOMContentLoaded", init);
}