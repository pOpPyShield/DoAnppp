<?php 
    require_once '../Core/Init.php';
    require_once 'config.php';
    session_start();
    class User{
        protected static $_instance = null;
        public $_pdo;
        public $_result;
        public $username = '';
        public $_userID;
        public $_imgID;
        public $_resultUserReg;
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

        public function getUserName() {
            return $this->username;
        }
        public function getID() {
            return $this->_userID;
        }

        public function getImgID() {
            return $this->_imgID;
        }

        public function getResultUserReg() {
            return $this->_resultUserReg;
        }
        public function login($username, $pwd) {
            if(!empty($username) && !empty($pwd)) {
                $st = $this->_pdo->prepare("SELECT * FROM user WHERE UserName=?");
                $st->bindParam(1, $username);
                $st->execute();
                if($st->rowCount()==1) {
                    $this->_result = $st->fetch();
                    if(password_verify($_POST['pwd'], $this->_result['Password'])) {
                        $this->username = $this->_result['UserName'];
                        //$this->_userID = $this->_result['UserID'];
                        $_SESSION['id'] = $this->_result['UserID'];
                        $_SESSION['UserName'] = $this->_result['UserName'];
                        $_SESSION['level'] = 'user';
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

        public function reg($username, $Password, $Email, $pwdagain) {
            $email1 = filter_var( $Email, FILTER_VALIDATE_EMAIL);
            if(!empty($username) && !empty($Email) && $email1 != false && !empty($Password) && !empty($pwdagain)) {
                if($Password != $pwdagain) {
                    //If pw = 0, that is the pwd is not match
                    header('Location: ../?pw=0');
                    exit();
                } else {
                    $pwd1 = password_hash($Password, PASSWORD_BCRYPT);
                    //Reg user
                    $st = $this->_pdo->prepare("INSERT INTO user(UserName, Password, Email) VALUES (?, ?, ?)");
                    $st->bindParam(1, $username);
                    $st->bindParam(2, $pwd1);
                    $st->bindParam(3, $email1);
                    //If execute success, then go to if block
                    if($st->execute()) {
                        //Select user with username
                        $st2 = $this->_pdo->prepare("SELECT * FROM user where UserName = ?");
                        $st2->bindParam(1, $username);
                        $st2->execute();
                        $this->_resultUserReg = $st2->fetch();
                        //Set value for prepare insert to profileimg table
                        $userid = $this->_resultUserReg['UserID'];
                        $status=1;
                        $fileType = 'jpg';
                        $NameImg = 'defaultimg';
                         //Insert value of sql 'select user' 
                        $st1 = $this->_pdo->prepare("INSERT INTO profileimg(userid, status, Type, Name) VALUE(?,?,?,?)");
                        $st1->bindParam(1, $userid);
                        $st1->bindParam(2, $status);
                        $st1->bindParam(3, $fileType);
                        $st1->bindParam(4, $NameImg);
                        $st1->execute();
                        return true;
                    }
                }
            } else {
                return false;
            }
        }
        /** Replace to another model, must be IMG model to check IMG and upload IMG for user */
    }

?>