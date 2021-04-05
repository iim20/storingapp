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
    <title>StoringApp / Meldingen / Nieuw</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>

    <div class="container">
        <h1>Nieuwe melding</h1>

        <form action="../backend/meldingenController.php" method="POST">
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <input type="text" name="attractie" id="attractie" class="form-input">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-input">
                    <option value=""> - Kies een attractie - </option>
                    <option value="achtbaan">Achtbaan</option>
                    <option value="draaiend">Draaiende attractie</option>
                    <option value="kinder">Kinder attractie</option>
                    <option value="horeca">Restaurant</option>
                    <option value="show">Shows</option>
                    <option value="water">Water</option>
                    <option value="overig">Overig</option>
                </select>
            </div>

            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input">
            </div>

            <div class="form-group">
                <label for="newsletter">Prio:</label>
                <input type="checkbox" name="prioriteit" id="newsletter">
                <label for="newsletter">Melding met prioriteit</label>
            </div>

            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input">
            </div>

            <div class="form-group">
                <label for="overige_info">Overige info:</label>    
                <textarea name="overig" id="overig" class="form-input" rows="4"></textarea>
            </div>
            
            <input type="submit" value="Verstuur melding">

        </form>
    </div>  

</body>

</html>
