<?

$mas_of_mas = file('задача2.txt');

for ($i = 0; $i < 10; $i++){
    $mas_of_mas[$i] = explode(" ", $mas_of_mas[$i]);
}


$sum_gl_diag = 0;
$j = 0;
for ($i = 0; $i < 10; $i++){
    $sum_gl_diag += $mas_of_mas[$i][$j];
    $j += 1;
    }
print("Сумма главной диагонали: ". $sum_gl_diag."<br>");


$sum_pob_diag = 0;
$j = 9;
for ($i = 0; $i < 10; $i++){
    $sum_pob_diag += $mas_of_mas[$i][$j];
    $j -= 1;
    }
print("Сумма побочной диагонали: ". $sum_pob_diag);



?>