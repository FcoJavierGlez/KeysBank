/**
 * @author Francisco Javier González Sabariego
 * 
 * Este script se carga al añadir una nueva cuenta en la página de 'accounts' del usuario.
 * 
 * Se encarga de crear el conjunto de opciones del selector de plataformas en el formulario de añadir cuentas, 
 * y su comportamiento es el siguiente:
 * 
 * - Si no hay una categoría seleccionada, el selector de plataformas 
 *      sólo tiene una opción: <option value="">-- Choice an option --</option>
 * 
 * - En caso de seleccionarse una categoría se lanza una petición 
 *      a la API usando: functions.requestApi(dataForm, 'platforms', createPlataformsOptions, SUBCATEGORIES);
 *      y una vez recibidos los datos en forma de array se crea el conjunto de opciones agrupados 
 *      por su correspondiente subcategoría en forma de optgroup.
 */
{
    /**
     * Crea el conjunto de opciones de plataformas (pertenecientes a la categoría seleccionada)
     * y las agrupa por su correspondiente subcategoría.
     * 
     * @param {Array} platformsList La lista de plataformas (pertenecientes a la categoría seleccionada) recibidas de la API
     * @param {Element} elementDom  El selector donde irán las opciones de las plataformas
     */
    const createPlataformsOptions = (platformsList, elementDom) => {
        const fragment = new DocumentFragment();

        /* Filtro las subcategorías de la lista para evitar que se repitan y tener solo 1 subcategoría
        de cada tipo, de esta forma se podrán crear los optgroup y agrupar las plataformas en su
        correspondiente subcategoría */
        const subcategoryList = [...new Set(platformsList.map( e => e.subcategory))]

        subcategoryList.forEach( subcategory => {
            const optgroup = document.createElement("optgroup");
            optgroup.label = `${subcategory}`;
            platformsList.filter( e => e.subcategory == subcategory )
            .forEach( e => {
                const option = document.createElement("option");
                option.value = `${e.name}`;
                option.innerHTML = `${e.name}`;
                optgroup.appendChild(option);
            } );
            fragment.appendChild(optgroup);
        });
        
        elementDom.innerHTML = `<option value="">-- Choice an option --</option>`;
        elementDom.appendChild(fragment);
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (location.href.match(/accounts\.php\?add$/)?.input !== undefined) {
            const FORM = document.getElementById("form-add");
            const CATEGORIES = document.getElementById("categories");
            const SUBCATEGORIES = document.getElementById("subcategories");
            
            CATEGORIES.addEventListener("change", () => {
                if (CATEGORIES.value == "") {
                    SUBCATEGORIES.innerHTML = `<option value="">-- Choice an option --</option>`;
                    return;
                }
                const dataForm = new FormData(FORM);
                functions.requestApi(dataForm, 'platforms', createPlataformsOptions, SUBCATEGORIES);
            });
        }
    });
}