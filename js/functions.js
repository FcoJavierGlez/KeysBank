const normalizeOption = input => input.replace(/_/g, " ").replace( /\b([\w])/g, e => e.toUpperCase() ).replace(/\//g, " / ");

const genPass = (numBits,specialCharacters = false) => {
	const CHARACTERS = specialCharacters ? 'abcdefghijklmnopqrstuvwxyz1234567890?*.-_' : 'abcdefghijklmnopqrstuvwxyz1234567890';
	const LENGTH_PASS = numBits < 8 ? 8 : numBits;
	let passGenerated = "";
	for (let i = 0; i < LENGTH_PASS; i++) 
		passGenerated += parseInt(Math.random() * 2) ? CHARACTERS[parseInt( Math.random() * CHARACTERS.length )].toUpperCase() : CHARACTERS[parseInt( Math.random() * CHARACTERS.length )];
	return passGenerated;
}

const valuePassword = password => {
    let value = 0;
    const REG_EXP = [/[A-ZÑÁÉÍÓÚ]/g, /[a-zñáéíóú]/g, /\d/g, /[-\_\¿\?\*\.\:\@\!\¡]/g];
    REG_EXP.forEach( (e,i) => {
        const RE = new RegExp(e);
        value += !RE.test(password) ? 0 : i == REG_EXP.length - 1 ? 2 : 1;
    });
    return value;
}

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
    //if () return STRENGTH[0];
    if (LENGTH >= 16 && VALUE == 5) return STRENGTH[4];
    else if (LENGTH >= 8 && VALUE == 5 || LENGTH >= 12 && VALUE >= 3) return STRENGTH[3];
    else if (LENGTH >= 6 && VALUE >= 3) return STRENGTH[2];
    else if (LENGTH < 6 || VALUE < 3) return STRENGTH[1];
}