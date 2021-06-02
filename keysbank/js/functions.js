/**
 * @author Francisco Javier González Sabariego
 * 
 * Éste script devuelve una función llamada 'functions' que contiene en su interior un conjunto 
 * de funciones de las cuales, algunas de ellas, son devueltas en un objeto literal.
 * 
 * De esta forma obtenemos una encapsulación sin necesidad de emplear clases, ya que las funciones que son devueltas
 * en el objeto literal del return de la función 'functions' serán accesibles como métodos públicos de una clase,
 * las funciones que no estén incorporadas en el objeto literal del return serán equivalentes a métodos privados y,
 * por tanto, no serán accesibles desde fuera si no que se serán usadas internamente por las funciones 'públicas'.
 * 
 * El objetivo de éste script es unificar funciones generales empleadas desde cualquier script de la app.
 * 
 * De todas las funciones que encontrarás en este script las dos más importantes son:
 * 
 * - requestApi (pública): Que lanzará peticiones al servidor y la BBDD para recavar los datos solicitados
 * - apiAction (privada): Función ejecutada en el interior de la función anterior y sirve para construir
 *                        los elementos del árbol DOM dónde mostraremos la información obtenida.
 */
const functions = (
    () => {
        /**
         * Convierte caracteres especiales en formato HTML, (ejemplo &lt; -> <) en su correspondiente caracter sustituible por JS.
         * 
         * @param {String} input Cadena a convertir
         * @returns {String}     Resultado de la conversión
         */
        const replaceHtmlCharacters = input => input.replace(/&quot;/g, '"').replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>');
        
        /**
         * Acción que se ejecuta dentro de la función 'requestApi'
         * 
         * En función de la información requerida se ejecutará una función callback u otra, además, algunas
         * acciones requieren de un elemento del árbol DOM sobre el que se van a aplicar los cambios para insertar 
         * la información requerida o alterar su diseño o contenido
         * 
         * Actualmente los dataRequest válidos son:
         *  [ 'categories', 'subcategories', 'platforms', 'name_account_repeat', 'info', 'pass' ] 
         * 
         * @param {String} dataRequest        El tipo de dato requerido: 'pass', 'info', 'name_account_repeat'...
         * @param {Array} getInfo             Datos obtenidos tras la petición a la API
         * @param {Function} functionCallback La función que se va a ejecutar con los datos obtenidos
         * @param {Element} domElement        Elemento del árbol DOM en el que se van a añadir o realizar cambios con los datos extraídos [opcional]
         * @param {Event} event               Evento que ha disparado el evento [opcional]
         */
        const apiAction = (dataRequest,getInfo,functionCallback,domElement,event = undefined) => {
            const INFO_ARRAY = {
                'pass': 'AES_DECRYPT(UNHEX(A.pass_account),K.password)',
                'pass_profile': 'AES_DECRYPT(UNHEX(U.pass),K.password)',
                'info': 'AES_DECRYPT(UNHEX(A.info),K.password)',
            };
            switch (dataRequest) {
                case 'categories':
                case 'subcategories':
                case 'platforms':
                case 'name_account_repeat':
                    return domElement == undefined ? 
                            functionCallback(getInfo) :
                            functionCallback(getInfo, domElement);
                case 'info':
                    return domElement == undefined ?
                        functionCallback(`${replaceHtmlCharacters(getInfo[0][INFO_ARRAY[dataRequest]])}`) :
                        functionCallback(`${replaceHtmlCharacters(getInfo[0][INFO_ARRAY[dataRequest]])}`, domElement);
                case 'pass':
                case 'pass_profile':
                    return domElement == undefined ?
                        functionCallback(`${getInfo[0][INFO_ARRAY[dataRequest]]}`, event) :
                        functionCallback(`${getInfo[0][INFO_ARRAY[dataRequest]]}`, domElement, event);
                default:
                    return domElement == undefined ?
                        functionCallback(`${getInfo[0][INFO_ARRAY[dataRequest]]}`) :
                        functionCallback(`${getInfo[0][INFO_ARRAY[dataRequest]]}`, domElement);
            }
        }

        /**
         * Petición a la API de la APP que recibe los datos solicitados y los procesa en una función callback pasada por parámetro.
         * 
         * Actualmente los dataRequest válidos son:
         *  [ 'categories', 'subcategories', 'platforms', 'name_account_repeat', 'info', 'pass' ] 
         * 
         * @param {Object} dataForm     Object FormData con los datos del formulario
         * @param {String} dataRequest  El dato que pedimos al servidor puede ser: 'pass','info'
         * @param {Function} callback   La función que se va a ejecutar con los datos obtenidos tras la consulta
         * @param {Element} elementDom  Elemento del árbol DOM en el que se van a añadir o realizar cambios con los datos extraídos [opcional]
         * @param {Event} event         Evento que ha disparado el evento [opcional]
         */
         async function requestApi(dataForm, dataRequest, callBack, elementDom = undefined, event = undefined) {
            let path = "";
            const ROUTE = `${location.origin}/${(path = location.pathname.match(/^\/(\w+)(\/pages\/)?(\w+\.(html|php))?$/)?.[1]) == undefined ? "" : path}`;
            
            const INFO_ROUTES = {
                'pass': 'get_pass',
                'pass_profile': 'get_profile_pass',
                'info': 'get_info',
                'categories': 'platform_categories_list',
                'subcategories': 'subcategories_list',
                'platforms': 'platforms_list',
                'name_account_repeat': 'get_repeat_name_accounts',
            };

            const connect = await fetch(`${ROUTE}/api/${INFO_ROUTES[dataRequest]}.php`, { 
                method: 'POST',
                body: dataForm
            });
            
            const getInfo = await connect.json();

            if (getInfo.length) 
                apiAction(dataRequest, getInfo, callBack, elementDom, event);
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
