/**
 * @author Francisco Javier González Sabariego
 */
const passManager = (
    () => {

        const DANGEROUS_WORDS = ['bienvenido/a','welcome','password','contraseña','hola','hello','root','admin','user','usuario/a'];

        /**
         * Comprueba si la contraseña pasada por parámetro contiene un mínimo de caracteres especiales,
         * siendo el mínimo la décima parte de la longitud de la contraseña + 1
         * 
         * @param {String} password Contraseña a comprobar
         * @returns {Boolean} True si tiene el mínimo de caracteres especiales
         */
        const checkMinSpecialCharacters = function(password) {
            const SPECIAL_CHARS = /[\?\*\.\:\-\_\@](?=\w)/g;
            let numSpecialChars = 0;
            return ((numSpecialChars = password.match(SPECIAL_CHARS)?.length) == undefined ? 0 : numSpecialChars) >= Math.floor(password.length / 10) + 1;
        }

        /**
         * Genera una contraseña de x caracteres de longitud y con caracteres especiales o no
         * según indique el booleano pasado como segundo parámetro.
         * 
         * @param {Number} lengthPass Longitud de la contraseña a generar (por defecto mínimo de 6 y máximo de 64 caracteres)
         * @param {Boolean} specialCharacters Determina el uso de caracteres especiales (su valor por defecto es false)
         * @returns {String} Contraseña generada.
         */
        const genPass = function (lengthPass,specialCharacters = false) {
            const CHARACTERS = specialCharacters ? 'abcdefghijklmnopqrstuvwxyz1234567890?*.:-_@' : 'abcdefghijklmnopqrstuvwxyz1234567890';
            const LENGTH_PASS = lengthPass < 6 ? 6 : lengthPass > 64 ? 64 : lengthPass;
            let passGenerated = "";
            do {
                passGenerated = "";
                for (let i = 0; i < LENGTH_PASS; i++) 
                    passGenerated += parseInt(Math.random() * 2) ? CHARACTERS[parseInt( Math.random() * CHARACTERS.length )].toUpperCase() : CHARACTERS[parseInt( Math.random() * CHARACTERS.length )];
            } while ( (valuePassword(passGenerated) < 3 && !specialCharacters ) || ( specialCharacters && !(checkMinSpecialCharacters(passGenerated) && valuePassword(passGenerated) == 5 && !checkDangerousPassword(passGenerated)) ) );
            return passGenerated;
        }

        /**
         * Determina el valor de una contraseña en función de si posee:
         * - Letras minúsculas
         * - Letras mayúsculas
         * - Dígitos
         * - Caracteres especiales
         * 
         * El valor retornado estará comprendido entre [1-5]
         * 
         * @param {String} password Contraseña a calcular su valor
         * @returns {Number}    Valor obtenido de la contraseña
         */
        const valuePassword = function(password) {
            let value = 0;
            const REG_EXP = [/[A-ZÑÁÉÍÓÚ]/g, /[a-zñáéíóú]/g, /\d/g, /[\-\_\¿\?\*\.\:\@\!\¡]/g];
            REG_EXP.forEach( (e,i) => {
                const RE = new RegExp(e);
                value += !RE.test(password) ? 0 : i == REG_EXP.length - 1 ? 2 : 1;
            });
            return value;
        }

        /**
         * Comprueba si la contraseña pasada por parámetro es potencialmente peligrosa
         * 
         * @param {String} password La contraseña a comprobar.
         * @returns {Boolean} True si es peligrosa, false si no lo es.
         */
        const checkDangerousPassword = function(password,array = undefined) {
            /* La primera expresión regular niega las contraseñas que contengan las palabras: 
            * bienvenido/a,welcome,hola,hello,contraseña,password,admin*,user y usuario/a.
            * También ignora el case y niega sus derivaciones con números o caracteres reconocibles, ejemplos:  
            * p4S5w0rD, W31c@mE, 4dM1ni57r@d0R,cOn7r@_53ñ4...
            */
            const REG_EXP = [ new RegExp(genRegExpPass(DANGEROUS_WORDS), 'i'),  /^(.)(\1){1,}$/i ];

            array !== undefined ? REG_EXP.push(new RegExp(genRegExpPass(array), 'i')) : false;

            if (password.length == 1) return true;
            for (let i = 0; i < REG_EXP.length; i++) {
                const RE = new RegExp(REG_EXP[i]);
                if (RE.test(password)) return true;
            }
            return false;
        }

        /**
         * Valida la fuerza o robustez de una contraseña pasada por parámetro. 
         * Los valores obtenidos serán devueltos en forma de string y estarán comprendidos entre:
         * - dangerous: potencialmente peligrosa
         * - weak
         * - normal
         * - strong
         * - strongest: contraseña muy robusta
         * 
         * @param {String} password Contraseña a validar
         * @returns {String} Validación obtenida de la contraseña [dangerous-strongest]
         */
        const validatePasswordStrength = function(password) {
            const VALUE = valuePassword(password);
            const LENGTH = password.length;
            const STRENGTH = {
                0: 'dangerous',
                1: 'weak',
                2: 'normal',
                3: 'strong',
                4: 'strongest',
            }
            if (checkDangerousPassword(password)) return STRENGTH[0];
            else if (LENGTH >= 16 && VALUE == 5) return STRENGTH[4];
            else if (LENGTH >= 8 && VALUE == 5 || LENGTH >= 12 && VALUE > 3) return STRENGTH[3];
            else if (LENGTH >= 6 && VALUE >= 3) return STRENGTH[2];
            else if (LENGTH < 6 || VALUE < 3) return STRENGTH[1];
        }

        /**
         * 
         * @param {*} nameAccount 
         * @returns 
         */
        const prepareWordToRegExp = function(nameAccount) {
            return `.*${nameAccount
                        .replace(/(a\/o|o\/a)/g,"(o|a)")
                        .replace(/[a4]/gi, "(a|@|4)")
                        .replace(/[e3]/gi, "(e|3)")
                        .replace(/[il1]/gi, "(i|l|1)")
                        .replace(/[o0]/gi, "(o|@|0)")
                        .replace(/[uv]/gi, "(u|v)")
                        .replace(/[b8]/gi, "(b|8)")
                        .replace(/[g9]/gi, "(g|9)")
                        .replace(/ñ/gi, "(ñ|n)")
                        .replace(/[qk]/gi, "(q|k)")
                        .replace(/[s5]/gi, "(s|5)")
                        .replace(/[t7]/gi, "(t|7)")
                        .replace(/w/gi, "(w|v)")}.*`;
        }

        /**
         * 
         * @param {*} arrayWords 
         * @returns 
         */
        const genRegExpPass = function(arrayWords) {
            return `^(${arrayWords.map( e => prepareWordToRegExp(e) ).join('|')})$`;
        }

        return {
            genPass: genPass,
            validatePasswordStrength: validatePasswordStrength,
            checkDangerousPassword: checkDangerousPassword,
        }
    }
)();