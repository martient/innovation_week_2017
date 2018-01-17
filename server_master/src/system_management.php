<?php
     /*
     PROJET: INNOVATION WEEK 2017 - NO NAME
     MAKER: Arnaud LEHERPEUR (Martient)
     DESCRIPTION: Service de modulation de calendrier en IOT.
     */
    
include('configuration.php');

    if (isset($_POST['sup'])) {
        $id = $_POST['upd'];
        $day = $_POST['day'];
        $d_l = explode('-', $day);
        $month = $d_l[1];
        $year = $d_t[0];
        $link = "&year=".$year."&month=".$month;
        $l = $_POST['locate'];
        $e = $_POST['event'];
        
        if ($_POST['sup'] == 1)
            $sql = "delete from agenda where id=$id";
        else
            $sql = "update agenda set locate ='$l' , event='$e' where id=$id";
        mysql_query($sql);
        header("location:agenda.php?admin&mod$link");
    } else if (isset($_POST['locate'])) {
        $day = $_POST['day'];
        $l = $_POST['locate'];
        $e = $_POST['event'];
        $d_l = explode('-', $day);
        $month = $d_l[1];
        $year = $d_l[0];
        $link = "&year=".$year."&month=".$month;
        $sql = "insert into agenda (day,locate,event) value('$day','$l','$e')";
        mysql_query($sql);
        echo $sql;
        header("location:agenda.php?admin&add$link");
    } else {
        $d = $_GET['dt'];
?>

<!DOCTYPE html PUBLIC>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Day info : <?php echo $d; ?></title>
    </head>
    <body>
        <h1> Management of day : <?php echo $d; ?></h1>
            <?php
                $sql = "select * from agenda where dt='$d'";
                $req = mysql_query($sql);
        
                if (mysql_num_rows($req) == 1) {
                    while ($day = mysql_fetch_array($req)) {
                        $mod = 1;
                        $id = $data['id'];
                        $loc = $data['locate'];
                        $eve = $data['event'];
                    }
                } else {
                    $mod = 0;
                    $loc = "";
                    $eve = "";
                }
            ?>
        <form name = "gr" action = "system_management.php" method = "post">
            <input type = 'hidden' id = 'day' name = 'day' value = '<?php echo $d; ?>'>
                <table>
                    <tr height = "50px">
                        <td width = "150px">
                            <strong>Event</strong>
                        </td>
                        <td>
                            <input type = "text" name = "locate" value = "<?php echo $loc; ?>"/>
                        </td>
                    </tr>
                    <tr height = "50px">
                        <td>
                            <strong>Locate</strong>
                        </td>
                        <td>
                            <input type = "text" name = "event" value = "<?php echo $eve; ?>"/>
                        </td>
                    </tr>
                    <tr height = "50px">
                        <?php
                            if ($mod == 0) {
                                echo "<td colspan = '2'><input type = 'submit' value = 'Add'></td>";
                            } else {
                                echo "<td colspan = '2'><input type = 'submit' value = 'Edit'>&nbsp;&nbsp;<input type = 'button' value = 'Remove' onclick = 'supp()'>";
                                echo "<input type = 'hidden' id = 'sup' name = 'sup' value = '0'><input type = 'hidden' name = 'upd' value = '$id'></td>";
                            }
                        ?>
                    </tr>
                </table>
        </form>
    </body>
</html>
<?php
}
?>
<script type = "text/javascript">
    function supp() {
        if (confirm("Do you want realy remove this ?") == true) {
            document.getElementById('sup').value=1;
            gr.submit();
        }
    }
</script>