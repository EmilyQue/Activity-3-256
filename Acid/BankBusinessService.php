<?php
require_once 'Autoloader.php';

class BankBusinessService {
    function getCheckingBalance() {
        //get database connection
        $db = new Database();
        $conn = $db->getConnection();
        //get checking balance
        $checking = new CheckingAccountDataService($conn);
        $balanceChecking = $checking->getBalance(); 
        //close database connection
        $conn->close();
        //return balance
        return $balanceChecking;
    }
    
    function getSavingsBalance() {
        //get database connection
        $db = new Database();
        $conn = $db->getConnection();
        //get savings controller
        $savings = new SavingsAccountDataService($conn);
        $balanceSavings = $savings->getBalance();
        //close database connection
        $conn->close();
        //return balance
        return $balanceSavings;
    }
    
    function transaction() {
        //get database connection
        $db = new Database();
        $conn = $db->getConnection();   
        
        //turn off auto-commit so we can run an atomic database transaction and start a transaction
        $conn->autocommit(FALSE);
        $conn->begin_transaction();
        
        //get the check balance and remove $100
        $checking = new CheckingAccountDataService($conn);
        $balanceChecking = $checking->getBalance();
        $okChecking = $checking->updateBalance($balanceChecking - 100);
        
        //add $100 to the savings balance
        $savings = new SavingsAccountDataService($conn);
        $balanceSavings = $savings->getBalance();
        $okSavings = $savings->updateBalance($balanceSavings + 100);
        
        //if update from the checking and saving were both 1 then commit the transaction else rollback the transaction
        if ($okChecking && $okSavings) {
            $conn->commit();
        }
        
        else {
            $conn->rollback();
        }
        
        //close the database connection
        $conn->close();
    }
}