<form>
        <input type="text" placeholder="Введите логин" name="log"></br>
        <input type="text" placeholder="Введите пароль" name="pass" ></br>
        <button type="submit" name="knopka">Показать</button>
</form>

<?
$mas_of_mas = file('задача3.txt');


for ($i = 0; $i < 10; $i++) {
    $mas_of_mas[$i] = explode(":", $mas_of_mas[$i]);
}

    $login = $_GET['log'];
    $password = $_GET['pass'];

    $proverka = false;
    for ($i = 0; $i < 10; $i++) {
        if (trim($mas_of_mas[$i][0]) == $login && trim($mas_of_mas[$i][1]) == $password) {
            print ("Добро пожаловать!!! <br>" . "Логин: ". $login . "<br>" . "Пароль: ". $password);
            $proverka = true;
            break;
        }
    }
    
    if (!$proverka) {
        print( "Неверный логин или пароль.");
    }

?>