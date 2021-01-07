{
    const init = () => {
        const LOGIN_SCREEN = document.getElementById("login_screen");
        LOGIN_SCREEN.addEventListener("animationend", function () {
            this.className = "hidden";
        })
    }
    document.addEventListener("DOMContentLoaded", init);
}