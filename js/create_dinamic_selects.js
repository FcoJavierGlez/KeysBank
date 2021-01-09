/**
 * @author Francisco Javier González Sabariego
 */
{
    const normalizeOption = input => input.replace(/_/g, " ").replace( /\b([\w])/g, e => e.toUpperCase() ).replace(/\//g, " / ");

    async function getPlataformsList(selectElement) {
        const fragment = new DocumentFragment();

        const connect = await fetch('http://localhost/keys_bank_dev/api/plataforms_list.php',{
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

    async function createSubcategoriesOptions(plataformsList){
        const fragment = new DocumentFragment();

        const typeList = [...new Set(await plataformsList.map( e => e.type))]

        typeList.forEach( type => {
            const optgroup = document.createElement("optgroup");
            optgroup.label = `${type}`;
            plataformsList.filter( e => e.type == type )
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

    async function getSubcategoriesList(id,selectElement) {
        if (id == "") return;
        const PATH = `${location.origin}/${location.pathname.match(/^\/(\w+)\/(\/pages\/|index(\.html|\.php)?)?/)?.[1]}`;
        /* const PATH2 = location.pathname.match(/^.+\/(\w+)\/(\/pages\/|index(\.html|\.php)?)?/)?.[1];  //pruebas con html
        console.log(`PATH2: ${PATH2}`); */
        //location.pathname.match(/^\/(\w+)\/(\/pages\/|index(\.html|\.php)?)?/)?.[1]

        const URL = {   //OPCiÓN FINAL PARA PHP
            '1': `${PATH}/api/social_media_list.php`,
            '2': `${PATH}/api/digital_plataforms_list.php`,
            '3': `${PATH}/api/webs_apps_list.php`,
            '4': `${PATH}/api/mails_list.php`,
            '5': `${PATH}/api/operating_systems_list.php`,
            '6': `${PATH}/api/credit_cards_bank_accounts_list.php`
        }

        /* const URL = {    //pruebas html
            '1': `http://localhost/keys_bank_dev/api/social_media_list.php`,
            '2': `http://localhost/keys_bank_dev/api/digital_plataforms_list.php`,
            '3': `http://localhost/keys_bank_dev/api/webs_apps_list.php`,
            '4': `http://localhost/keys_bank_dev/api/mails_list.php`,
            '5': `http://localhost/keys_bank_dev/api/operating_systems_list.php`,
            '6': `http://localhost/keys_bank_dev/api/credit_cards_bank_accounts_list.php`
        } */

        const connect = await fetch(URL[id],{
            type: "GET",
            contentType: "text/plain; charset=UTF-8"
        });

        const plataformsList = await connect.json();

        selectElement.innerHTML = `<option value="">-- Choice an option --</option>`;
        selectElement.appendChild( await createSubcategoriesOptions(plataformsList) );
    }

    const init = () => {
        const PLATAFORMS = document.getElementById("plataforms");
        const SUBCATEGORIES = document.getElementById("subcategories");

        getPlataformsList(PLATAFORMS);
        PLATAFORMS.addEventListener("click", () => getSubcategoriesList( PLATAFORMS.value, SUBCATEGORIES ));
    }

    document.addEventListener("DOMContentLoaded", init);
}