<?php
     /*
     PROJET: INNOVATION WEEK 2017 - NO NAME
     MAKER: Arnaud LEHERPEUR (Martient)
     DESCRIPTION: Service de modulation de calendrier en IOT.
     */
?>
    
<!DOCTYPE html PUBLIC>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>INNOVATION WEEK 2017 - SERVICE DE CALENDRIER</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<?php
$array_holiday = array(7);
$array_event = array('1986-10-31', '2009-4-12', '2009-9-23');
$link_redirect="date_reload.php";
$clic = 1; // Nom à modifée.
$color_1 = "#d6f21a"; // Normal days color
$color_2 = "#8af5b5"; // Special days color
$color_3 = "#6a92db"; // Holidays color
$month_en = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
} else {
    $month = date("n");
    $year = date("Y");
}

$array_color = array($color_1, $color_2, $color_3);
$l_day = date("t", mktime(0, 0, 0, $month, 1, $year));
$pos_x = date("N", mktime(0, 0, 0, $month, 1, $year));
$pos_y = date("N", mktime(0, 0, 0, $month, $l_day, $year));
$title = $month_en[$month]." : ".$year;
?>
<body>
    <center>
        <form name = "dt" method = "get" action = "">
            <select name = "month" id = "month" onChange = "change()" class = "listing">
                <?php
                    for ($i = 1; $i <= 12; i++) {
                        echo '<option value="'.$i.'"';
                        if ($i == $month)
                            echo ' selected ';
                        echo '>'.$month_en[$i].'</option>';
                    }
                ?>
            </select>
            <select name = "year" id = "year" onChange = "change()" class"listing">
                <?php
                    for ($i = 1950; $i < 2099; i++) {
                        echo '<option value="'.$i.'"';
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
<footer>
    <H1>INNOVATION WEEK 2017 - Arnaud LEHERPEUR</H1>
</footer>
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