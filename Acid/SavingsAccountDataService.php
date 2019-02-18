<?php
require_once 'Autoloader.php';

class SavingsAccountDataService {
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }
    
    function getBalance() {
        //run query to get balance
        $sql = "SELECT BALANCE FROM savings";
        $result = $this->conn->query($sql);
        if($result->num_rows == 0) {
            //error so just return -1
            return -1;
        }
        else {
            //return balance
            $row = $result->fetch_assoc();
            $balance = $row['BALANCE'];
            return $balance;
        }
    }
    
    function updateBalance($balance) {
        //run query to update balance
        $sql = "UPDATE savings SET BALANCE=$balance";
        if ($this->conn->query($sql) == TRUE) {
            return 1;
        }
        else {
            return 0;
        } 
    }
}