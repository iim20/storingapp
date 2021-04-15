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
        <div class="filter-sort">
            <!-- Row Teller -->
            <?php       
            require_once "../backend/conn.php";                    
            $query = "SELECT * FROM meldingen";
            $statement = $conn->query($query);
            $row = $statement->rowCount();
            echo '<p> Aantal meldingen: ' . '<strong>' . $row . '</strong>' . '</p>';
            ?>
            <!-- Filter -->
            <?php
            require_once "../backend/conn.php";
            $s0 = 'selected';$s1 = '';$s2 = '';$s3 = '';$s4 = '';$s5 = '';$s6 = '';$s7 = '';
            if(!isset($_GET['type']))
            {
                $query = "SELECT * FROM meldingen";
                $statement = $conn->prepare($query);
                $statement ->execute();
            }
            else
            {
                $query = "SELECT * FROM meldingen WHERE username = :user_name AND type = :type";
                $statement = $conn->prepare($query);
                $statement->execute([
                    ":user_name" => $_SESSION['user_name'],
                    ":type" => $_GET['type']
                ]);
                switch($_GET['type'])
                {
                    case 'achtbaan':
                    $s0 = '';
                    $s1 = 'selected';
                    break;

                    case 'draaiend':
                    $s0 = '';
                    $s2 = 'selected';
                    break;

                    case 'kinder':
                    $s0 = '';
                    $s3 = 'selected';
                    break;

                    case 'horeca':
                    $s0 = '';
                    $s4 = 'selected';
                    break;

                    case 'show':
                    $s0 = '';
                    $s5 = 'selected';
                    break;

                    case 'water':
                    $s0 = '';
                    $s6 = 'selected';
                    break;
                    
                    case 'overig':
                    $s0 = '';
                    $s7 = 'selected';
                    break;

                    default:
                    $s0 = 'selected';
                    $s1 = '';
                    $s2 = '';
                    $s3 = '';
                    $s4 = '';
                    $s5 = '';
                    $s6 = '';
                    $s7 = '';
                    break;
                }
            }
            $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <form action="" method="GET">
                <select name="type">
                    <option value="Geen afdeling" <?php echo $s0;?>>- kies een type -</option>
                    <option value="achtbaan" <?php echo $s1;?>>Achtbaan</option>
                    <option value="draaiend" <?php echo $s2;?>>Draaiende attractie</option>
                    <option value="kinder" <?php echo $s3;?>>Kinder attractie</option>
                    <option value="horeca" <?php echo $s4;?>>Restaurant</option>
                    <option value="show" <?php echo $s5;?>>Shows</option>
                    <option value="water" <?php echo $s6;?>>Water</option>
                    <option value="overig" <?php echo $s7;?>>Overig</option>
                </select>
                <input type="submit" value="Filter">
            </form>
        </div>
        <!-- Meldingen -->
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


        <table>
            <tr>
                <th>Attractie</th>
                <th>Type</th>
                <!-- <th class="td-width-cap">Capaciteit</th> -->
                <!-- <th>Prio</th> -->
                <th>Melder</th>
                <!-- <th>Gemeld op</th> -->
                <th>Overige info</th>
                <th>Aanpassen</th>
            </tr>
            <?php foreach($meldingen as $melding): ?>
            <tr>
                <td class="td-width-attractie"><?php echo $melding['attractie'];?></td>
                <td class="td-width-type"><?php echo ucfirst($melding['type']);?></td>
                <!-- <td class="td-width-cap"><?php //echo $melding['capaciteit'];?></td> -->
                <!-- <td><?php
                     //if($melding['prioriteit'] == 1)
                        // {
                          //   echo $melding['prioriteit'] = "Ja";
                        // } 
                     //else
                       //  {
                         //    echo $melding['prioriteit'] = "Nee";
                         //}
                    //?>
                    </td> -->
                <td class="td-width-melder"><?php echo $melding['melder'];?></td>
                <!-- <td class="td-width-tijd"><?php //echo $melding['gemeld_op'];?></td> -->
                <td class="td-width"><?php echo $melding['overige_info'];?></td>
                <td class="td-width"><?php echo "<a href=edit.php?id={$melding['id']}>aanpassen</a>"?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>

</html>
