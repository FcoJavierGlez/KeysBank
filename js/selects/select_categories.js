/**
 * @author Francisco Javier González Sabariego
 */
{
    /**
     * 
     * @param {*} categoriesList 
     * @param {*} selectElement 
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

    const init = () => {
        if (location.href.match(/(accounts|platforms)\.php\?add$/)?.input !== undefined) {
            const CATEGORIES = document.getElementById("categories");
    
            functions.requestApi(null, 'categories', createPlataformCategoriesOptions, CATEGORIES);
        }
    }

    document.addEventListener("DOMContentLoaded", init);
}