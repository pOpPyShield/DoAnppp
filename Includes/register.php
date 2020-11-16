<?php 

    require_once '../Classes/user.php';
    if(isset($_POST['reg'])) {
        $name = $_POST['username'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $pwdagain = $_POST['pwdAgain'];
        $userReg = new User();
        if($userReg->reg($name, $pwd, $email, $pwdagain)) {
            header('location: ../account_log.php?regUser=success');
        } else {
            header('location: ../account_reg.php?regUser=failed');
        }
    }   
    


?>