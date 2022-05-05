<?php 
    require_once '../Model/userModel.php';
    require_once 'config.php';
    require_once 'accountUtils.php';

    $GLOBALS['conn'] = getConnection();

    function insertUser($name,$firstName,$lastName,$email,$password,$address,$phone,$gender,$accountType){
        $accountNumber = insertAccount($accountType);
        $sql = "INSERT INTO users (name,first_name,last_name,email,password,address,phone,sex,accounts_id)
        VALUES('{$name}','{$firstName}','{$lastName}','{$email}','{$password}','{$address}','{$phone}','{$gender}','{$accountNumber}')";

        $GLOBALS['conn']->exec($sql);
        return $accountNumber;
    }