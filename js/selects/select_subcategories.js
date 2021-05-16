/**
 * @author Francisco Javier González Sabariego
 */
{
    async function createSubcategoriesOptions(formDOM,selectElement) {
        let path = "";
        const ROUTE = `${location.origin}/${(path = location.pathname.match(/^\/(\w+)(\/pages\/)?(\w+\.(html|php))?$/)?.[1]) == undefined ? "" : path}`;

        const fragment = new DocumentFragment();
        const data = new FormData(formDOM);

        const connect = await fetch(`${ROUTE}/api/subcategories_list.php`,{
            method: 'POST',
            body: data
        });

        const subCategoriesList = await connect.json();

        subCategoriesList.forEach( e => {
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
                createSubcategoriesOptions( FORM, SUBCATEGORIES );
            });
        }
    }

    document.addEventListener("DOMContentLoaded", init);
}