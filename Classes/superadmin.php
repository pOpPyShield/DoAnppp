<?php
    require_once '../Core/Init.php';
    require_once 'config.php';
    Class SuperAdmin{

        public $_pdo;
        public $_result;
        public $username = '';

        public function __construct()
        {
            try {
                $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host'). ';dbname='.Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }

        public function getUserName() {
            return $this->username;
        }

        public function login($username, $pwd) {
            if(!empty($username) && !empty($pwd)) {
                $st = $this->_pdo->prepare("SELECT * FROM superadmin WHERE UserName=?");
                $st->bindParam(1, $username);
                $st->execute();
                if($st->rowCount()==1) {
                    $this->_result = $st->fetch();
                    if(password_verify($_POST['pwd'], $this->_result['Password'])) {
                        $this->username = $this->_result['UserName'];
                        $_SESSION['id'] = $this->_result['idSuperAdmin'];
                        $_SESSION['UserName'] = $this->_result['UserName'];
                        $_SESSION['level'] = 'superadmin';
                        $_SESSION['is_login'] = true;
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

?>