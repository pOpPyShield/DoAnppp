<?php 
    require_once 'Config.php';
    class DB{
        protected static $_instance = null;
        public $_pdo;
        public  $_query, 
                $_error= false , 
                $_result, 
                $_count = 0;

        public function __construct() {
            try {
                $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host'). ';dbname='.Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
            } catch(PDOException $e) {
                die($e->getMessage());
            }
            
        }
        public function query($sql, $params = array()) {
            $this->_error = false;

            if($this->_query = $this->_pdo->prepare($sql)) {
                if(count($params)) {
                    $x = 1;
                    foreach($params as $key) {
                        $this->_query->bindValue($x, $key);
                        $x++;
                    }
                }
            }

            if($this->_query->execute()) {
                $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }  else {
                $this->_error = true;
            }

            return $this;
        }

        public function action($action, $table, $where = array()) {
            if (count($where) === 3)  {
                $opreators = array('=', '>', '<', '>=', '<=');

                $field      = $where[0];
                $operator   = $where[1];
                $value      = $where[3];

                if(in_array($operator, $opreators)) {
                    $sql = "{$action}  FROM {$table} WHERE {$field} {$operator} ? ";
                    if(!$this->query($sql, array($value))->error()) {
                        return $this;
                    }   
                }
            }
            return false;
        }

        public function get($table, $where) {
            
        }   

        public function delete() {

        }
        public function insert($table, $fields = array()) {
            if(count($fields)) {
                $keys = array_keys($fields);
                $value = null;
                $x = 1;
                foreach($fields as $field) {
                    $value .='?';
                    if($x < count($fields)) {
                        $value .= ', ';
                    }
                    $x++;
                }
                $sql = "INSERT INTO superadmin (`" . implode('`, `', $keys) ."`) VALUES ({$value})";
                if(!$this->query($sql, $fields)->error()) {
                    return true;
                }
            }
            return false;
        }

        public function result() {
            return $this->_result;
        }

        public function first() {
            return $this->result()[0];
        }
        public function error() {
            return $this->_error;
        }

        public static function getInstance() {
            if(!isset(self::$_instance)) {
                self::$_instance = new DB();

            }

            return self::$_instance;
        }

        
    }

?>