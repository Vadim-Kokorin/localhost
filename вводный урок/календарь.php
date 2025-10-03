<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
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
    <h2>Сентябрь 2025</h2>
    
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
        $day = 1;
        for($i = 0; $i < 5; $i++) {
            print("<tr>");
            for($j = 0; $j < 7; $j++) {
                if ($day < 1) {
                    print("<td> </td>");
                    $day++;
                }
                elseif($day <= 31) {
                    if($j == 5 || $j == 6) {
                        print("<td bgcolor='pink'>$day</td>");

                    } else {
                        print("<td>$day</td>");
                    }

                    $day++;
                    
                } else {
                    print("<td></td>");
                }
            }
            
            print("</tr>");
        }
        ?>
    </table>
    <h2>Октябрь 2025</h2>
    
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
        $day = -1;
        for($i = 0; $i < 5; $i++) {
            print("<tr>");
            for($j = 0; $j < 7; $j++) {
                if ($day < 1) {
                    print("<td> </td>");
                    $day++;
                }
                elseif($day <= 31) {
                    if($j == 5 || $j == 6) {
                        print("<td bgcolor='pink'>$day</td>");

                    } else {
                        print("<td>$day</td>");
                    }

                    $day++;
                    
                } else {
                    print("<td></td>");
                }
            }
            
            print("</tr>");
        }
        ?>
    </table>
</body>
</html>