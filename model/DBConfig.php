<?php 
    class Database {
        private $hostname = 'localhost';
        private $username = 'root';
        private $pass = 'Mysql@2019#';
        private $dbname = 'congnghevadichvuweb';

        private $conn = NULL;
        private $result = NULL;

        public function __construct() {
            // echo "Hello";
        }

        public function connect() {
            $this->conn = new mysqli($this->hostname, $this->username, $this->pass, $this->dbname);
            if ($this->conn->connect_error) {
                echo "Failure";
                exit();
            }
            
            // echo "Hi";
            return $this->conn;
        }

        // execute the query
        public function execute($sql) {
            $this->result = $this->conn->query($sql);

            return $this->result;
        }

        //method to extract data from db
        public function getData() {
            
            if ($this->result) {
                $data = mysqli_fetch_array($this->result);

            }
            else {
                $data = 0;
            }
            return $data;
        }

        //method to extract the whole of data
        public function getAllData($table) {
            $sql = "SELECT * FROM $table";
            $this->execute($sql);
            if ($this->num_rows() == 0) {
                $data = 0;
            }
            else {
                while ($datas = $this->getData()) {
                    $data[] = $datas;  //save data to unordered array
                }
            }
            return $data;
        }

        //method to extract data from db
        public function getDataID($table, $id) {
            $sql = "SELECT * FROM $table WHERE id='$id'";
            $this->execute($sql);
            if ($this->num_rows() != 0) {
                $data = mysqli_fetch_array($this->result);

            }
            else {
                $data = 0;
            }
            return $data;
        }

        // Method to count the records
        public function num_rows() {
            if($this->result) {
                $num = mysqli_num_rows($this->result);
            }
            else {
                $num = 0;
            }
            return $num;
        }
    }
?>