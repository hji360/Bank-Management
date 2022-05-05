<?php 
    require_once '../Model/accountModel.php';
    require_once 'config.php';

    $GLOBALS['conn'] = getConnection();

    //random number generator
    function generateRandomNumber(){
        return rand(111111111111,999999999999);
    }

    function insertAccount($account_type_id){
        $accountNumber = generateRandomNumber();
        if(!checkAccountNumberExists($accountNumber)){
            $sql = "INSERT INTO accounts (number,account_types_id) VALUES ('$accountNumber','$account_type_id')";
            $GLOBALS['conn']->exec($sql);
            return $accountNumber;
        }else{
            return insertAccount($account_type_id);
        }
    }

    function checkAccountNumberExists($accountNumber){
        $sql = "SELECT * FROM accounts WHERE number = :accountNumber";
        $stmt = $GLOBALS['conn']->prepare($sql);
        $stmt->bindParam(':accountNumber',$accountNumber);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result)>0){
            return true;
        }else{
            return false;
        }
    }