<?php

    if(isset($_POST["submit"])){

        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        // Define Gmail's smtp server

        define('MAILHOST', "smtp.gmail.com");

        // Define a username

        define('USERNAME', "elizaveta.practiceweb@gmail.com");

        // Define Gmail app-password

        define('PASSWORD', "acagqaffjqhceklp");

        // Define Gmail address from which the email is sent

        define('SEND_FROM', "$email");

        // Define the name of the website from which the email is sent

        define('SEND_FROM_NAME', "$name");

        // Define the reply-to address 

        define('REPLY_TO', "$email");

        // Define reply-to name

        define('REPLY_TO_NAME', "$name");

        define('MESSAGE', "$message");

    }





?>