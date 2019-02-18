<?php
require_once 'Autoloader.php';

ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting(E_ALL);

//get bank business service
$service = new BankBusinessService();

//get checking balance 
echo "Initial Checking balance is: " . $service->getCheckingBalance() . "<br>";

//get savings balance
echo "Initial Savings balance is: " . $service->getSavingsBalance() . "<br>";

//run a bank transaction
$service->transaction();

echo "Current values:<br>";
//get new checking balance
echo "Checking balance = " . $service->getCheckingBalance() . "<br>";
//get new savings balance
echo "Savings balance = " . $service->getSavingsBalance() . "<br><br>";


