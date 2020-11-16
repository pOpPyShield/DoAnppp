<?php 
    require_once '../Core/init.php';
    require_once 'config.php';
    class Admin {
        protected static $_instance = null;
        public $_pdo;
        public  $_query, 
                $_error= false , 
                $_result, 
                $_count = 0;
        public $username = '';
        public function __construct()
        {
            try {
                $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host'). ';dbname='.Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }

        public static function getInstance() {
            if(!isset(self::$_instance)) {
                self::$_instance = new DB();

            }

            return self::$_instance;
        }
        public function getResult() {
            return $this->_result;
        }
        public function getUserName() {
            return $this->username;
        }
        public function login($username, $pwd) {
            //$this->_error = false;
            //$this->msg = '';
            if(!empty($username) && !empty($pwd)) {
                $st = $this->_pdo->prepare("SELECT * FROM admin WHERE UserName = ?");
                $st->bindParam(1, $username);
                $st->execute();
                if($st->rowCount() == 1) {
                    $this->_result = $st->fetch();
                    if(password_verify($_POST['pwd'], $this->_result['Password'])) {
                        $this->username = $this->_result['UserName'];
                        $_SESSION['id'] = $this->_result['AdminID'];
                        $_SESSION['UserName'] = $this->_result['UserName'];
                        $_SESSION['level'] = 'admin';
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
        

        public function reg($username, $email, $pwd, $pwdagain) {
            $email1 = filter_var( $email, FILTER_VALIDATE_EMAIL);
            if(!empty($username) && !empty($email) && $email1 != false && !empty($pwd) && !empty($pwdagain)) {
                if($pwd != $pwdagain) {
                    header('Location: account.php');
                    exit();
                } else {
                    $id = '1';
                    $pwd1 = password_hash($pwd, PASSWORD_BCRYPT);
                    $st = $this->_pdo->prepare("INSERT INTO admin(UserName, Password, email, idSuperAdmin) VALUES (?, ?, ?, ?)");
                    $st->bindParam(1, $username);
                    $st->bindParam(2, $pwd1);
                    $st->bindParam(3, $email1);
                    $st->bindParam(4, $id);
                    if($st->execute()) {
                        header('location: account.php?message=success');
                    }

                }
            } else {
                echo 'dont valid';
            }
        }
    }


?>