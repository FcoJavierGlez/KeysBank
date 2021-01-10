/**
 * @author Francisco Javier González Sabariego
 */
{
    const normalizeOption = input => input.replace(/_/g, " ").replace( /\b([\w])/g, e => e.toUpperCase() ).replace(/\//g, " / ");

    async function getPlataformsList(selectElement) {
        const ROUTE = `${location.origin}/${(path = location.pathname.match(/^\/(\w+)(\/pages\/)?(\w+\.(html|php))?$/)?.[1]) == undefined ? "" : path}`;
        //`${ROUTE}/api/plataform_categories_list.php` //PHP Version
        const fragment = new DocumentFragment();

        const connect = await fetch('http://localhost/keys_bank_dev/api/plataform_categories_list.php',{
            type: "GET",
            contentType: "text/plain; charset=UTF-8"
        });

        const plataformsList = await connect.json();

        plataformsList.forEach( e => {
            const option = document.createElement("option");
            option.value = `${e.id}`;
            option.innerText = normalizeOption(`${e.plataform}`);
            fragment.appendChild(option);
        });
        
        selectElement.innerHTML = `<option value="">-- Choice an option --</option>`;
        selectElement.appendChild(fragment);

    }

    async function createSubcategoriesOptions(categoriesList){
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
    }

    async function getSubcategoriesList(formDOM,selectElement) {
        let path = "";
        const ROUTE = `${location.origin}/${(path = location.pathname.match(/^\/(\w+)(\/pages\/)?(\w+\.(html|php))?$/)?.[1]) == undefined ? "" : path}`;
        //`${ROUTE}/api/plataforms_list.php`

        const data = new FormData(formDOM);

        const connect = await fetch('http://localhost/keys_bank_dev/api/plataforms_list.php',{
            method: 'POST',
            body: data
        });

        const subCategoriesList = await connect.json();

        selectElement.innerHTML = `<option value="">-- Choice an option --</option>`;
        selectElement.appendChild( await createSubcategoriesOptions(subCategoriesList) );
    }

    const init = () => {
        const FORM = document.getElementById("categories-subcategories")
        const CATEGORIES = document.getElementById("categories");
        const SUBCATEGORIES = document.getElementById("subcategories");

        getPlataformsList(CATEGORIES);
        CATEGORIES.addEventListener("click", () => {
            if (CATEGORIES.value == "") {
                SUBCATEGORIES.innerHTML = `<option value="">-- Choice an option --</option>`;
                return;
            }
            getSubcategoriesList( FORM, SUBCATEGORIES );
        });
    }

    document.addEventListener("DOMContentLoaded", init);
}