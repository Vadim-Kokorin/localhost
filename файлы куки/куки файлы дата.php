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
    function start()
    { 
    ?>
    <form>
        <input type="text" placeholder="Введите номер месяца" name="month"></br>
        <input type="text" placeholder="Введите день" name="day" ></br>
        <button type="submit" name="knopka">Показать</button>
    </form>
    <?}
    ?>


    <?
    if (!isset($_COOKIE['a'])) {
        if (!isset($_GET['submit'])){start();}
        else{
    $now = time();
    $birthday = mktime(0, 0, 0, $_GET['month'], $_GET['day'], 2026);

    $seconds = $birthday - $now;
    $days = floor($seconds / (60 * 60 * 24));
    $hours = floor(($seconds % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($seconds % (60 * 60)) / 60);
    $seconds = $seconds % 60;

    setcookie('a', $days);
    }}
    else {
        print("Осталось: ".$_COOKIE['a']);

    }

    
    ?>
    
</body>
</html>