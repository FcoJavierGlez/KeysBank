/**
 * @author Francisco Javier González Sabariego
 * 
 * Este script se carga al añadir una nueva plataforma en la página de 'platforms' del administrador.
 * 
 * Se encarga de crear el conjunto de opciones del selector de subcategorías en el formulario de añadir plataformas, 
 * y su comportamiento es el siguiente:
 * 
 * - Si no hay una categoría seleccionada, el selector de subcategorías 
 *      sólo tiene una opción: <option value="">-- Choice an option --</option>
 * 
 * - En caso de seleccionarse una categoría se lanza una petición 
 *      a la API usando: functions.requestApi(dataForm, 'subcategories', createSubcategoriesOptions, SUBCATEGORIES);
 *      y una vez recibidos los datos en forma de array se crea el conjunto 
 *      de opciones de subcategorías disponibles para la categoría seleccionada.
 */
{
    /**
     * Crea el conjunto de opciones de subcategorías (pertenecientes a la categoría seleccionada).
     * 
     * @param {Array} subcategoriesList La lista de subcategorías (pertenecientes a la categoría seleccionada) recibidas de la API
     * @param {Element} selectElement   El selector donde irán las opciones de las subcategorías
     */
    const createSubcategoriesOptions = (subcategoriesList,selectElement) => {
        const fragment = new DocumentFragment();

        subcategoriesList.forEach( e => {
            const option = document.createElement("option");
                option.value = `${e.id}`;
                option.innerHTML = functions.normalizeOption(`${e.subcategory}`);
            fragment.appendChild(option);
        });

        selectElement.innerHTML = `<option value="">-- Choice an option --</option>`;
        selectElement.appendChild( fragment );
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (location.href.match(/platforms\.php\?add$/)?.input !== undefined) {
            const FORM = document.getElementById("platform");
            const CATEGORIES = document.getElementById("categories");
            const SUBCATEGORIES = document.getElementById("subcategories");
            
            CATEGORIES.addEventListener("change", () => {
                if (CATEGORIES.value == "") {
                    SUBCATEGORIES.innerHTML = `<option value="">-- Choice an option --</option>`;
                    return;
                }
                
                functions.requestApi(new FormData(FORM), 'subcategories', createSubcategoriesOptions, SUBCATEGORIES);
            });
        }
    });
}