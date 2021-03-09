<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$capaciteit = $_POST['capaciteit']; 
$type = $_POST['type'];
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

// echo $attractie . " / " . $capaciteit . " / " . $overig . " / " . $melder ;

//1. Verbinding
require_once 'conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info) 
VALUES(:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";
//3. Prepare
$statement = $conn->prepare($query);
//4. Execute
$statement->execute([
    ":attractie" => $attractie,
    ":type" => $type,
    ":capaciteit" => $capaciteit,
    ":prioriteit" => $prioriteit,
    ":melder" => $melder,
    ":overige_info" => $overig
]);

header("Location: ../meldingen/index.php?msg=Melding opgeslagen");

