<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

require_once 'conn.php';                                        //  1. Haal de verbinding erbij
$query = "SELECT * FROM users WHERE username = :username";     //   2. Schrijf de query met placeholders
$statement = $conn->prepare($query);                          //    3. Zet om naar een prepared-statement
$statement->execute([                                        //     4. Voer het statement uit
":username" => $username,
]);
$user = $statement->fetch(PDO::FETCH_ASSOC);               //       5. Haal de gegevens op (tip: je verwacht één resultaat, niet een lijst)
if($statement->rowCount() < 1)                            //        If-statement, check of "$statement->rowCount()" kleiner is dan 1
{ 
    $error_msg = 'account bestaat niet';
    header('Location: ../login.php?error_msg='.$error_msg);
    die(); 
}
if(!password_verify($password, $user['password']))     //           Check of het ingevulde wachtwoord klopt met die uit de DB
{
    $error_msg = 'Error: wachtwoord niet juist!';
    header('Location: ../login.php?error_msg='.$error_msg);
    die(); 
}
$_SESSION['user_id'] = $user['id'];                 //              Alles alles klopt: stop gebruikersgegevens in de session
$_SESSION['user_name'] = $user['username']; 
header("Location: ../index.php?msg=Ingelogd successvol");
  


