/**
 * Normaliza el string de una etiqueta option pasado por parámetro.
 * 
 * @param {String} input String a normalizar
 * @returns {String} String normalizado
 */
const normalizeOption = input => input.replace(/_/g, " ").replace( /\b([\w])/g, e => e.toUpperCase() ).replace(/\//g, " / ");

/**
 * Genera una contraseña de x caracteres de longitud y con caracteres especiales o no
 * según indique el booleano pasado como segundo parámetro.
 * 
 * @param {Number} lengthPass Longitud de la contraseña a generar (por defecto mínimo de 6 y máximo de 64 caracteres)
 * @param {Boolean} specialCharacters Determina el uso de caracteres especiales (su valor por defecto es false)
 * @returns {String} Contraseña generada.
 */
const genPass = (lengthPass,specialCharacters = false) => {
	const CHARACTERS = specialCharacters ? 'abcdefghijklmnopqrstuvwxyz1234567890?*.-_' : 'abcdefghijklmnopqrstuvwxyz1234567890';
	const LENGTH_PASS = lengthPass < 6 ? 6 : lengthPass > 64 ? 64 : lengthPass;
	let passGenerated = "";
	for (let i = 0; i < LENGTH_PASS; i++) 
		passGenerated += parseInt(Math.random() * 2) ? CHARACTERS[parseInt( Math.random() * CHARACTERS.length )].toUpperCase() : CHARACTERS[parseInt( Math.random() * CHARACTERS.length )];
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
const valuePassword = password => {
    let value = 0;
    const REG_EXP = [/[A-ZÑÁÉÍÓÚ]/g, /[a-zñáéíóú]/g, /\d/g, /[-\_\¿\?\*\.\:\@\!\¡]/g];
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
const checkDangerousPassword = password => {
    /* La primera expresión regular niega ls contraseñas que contengan las palabras: 
     * bienvenido/a,welcome,hola,hello,contraseña,password,admin*,user y usuario/a.
     * También ignora el case y niega sus derivaciones con números o caracteres reconocibles, ejemplos:  
     * p4S5w0rD, W31c@mE, 4dM1ni57r@d0R,cOn7r@_53ñ4...
    */
    const REG_EXP = [
        /^(\d+)?(.*b(i|1)(e|3)n\_?v(e|3)n(i|1)d(a|o|@|4|0).*|.*(w|vv)(e|3)(l|1)c(o|\@|0)m(e|3).*|.*h(o|@|0)(l|7|1)(a|@|4).*|.*h(e|3)[l71]{2,}(o|\@|0).*|.*c(o|\@|0)n(t|7)r(a|\@|4)\_?(s|5)(e|3)(ñ|n+)(a|\@|4).*|.*p(a|\@|4)[s5]{2,}\_?(w|v+)(o|\@|0)rd.*|.*(a|\@|4)dm(i|1)n.*|.*u(s|5)u(a|\@|4)r(i|1)(a|o|\@|4|0).*|.*u(s|5)(e|3)r.*)?(\d+)?$/i, 
        /^(.)(\1){3,}$/i
    ];
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
const validatePasswordStrength = password => {
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
 * Limpia un string eliminando los siguientes caracteres: " '"<>\/&|"
 * 
 * @param {String} input String a limpiar
 * @returns {String} String limpio
 */
const cleanInput = input => input.replace(/[\s\'\"\<\>\\\/\&\|]/g,"");