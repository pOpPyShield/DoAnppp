<?php 
    //Testing system then convert to OOP
    if(isset($_POST['reset-request-submit'])) {
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        
        //When we put website online, change this url
        $url = "www.computershopHT.net/DoAnPHPThuan/create-new-password.php?selector=" . $selector . "&validate=" . bin2hex($token);

        //Expire token
        $expires = date("U") + 1800;

        //Connect to db

        //Get the email enter in input
        $userEmail = $_POST['email'];
        $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
    } else {
        // Because we use folder to includes, then the header must be ../ to rediect to root folder
        header('Location: ../');
    }

?>