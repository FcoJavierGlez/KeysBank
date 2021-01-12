const normalizeOption = input => input.replace(/_/g, " ").replace( /\b([\w])/g, e => e.toUpperCase() ).replace(/\//g, " / ");

const copyValue = textToCopy => {  //I must move this to another js file
    const HIDDEN = document.createElement("input");
    HIDDEN.type  = "text";
    HIDDEN.value = textToCopy;
    document.body.appendChild(HIDDEN);
    HIDDEN.select();
    document.execCommand("copy");
    document.body.removeChild(HIDDEN);
}