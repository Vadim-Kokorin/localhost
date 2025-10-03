<form>
        <input type="text" placeholder="Введите логин" name="log"></br>
        <input type="text" placeholder="Введите пароль" name="pass" ></br>
        <input type="text" placeholder="Введите почту" name="email" ></br>
        <input type="text" placeholder="Введите телефон" name="phone" ></br>
        <button type="submit" name="knopka">Показать</button>
</form>

<?
if (!isset($_GET['log']) && !isset($_GET['pass']) && !isset($_GET['email']) && !isset($_GET['phone'])) {
        print("Введите что ниубдь");
    }
else{
$mas_of_mas = file('polzovateli.txt');

if(!isset($_GET['knopka'])){
    print("нажми кнопку");
}

else{
for ($i = 0; $i < count($mas_of_mas); $i++) {
    $mas_of_mas[$i] = explode(":", $mas_of_mas[$i]);
}
    
    $login = $_GET['log'];
    $password = $_GET['pass'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    
    $proverka = false;
    for ($i = 0; $i < count($mas_of_mas); $i++) {
        if (trim($mas_of_mas[$i][0]) == $login && trim($mas_of_mas[$i][1]) == $password && trim($mas_of_mas[$i][2]) == $email && trim($mas_of_mas[$i][3]) == $phone) {
            print ("Такой пользователь уже существует!");
            $proverka = true;
            break;
        }
    }
    
    if (!$proverka) {
        for ($i = 0; $i < count($mas_of_mas); $i++) {
            $mas_of_mas[$i] = implode(":", $mas_of_mas[$i]);
        }
        $text = implode("" , $mas_of_mas);
        if (strpos($email, "@") !== false && strlen($phone) == 11) { 
            $file_zapisy = fopen('polzovateli.txt', 'w');
            fwrite($file_zapisy, $text."\n".$_GET['log'].":".$_GET['pass'].":".$_GET['email'].":".$_GET['phone']);
            print("Пользователь успешно добавлен!");}
        else {
            print("Почта или телефон введены неверно!");
        }
    }}
}
fclose($file_zapisy);

?>