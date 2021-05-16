/**
 * @author Francisco Javier González Sabariego
 */
{
    /**
     * 
     * @param {*} categoriesList 
     * @param {*} elementDom 
     */
    const createPlataformsOptions = (categoriesList, elementDom) => {
        const fragment = new DocumentFragment();

        const subcategoryList = [...new Set(categoriesList.map( e => e.subcategory))]

        subcategoryList.forEach( subcategory => {
            const optgroup = document.createElement("optgroup");
            optgroup.label = `${subcategory}`;
            categoriesList.filter( e => e.subcategory == subcategory )
            .forEach( e => {
                const option = document.createElement("option");
                option.value = `${e.name}`;
                option.innerHTML = `${e.name}`;
                optgroup.appendChild(option);
            } );
            fragment.appendChild(optgroup);
        });

        elementDom.appendChild(fragment);
    }

    const init = () => {
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
        
    }

    document.addEventListener("DOMContentLoaded", init);
}