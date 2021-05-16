/**
 * @author Francisco Javier González Sabariego
 */
 {
    const init = () => {
        if (location.href.match(/platforms\.php\?(add|edit=(\d+))$/)?.input !== undefined) {
            const SEND = document.getElementById("send");

            //console.log(SEND);

            SEND.addEventListener("click", e => {
                //e.preventDefault();
            });
        }
    }

    document.addEventListener("DOMContentLoaded", init);
}