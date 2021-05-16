/**
 * @author Francisco Javier González Sabariego
 * 
 * Este script se carga al añadir una nueva cuenta en la página de 'accounts' del usuario y 
 * al añadir una nueva plataforma en la página 'platforms' del administrador.
 * 
 * Se encarga de crear el conjunto de opciones del selector de categorías 
 * en el formulario de añadir cuentas o en el formulario de añadir plataformas. 
 */
{
    /**
     * Crea el conjunto de opciones de categoría.
     * 
     * @param {Array} categoriesList  La lista de categorías recibidas de la API
     * @param {Element} selectElement El selector donde irán las opciones de las categorías
     */
    const createPlataformCategoriesOptions = (categoriesList,selectElement) => {
        const fragment = new DocumentFragment();

        categoriesList.forEach( e => {
            const option = document.createElement("option");
            option.value = `${e.id}`;
            option.innerText = functions.normalizeOption(`${e.category}`);
            fragment.appendChild(option);
        });
        
        selectElement.innerHTML = `<option value="">-- Choice an option --</option>`;
        selectElement.appendChild(fragment);

    }

    document.addEventListener("DOMContentLoaded", () => {
        if (location.href.match(/(accounts|platforms)\.php\?add$/)?.input !== undefined) {
            const CATEGORIES = document.getElementById("categories");
    
            functions.requestApi(null, 'categories', createPlataformCategoriesOptions, CATEGORIES);
        }
    });
}