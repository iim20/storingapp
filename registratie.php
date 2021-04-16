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
	<?php require_once 'head.php'; ?>
</head>

<body>

    <?php require_once 'header.php'; ?>
    <div class="container home">
        <?php 
        if(isset($_GET['msg'])) 
        { 
            echo "<div class='msg'>" . $_GET['msg'] . "</div>"; 
        }
        elseif(isset($_GET['error_msg'])) 
        { 
            echo "<div class='deleted'>" . $_GET['error_msg'] . "</div>"; 
        } 
        ?>
        <div class="form-group">
            <form action="backend/registratieController.php" method="POST">
                <input type="hidden" name="action" value="register">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="username">Gebruikersnaam:</label>
                    <label for=""></label>
                    <input type="text" name="username" placeholder="naam">
                </div>
                <div class="form-group">
                    <label for="password">Wachtwoord:</label>
                    <label for=""></label>
                    <input type="password" name="password" placeholder="wachtwoord">
                </div>
                <div class="form-group">
                    <label for="password">Wachtwoord Herhalen:</label>
                    <label for=""></label>
                    <input style="margin-left:-22px;"type="password" name="cpass" placeholder="herhaal wachtwoord">
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input type="submit" value="registreer" class="form-group">
                    <input type="button" value="login" class="form-group" onclick='location.href="<?php echo $base_url; ?>/login.php";'/>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
