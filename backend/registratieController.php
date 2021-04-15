<?php
$action = $_POST['action'];
//$id = $_POST['id'];

if($action == 'register'){
    $naam = $_POST['username'];
    $password = $_POST['password'];
    $cpass = $_POST['cpass'];

    require_once 'conn.php';                                                                

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
    elseif ($password!=$cpass){
        
        $errors[] = "Wachtwoord komt niet overeens!";
    }
    if(isset($errors)) 
    { 
        var_dump($errors); die();
    }
    header("Location: ../login.php?msg=Gebruiker opgeslagen");
}