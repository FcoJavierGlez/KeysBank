/**
 * @author Francisco Javier González Sabariego
 */
{
    /* async function createSubcategoriesOptions(categoriesList){
        const fragment = new DocumentFragment();

        const subcategoryList = [...new Set(await categoriesList.map( e => e.subcategory))]

        subcategoryList.forEach( subcategory => {
            const optgroup = document.createElement("optgroup");
            optgroup.label = `${subcategory}`;
            categoriesList.filter( e => e.subcategory == subcategory )
            .forEach( e => {
                const option = document.createElement("option");
                option.value = `${e.name}`;
                option.innerHTML = normalizeOption(`${e.name}`);
                optgroup.appendChild(option);
            } );
            fragment.appendChild(optgroup);
        });

        return fragment;
    } */

    async function createSubcategoriesOptions(formDOM,selectElement) {
        let path = "";
        const ROUTE = `${location.origin}/${(path = location.pathname.match(/^\/(\w+)(\/pages\/)?(\w+\.(html|php))?$/)?.[1]) == undefined ? "" : path}`;
        //`${ROUTE}/api/plataforms_list.php`

        const fragment = new DocumentFragment();
        const data = new FormData(formDOM);

        const connect = await fetch('http://localhost/keys_bank_dev/api/subcategories_list.php',{
            method: 'POST',
            body: data
        });

        const subCategoriesList = await connect.json();

        subCategoriesList.forEach( e => {
            const option = document.createElement("option");
                option.value = `${e.subcategory}`;
                option.innerHTML = normalizeOption(`${e.subcategory}`);
            fragment.appendChild(option);
        });

        selectElement.innerHTML = `<option value="">-- Choice an option --</option>`;
        selectElement.appendChild( fragment );
    }

    const init = () => {
        const FORM = document.getElementById("categories-subcategories")
        const CATEGORIES = document.getElementById("categories");
        const SUBCATEGORIES = document.getElementById("subcategories");
        
        CATEGORIES.addEventListener("click", () => {
            if (CATEGORIES.value == "") {
                SUBCATEGORIES.innerHTML = `<option value="">-- Choice an option --</option>`;
                return;
            }
            createSubcategoriesOptions( FORM, SUBCATEGORIES );
        });
    }

    document.addEventListener("DOMContentLoaded", init);
}