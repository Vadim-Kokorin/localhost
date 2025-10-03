<?
// $f=fopen("задача1.txt",'r');
// $mas = [];
// while (!feof($f)){
//     $s .= fgets($f);
// }
// $mas = explode(" ", $s);
// print(max($mas));

print(max(explode(" ", file_get_contents("задача1.txt"))));

?> 