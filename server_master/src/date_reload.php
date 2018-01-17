<?php
     /*
     PROJET: INNOVATION WEEK 2017 - NO NAME
     MAKER: Arnaud LEHERPEUR (Martient)
     DESCRIPTION: Service de modulation de calendrier en IOT.
     */
    
include('configuration.php');

$d = $_GET['dt'];
?>

<!DOCTYPE html PUBLIC>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Day info : <?php echo $d; ?></title>
    </head>
    <body>
        <h1>Day info : <?php echo $d; ?></h1>
        <?php
            $sql = "select * from agenda where dt='$d'";
            $req = mysql_query($sql);
            if (mysql_num_rows($req) == 0)
                echo "No information detected";
            else {
                while ($day = mysql_fetch_array($req)) {
        ?>
                    <table>
                        <tr height = "50px">
                            <td width = "150px">
                                <strong>Event</strong>
                            </td>
                            <td>
                                <?php echo $data['event']; ?>
                            </td>
                        </tr>
                        <tr height = "50px">
                            <td>
                                <strong>Locate</strong>
                            </td>
                            <td>
                                <?php echo $data['locate']; ?>
                            </td>
                        </tr>
                    </table>
                }
            }
    </body>
</html>