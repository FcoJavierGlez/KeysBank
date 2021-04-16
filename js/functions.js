/**
 * @author Francisco Javier González Sabariego
 */
const functions = (
    () => {
        /**
         * 
         * @param {Object} FormData     Object DataForm con los datos del formulario
         * @param {String} dataRequest  El dato que pedimos al servidor puede ser: 'pass','info'
         * @param {Function} callback   La función que se va a ejecutar con los datos obtenidos tras la consulta
         * @param {Element} elementDom  
         */
         async function requestApi(dataForm, dataRequest, callBack, elementDom = undefined) {
            let path = "";
            const ROUTE = `${location.origin}/${(path = location.pathname.match(/^\/(\w+)(\/pages\/)?(\w+\.(html|php))?$/)?.[1]) == undefined ? "" : path}`;
            
            const INFO_ROUTES = {
                'pass': 'get_pass',
                'name_account_repeat': 'get_repeat_name_accounts',
            };
            const INFO_ARRAY = {
                'pass': 'AES_DECRYPT(UNHEX(A.pass_account),K.password)',
            };

            const connect = await fetch(`${ROUTE}/api/${INFO_ROUTES[dataRequest]}.php`, { 
                method: 'POST',
                body: dataForm
            });
            
            const getInfo = await connect.json();

            if (getInfo.length) {
                if (dataRequest == 'name_account_repeat')
                    callBack(getInfo);
                else
                    elementDom == undefined ?
                        callBack(`${getInfo[0][INFO_ARRAY[dataRequest]]}`) :
                        callBack(`${getInfo[0][INFO_ARRAY[dataRequest]]}`,elementDom);
            }
        }
        
        /**
         * Normaliza el string de una etiqueta option pasado por parámetro.
         * 
         * @param {String} input String a normalizar
         * @returns {String} String normalizado
         */
        const normalizeOption = input => input.replace(/_/g, " ").replace( /\b([\w])/g, e => e.toUpperCase() ).replace(/\//g, " / ");
        
        /**
         * Limpia un string eliminando los siguientes caracteres: " '"<>\/&|"
         * 
         * @param {String} input String a limpiar
         * @returns {String} String limpio
         */
        const cleanInput = input => input.replace(/[\s\'\"\<\>\\\/\&\|\´\`\^\(\)\[\]\{\}\,\;\%\$\·]/g,"")
                                            .replace(/[aáàâ]/gi, e => e == e.toUpperCase() ? "A" : "a")
                                            .replace(/[eéèê]/gi, e => e == e.toUpperCase() ? "E" : "e")
                                            .replace(/[iíìî]/gi, e => e == e.toUpperCase() ? "I" : "i")
                                            .replace(/[oóòô]/gi, e => e == e.toUpperCase() ? "O" : "o")
                                            .replace(/[uúùû]/gi, e => e == e.toUpperCase() ? "U" : "u");
        
        
        return {
            requestApi: requestApi,
            normalizeOption: normalizeOption,
            cleanInput: cleanInput
        }
    }
)()
