<?php
require_once '../backend/config.php';
session_start();
if(!isset($_SESSION['user_id']))
{
	$msg = "Je moet eerst inloggen!";
	header("Location: $base_url/login.php?msg=$msg");
	exit;
}

?>

<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Aanpassen</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>

    <div class="container">
        <h1>Melding aanpassen</h1>

        <?php
        $id = $_GET['id'];                                      // Haal het id uit de URL:
        require_once "../backend/conn.php";                    //  1. Haal de verbinding erbij
        $query = "SELECT * FROM meldingen WHERE id = :id";    //   2. Query, vul deze aan met een WHERE zodat je alleen de melding met dit id ophaalt
        $statement = $conn->prepare($query);                 //    3. Van query naar statement
        $statement->execute([                               //     4. Voer de query uit, voeg hier nog de placeholder toe
            ":id" => $id
        ]);
        $melding = $statement->fetch(PDO::FETCH_ASSOC);   //       5. Ophalen gegevens, tip: gebruik hier fetch().
        ?>
        <form action="../backend/meldingenController.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
                <label>Naam attractie:</label>
                <?php echo $melding['attractie']; ?>
            </div>
            
            <div class="form-group">
                <label for="type">Type:</label>
                <?php echo $melding['type']; ?>
            </div>    

            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input" value="<?php echo $melding['capaciteit']; ?>">
            </div>

            <div class="form-group">
                <label for="prioriteit">Prio:</label>
                <input type="checkbox" name="prioriteit" <?php if($melding['prioriteit']) echo 'checked'; ?>>
                <label for="prioriteit">Melding met prioriteit</label>
            </div>

            <div class="form-group"> 
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" class="form-input" value="<?php echo $melding['melder']; ?>">
            </div>

            <div class="form-group">
                <label for="overig">Overige info:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4"><?php echo $melding['overige_info']; ?></textarea>
            </div>
            
            <input type="submit" value="Melding opslaan">
        </form>
        <hr>
        <form action="../backend/meldingenController.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="action" value="delete">
            <input type="submit" value="Verwijderen">   
        </form>
        
    </div>  

</body>

</html>
