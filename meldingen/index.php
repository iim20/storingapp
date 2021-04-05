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
    <title>StoringApp / Meldingen</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>
    
    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php 
        if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        }
        elseif(isset($_GET['deleted']))
        {
            echo "<div class='deleted'>" . $_GET['deleted'] . "</div>";   
        } 
        ?>
        <?php
            require_once"../backend/conn.php";                          //verbinding ophalen
            $query = "SELECT * FROM meldingen";                         //query schrijven
            $statement = $conn->prepare($query);                        //van query naar statement
            $statement ->execute();                                     //statement uitvoeren
            $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);        //resultaat ophalen
        ?>
        
        <table>
            <tr>
                <th>Attractie</th>
                <th>Type</th>
                <th>Capaciteit</th>
                <th>Prioriteit</th>
                <th>Melder</th>
                <th>Gemeld op</th>
                <th>Overige info</th>
                <th>Aanpassen</th>
            </tr>
            <?php foreach($meldingen as $melding): ?>
                <tr>
                    <td><?php echo $melding['attractie'];?></td>
                    <td><?php echo $melding['type'];?></td>
                    <td><?php echo $melding['capaciteit'];?></td>
                    <td><?php
                     if($melding['prioriteit'] == 1)
                         {
                             echo $melding['prioriteit'] = "Ja";
                         } 
                     else
                         {
                             echo $melding['prioriteit'] = "Nee";
                         }
                    ?>
                    </td>
                    <td><?php echo $melding['melder'];?></td>
                    <td class="td-width-tijd"><?php echo $melding['gemeld_op'];?></td>
                    <td class="td-width"><?php echo $melding['overige_info'];?></td>
                    <td><?php echo "<a href=edit.php?id={$melding['id']}>aanpassen</a>"?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>  

</body>

</html>
