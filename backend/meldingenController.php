<?php
session_start();
$action = $_POST['action'];
$id = $_POST['id'];
$user = $_POST['username'];

if($action == "create")
{
    $attractie = $_POST['attractie'];
    // if(empty($attractie)) 
    // { 
    //     $errors[] = "Vul de attractie-naam in."; 
    // }
    $type = $_POST['type'];
    // if(empty($type)) 
    // { 
    //     $errors[] = "Vul de type van attractie in."; 
    // }
    $capaciteit = $_POST['capaciteit'];
    // if(!is_numeric($capaciteit)) 
    // { 
    //     $errors[] = "Vul voor capaciteit een geldig getal in."; 
    // }
    $prioriteit = $_POST['prioriteit'];
    // if(isset($_POST['prioriteit']))
    // {
    //     $prioriteit = true;
    // } 
    // else
    // {
    //     $prioriteit = false;
    // }
    $melder = $_POST['melder'];
    // if(empty($melder)) 
    // { 
    //     $errors[] = "Vul de naam van melder in."; 
    // }
    $overig = $_POST['overig'];

    // if(isset($errors)) 
    // { 
    //     header('Location: ../meldingen/edit.php?error_msg='.$errors);
    //     die();
    // }

    //Validatie
    if(empty($attractie) || empty($type) || empty($capaciteit) || empty($melder) || empty($overig) || ($prioriteit) == false)
    {
        //Evt. errors dumpen
        $error_msg = 'Niet alle verplechte velden waren correct ingevuld';
        header('Location: ../meldingen/create.php?error_msg='.$error_msg);
        die();
    }

    //1. Verbinding
    require_once 'conn.php';
    //2. Query
    $query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, username, overige_info) 
    VALUES(:attractie, :type, :capaciteit, :prioriteit, :melder, :username, :overige_info)";
    //3. Prepare
    $statement = $conn->prepare($query);
    //4. Execute
    $statement->execute([ 
        ":attractie" => $attractie,
        ":type" => $type, 
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":username" => $user,
        ":overige_info" => $overig
    ]);

    header("Location: ../meldingen/index.php?msg=Melding opgeslagen");

}

if($action == "update")
{
    $capaciteit = $_POST['capaciteit'];
    if(isset($_POST['prioriteit']))
    {
        $prioriteit = true;
    } 
    else
    {
        $prioriteit = false;
    }
    $melder = $_POST['melder'];
    $overig = $_POST['overig'];


    //1. Verbinding
    require_once 'conn.php';
    //2. Query
    $query = "UPDATE meldingen SET capaciteit = :capaciteit, prioriteit = :prioriteit, melder = :melder, gemeld_op = NOW(), overige_info = :overige_info  WHERE id = :id";
    //3. Prepare
    $statement = $conn->prepare($query);
    //4. Execute
    $statement->execute([
        ":id" => $id, 
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":overige_info" => $overig
    ]);

    header("Location: ../meldingen/index.php?msg=Melding opgeslagen");
}

if($action == "delete")
{
    require_once 'conn.php';                                //1. Verbinding
    $query = "DELETE FROM meldingen WHERE id = :id";        //2. Query
    $statement = $conn->prepare($query);                    //3. Prepare
    $statement->execute([                                   //4. Execute
        ":id" => $id
    ]);
    
    header("Location: ../meldingen/index.php?deleted=Melding verwijdert");
}