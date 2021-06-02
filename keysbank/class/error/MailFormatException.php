<?php
    /**
     * Excepción que se lanza cuando el correo no cumple con un formato correcto
     * 
     * /^([^-_@()<>[\]"'\.,;:])\w+([^-_@()<>[\]"'\.,;:])@([^-_@()<>[\]"'\.,;:])+\.(com|es)$/
     */
    class MailFormatException extends Exception {

    }
?>