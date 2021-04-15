<?php
session_start();
require_once 'conn.php'; 
$action = $_POST['action'];

if($action == 'register'){
    $naam = $_POST['username'];
    $password = $_POST['password'];
    $cpass = $_POST['cpass'];
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['cpass'])){
        $error_msg = 'Niet alle velden waren correct ingevuld';
        header('Location: ../registratie.php?error_msg='.$error_msg);
        die();
    }
    if ($password!=$cpass){        
        $error_msg = 'Wachtwoord komt niet overeens';
        header('Location: ../registratie.php?error_msg='.$error_msg);
        die();
    }
                                                                  

    if ($password == $cpass){
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, password)
    VALUES(:username, :password)";                                                
    $statement = $conn->prepare($query);                                                            
    $statement->execute([                                                                          
    ":username" => $naam,
    ":password" => $hash
    ]);

    }

    $_SESSION['user_id'] = $_POST['id'];
    $_SESSION['user_name'] = $_POST['username'];
    header("Location: ../index.php?msg=Gebruiker+is+opgeslagen");
}