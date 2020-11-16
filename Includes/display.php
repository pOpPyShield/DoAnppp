
<?php
    session_start();
    require_once '../Classes/admin.php';
    require_once '../Classes/user.php';
    require_once '../Classes/superadmin.php';
    require_once '../Functions/sanitize.php';
        $object = new Admin();
        $user = new User();
        $superadmin = new superAdmin();
        if(isset($_POST['login'])) {
            $name = clean($_POST['username']);
            $pwd = clean($_POST['pwd']);

            if($user->login($name, $pwd) != false) {
                if($_SESSION['level'] == 'user' && $_SESSION['is_login'] == true) {
                    header('Location: ../?login=success');
                }  
                
            } elseif($object->login($name, $pwd)) {
                if($_SESSION['level'] == 'admin' && $_SESSION['is_login'] == true) {
                    header('Location: ../admindashboard.php?admin=' . $_SESSION['id']);
                }

            } elseif($superadmin->login($name, $pwd)) {
                if($_SESSION['level'] == 'superadmin' && $_SESSION['is_login']==true) {
                    header('Location: ../superadmindashboard.php?superadmin=' . $_SESSION['id']);
                }

            } else {
                header('location: ../account_log.php?message=failed');
            } 
        }

        if(isset($_POST['reg'])) {
            $name = clean($_POST['username']);
            $email = clean($_POST['email']);
            $pwd = clean($_POST['pwd']);
            $pwdagain = clean($_POST['pwdAgain']);
            $userReg = new User();
            $userReg->reg($name, $pwd, $email, $pwdagain);
        }   
    

?>


