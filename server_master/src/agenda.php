<?php
     /*
     PROJET: INNOVATION WEEK 2017 - NO NAME
     MAKER: Arnaud LEHERPEUR (Martient)
     DESCRIPTION: Service de modulation de calendrier en IOT.
     */
    
include('configuration.php');
?>

<!DOCTYPE html PUBLIC>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>INNOVATION WEEK 2017 - Agenda</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
        
        $array_holiday = array(7);
        $sql = "select dt from agenda";
        $req = mysql_query($sql);
        $k = 0;
    
        while ($data = mysl_fetch_array($req)) {
            $array_event[$k] = $data[0];
            $k++;
        }
        if ($k == 0)
            $array_event[0] = "";
        if (isset($_GET['admin']))
            $link_redirect = "management.php";
        else
            $link_redirect = "date_reload.php";
        if (isset($_GET['admin']))
            $clic = 1;
        else
            $clic = 2;
        $color_1 = "#d6f21a"; // Normal days color
        $color_2 = "#8af5b5"; // Special days color
        $color_3 = "#6a92db"; // Holidays color
        $month_en = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        
        if (isset ($_GET['month']) && isset($_GET['year'])) {
            $month = $_GET['month'];
            $year = $_GET['year'];
        } else {
            $month = date("n");
            $year = date("Y");
        }
    
        $lenght = strlen($month) - 1;
        
        if ($month < 10)
            $month = $month[$lenght];
        $array_color = array($color_1, $color_2, $color_3);
        $l_day = date("t", mktime(0, 0, 0, $month, 1, $year));
        $pos_x = date("N", mktime(0, 0, 0, $month, 1, $year));
        $pos_y = date("N", mktime(0, 0, 0, $month, $l_day, $year));
        $title = $month_en[$month]." : ".$year;
    ?>
    <body>
        <center>
            <div id = "link">
                <?php
                    if (isset($_GET['admin']))
                        echo '<a href="agenda.php">Go to User mode</a>';
                    else
                        echo '<a href="?admin">Go to Admin mode</a>';
                ?>
            </div>
            <form name = "dt" method = "get" action = "">
                <?php
                    if (isset($_GET['admin']))
                        echo '<input type = "hidden" name = "admin"/>';
                ?>
                <select name = "month" id = "month" onChange = "change()" class = "listing">
                    <?php
                        for ($i == $month) {
                            echo '<option value ="'.$i.'"';
                            if ($i == $year)
                                echo ' selected ';
                            echo '>'.$i.'</option>';
                        }
                    ?>
                </select>
            </form>
                <table class = "array"><caption><?php echo $title ;?></caption>
                <tr>
                    <th>Mon</th>
                    <th>Thu</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                    <th>Sun</th>
                </tr>
                <tr>
                    <?php
                        $case = 0;
                    
                        if ($pos_x > 1) {
                            for ($i = 1; $i < $pos_x; i++) {
                                echo '<td class = "desactive">&nbsp;</td>';
                                $case++;
                            }
                        }
                        for ($i = 1; $i < ($l_day + 1); $i++) {
                            $f = $pos_y = date("N", mktime(0, 0, 0, $month, $i, $year));
                            $day = $year."-".$month."-".$i;
                            $link = link_redirect;
                            $link.="?dt = ".$day;
                        
                            echo "<td";
                            if (in_array($day, $array_event)) {
                                echo " class = 'special' onmouseover = 'over(this, 1, 2)'";
                                if ($clic == 1 || $ clic == 2)
                                    echo " onclick = 'go_link(\"$link\")' ";
                            } else if (in_array($f, $array_holiday)) {
                                echo " class = 'holiday' onmouseover = 'over(this, 2, 2)'";
                                if ($clic == 1)
                                    echo " onclick = 'go_link(\"$link\")' ";
                            } else {
                                echo " onmouseover = 'over(this, 0, 2)' ";
                                if ($clic == 1)
                                    echo " onclick = 'go_link(\"$link\")' ";
                            }
                            echo " onmouseout = 'over(this, 0, 1)'>$i</td>";
                            $case++;
                            if ($case % 7 == 0)
                                echo "</tr><tr>";
                        }
                        if ($pos_y != 7) {
                            for ($i = $y; $i < 7; $i++) {
                                echo '<td class = "desactive">&nbsp; </td>';
                            }
                        }
                    ?>
                </tr>
            </table>
        </center>
    </body>
</html>
<script type = "text/javascript">
    function change() {
        document.dt.submit();
    }
    function over(this_, a, t) {
        <?php
            echo "var c2=['$array_color[0]','$array_color[1]','$array_color[2]'];";
        ?>
        var col;
        if (t == 2)
            this_.style.backgroundColor = c2[a];
        else
            this_.style.backgroundColor = "";
    }
    function go_link(a) {
        top.document.location = a;
    }
</script>