<!-- <?

$f=fopen("1.txt",'r');

while (!feof($f)){
    $s .= fgets($f);
}
    print($s);


?> -->



<!-- <?

$f = file_get_contents('1.txt');
print($f);
?> --> 
// все строчки считывает 





<?

$f = file('1.txt');
print_r($f);
?>
// считывает и в массив



<?
foreach($f as $m) {
    print($m. "<br>");
}
?>