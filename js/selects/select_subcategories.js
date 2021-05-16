/**
 * @author Francisco Javier González Sabariego
 */
{
    /**
     * 
     * @param {*} subcategoriesList 
     * @param {*} selectElement 
     */
    const createSubcategoriesOptions = (subcategoriesList,selectElement) => {
        const fragment = new DocumentFragment();

        subcategoriesList.forEach( e => {
            const option = document.createElement("option");
                option.value = `${e.subcategory}`;
                option.innerHTML = functions.normalizeOption(`${e.subcategory}`);
            fragment.appendChild(option);
        });

        selectElement.innerHTML = `<option value="">-- Choice an option --</option>`;
        selectElement.appendChild( fragment );
    }

    const init = () => {
        if (location.href.match(/(platforms\.php\?add|platforms\.php\?edit=(\d+))$/)?.input !== undefined) {
            const FORM = document.getElementById("platform");
            const CATEGORIES = document.getElementById("categories");
            const SUBCATEGORIES = document.getElementById("subcategories");
            
            CATEGORIES.addEventListener("change", () => {
                if (CATEGORIES.value == "") {
                    SUBCATEGORIES.innerHTML = `<option value="">-- Choice an option --</option>`;
                    return;
                }
                const dataForm = new FormData(FORM);
                functions.requestApi(dataForm, 'subcategories', createSubcategoriesOptions, SUBCATEGORIES);
            });
        }
    }

    document.addEventListener("DOMContentLoaded", init);
}