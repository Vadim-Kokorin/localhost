<form>
        <input type="text" placeholder="Введите 10 чисел" name="number"></br>
        <button type="submit" name="knopka">Показать</button>
</form>

<?
    $file = fopen("chisla.txt", 'a');
    
    $number = $_GET['number'];

    if(!isset($_GET['knopka'])){
        print("нажми кнопку");
    }
    else{

    if (count(explode(" ", $number)) != 10) {
        print("вы ввели меньше/больше 10 чисел!");
    }
    else {
        if (count($mas_of_mas = file("chisla.txt")) == 10) {
            print("лимит записи исчерпан!");
        }
        else {
            fwrite($file, $number."\n");
            print("Успешно!");
        }
    }
}

fclose($file);


?>