<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    table {
  width: 60%; 
  border-collapse: collapse;
}

th, td {
  border: 1px solid black;
  padding: 8px; 
  text-align: center; 
}

</style>
</head>
<body>
    <?
    function kalendary()
    { 
    ?>

    <table border="1">
        <tr bgcolor="#A5A5A5">
            <td><b>Пн</b></td>
            <td><b>Вт</b></td>
            <td><b>Ср</b></td>
            <td><b>Чт</b></td>
            <td><b>Пт</b></td>
            <td><b>Сб</b></td>
            <td><b>Вс</b></td>
        </tr>
        <?
            $year = 2025;
            $month = date('m');
            $current_day = date('d');

    $month_name = date("F", mktime(0, 0, 0, $month, 10)); 
    $counter_day = date('t', mktime(0, 0, 0, $month, 1, $year));
    $first_day = date('N', mktime(0, 0, 0, $month, 1, $year));
        print('<h2>'.$month_name.'<h2>');

        $day = 2-$first_day;
        for($i = 0; $i < 6; $i++) {
        print("<tr>");
        for($j = 0; $j < 7; $j++) {
            if ($day < 1) {
                print("<td></td>");
                $day++;
            }
            elseif($day <= $counter_day) {
                if ($day == $current_day){
                    print("<td bgcolor ='green'>$day</td?>");
                }
                elseif($j == 5 || $j == 6) {
                    print("<td bgcolor='pink'>$day</td>");

                } else {
                    print("<td>$day</td>");
                }

                $day++;
                
            } else {
                print("<td></td>");
            }

        }
        if ($day > $counter_day){
            break;
        }
        print("</tr>");
    }
    ?>
        </table>
    <?}

    kalendary();
    ?>
    
</body>
</html>