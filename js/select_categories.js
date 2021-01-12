/**
 * @author Francisco Javier González Sabariego
 */
{
    async function createPlataformCategoriesOptions(selectElement) {
        let path = "";
        const ROUTE = `${location.origin}/${(path = location.pathname.match(/^\/(\w+)(\/pages\/)?(\w+\.(html|php))?$/)?.[1]) == undefined ? "" : path}`;
        //`${ROUTE}/api/plataform_categories_list.php` //PHP Version
        const fragment = new DocumentFragment();

        const connect = await fetch('http://localhost/keys_bank_dev/api/plataform_categories_list.php',{
            type: "GET",
            contentType: "text/plain; charset=UTF-8"
        });

        const categoriesList = await connect.json();

        categoriesList.forEach( e => {
            const option = document.createElement("option");
            option.value = `${e.id}`;
            option.innerText = normalizeOption(`${e.category}`);
            fragment.appendChild(option);
        });
        
        selectElement.innerHTML = `<option value="">-- Choice an option --</option>`;
        selectElement.appendChild(fragment);

    }

    const init = () => {
        const CATEGORIES = document.getElementById("categories");

        createPlataformCategoriesOptions(CATEGORIES);
    }

    document.addEventListener("DOMContentLoaded", init);
}