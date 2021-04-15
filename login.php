<?php 
require_once 'backend/config.php';
session_start();
if(isset($_SESSION['user_id']))
{
    $msg = "Je bent al ingelogd!";
    header("Location: $base_url/index.php?msg=$msg");    
    exit();
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp</title>
	<meta charset="utf-8">
	<meta name="description" content="StoringApp voor technische dienst van DeveloperLand">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo $base_url; ?>/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo $base_url; ?>/css/normalize.css">
	<link rel="stylesheet" href="<?php echo $base_url; ?>/css/main.css">
</head>

<body>

    <?php require_once 'header.php'; ?>
    <div class="container home">
        <?php 
        if(isset($_GET['msg'])) 
        { 
            echo "<div class='msg'>" . $_GET['msg'] . "</div>"; 
        } 
        ?>
        <div class="form-group">
            <form action="backend/loginController.php" method="POST">
                <div class="form-group">
                    <label for="username">Gebruikersnaam:</label>
                    <input type="text" name="username" placeholder="user">
                </div>
                <div class="form-group">
                    <label for="password">Wachtwoord:</label>
                    <input type="password" name="password" placeholder="pass">
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input type="submit" value="login" class="form-group">
                    <input type="button" value="register" class="form-group" onclick='location.href="<?php echo $base_url; ?>/registratie.php";'/>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
